<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../classes/JwtHandler.php';

$conn = mysqli_connect("localhost", "root", "", "hotel");

$rooms = json_decode($_POST["rooms"]);
$token = $_POST["token"];

//order rooms
$jwt = new JwtHandler();
$auth = $jwt->_jwt_decode_data($token);
$user_id = $auth['data']->user_id;
if (empty($user_id)) {
    echo "Phien dang nhap ban het han, vui long dang nhap lai";
    return;
}
$total = 0;

// Insert data in table bookroom.
$sql_book_room = "INSERT INTO bookroom (cus_code, total)
VALUES ($user_id, $total)";
$conn->query($sql_book_room);

$booking_code = mysqli_insert_id($conn);

// Insert data in table detailbook to array rooms.
foreach ($rooms as $room) {
    $datenhan = date("Y-m-d", strtotime($room->datenhan));
    $datetra = date("Y-m-d", strtotime($room->datetra));
    $sql_detail_book = "INSERT INTO detailbook (booking_code, room_type_id,price, number_room, number_adults,number_childrens,check_in,check_out,date_set) 
VALUES ($booking_code, $room->choseID,$room->item_price,$room->slphong,$room->songuoilon,$room->sotre,'$datenhan','$datetra',CURDATE())";

    $conn->query($sql_detail_book);

    //test
    $detail_book_id = mysqli_insert_id($conn);

    $get_detailbook = mysqli_query($conn, "SELECT * FROM detailbook WHERE id={$detail_book_id}");
    $get_row_detailbook = mysqli_fetch_assoc($get_detailbook);
    //print_r($get_row_detailbook);

    //lay danh sach phong ddax co trong detailbook theo ngay nhan va ngay tra va theo loai phong
    $get_list_room = mysqli_query($conn, "SELECT detailbook_room.room_id
     FROM `detailbook_room`,`detailbook`
     WHERE detailbook_room.detail_book_id=detailbook.id AND detailbook.room_type_id={$get_row_detailbook['room_type_id']} AND (((detailbook.check_in<='{$get_row_detailbook['check_in']}') AND ('{$get_row_detailbook['check_in']}' <= detailbook.check_out))
         OR ((detailbook.check_in<='{$get_row_detailbook['check_out']}') AND ('{$get_row_detailbook['check_out']}' <= detailbook.check_out)))");
    $array_room = array();
    while ($row = mysqli_fetch_assoc($get_list_room)) {
        $array_room[] = $row;
    }
    //print_r($array_room);
    //lay danh sach tat ca cac phong theo loai phong co san
    $get_list_roomType = mysqli_query($conn, "SELECT room.id as id_room
	FROM `roomtype`,`room`
    WHERE roomtype.id=room.typeCode and roomtype.id={$get_row_detailbook['room_type_id']}");
    $array_roomtype = array();
    while ($row = mysqli_fetch_assoc($get_list_roomType)) {
        $array_roomtype[] = $row;
    }
    $c = array();
    $a = array();
    $b = array();
    if (empty($array_room)) {
        foreach ($array_roomtype as $rooms) {
            $c[] = $rooms['id_room'];
        }
    } else {
        foreach ($array_roomtype as $rooms) {
            $a[] = $rooms['id_room'];
        }
        foreach ($array_room as $rooms) {
            $b[] = $rooms['room_id'];
        }
        $c = array_diff($a, $b);
    }
    for ($i = 0; $i < $get_row_detailbook['number_room']; $i++) {
        //Random lấy id_room bất kỳ
        $rand_keys = array_rand($c, 1);
        $id_room = $c[$rand_keys];
        //thêm id_room và detail_book_id vào bảng detailbook_room
        $data_detail_book_room = array(
            'detail_book_id' => $detail_book_id,
            'room_id' => $id_room
        );
        // add_detailbool_room($data_detail_book_room);
        $insert_detailbookRoom = "INSERT INTO detailbook_room (detail_book_id, room_id)
        VALUES ($detail_book_id, $id_room)";
        $conn->query( $insert_detailbookRoom);
        //Xóa cái mã id_room ra khỏi mảng để random tiếp nếu người đặt đặt số phòng >1
        unset($c[$rand_keys]);
    }
    // end test

    // Tinh toan tổng tiền.
    $songay = date_diff(date_create($datetra), date_create($datenhan));
    $total += (int)$room->slphong * (int)$room->item_price * ((int)$songay->format('%a') + 1);

    //update state room
    // $update_room = "UPDATE room SET state ='1' WHERE state='0' AND typeCode=$room->choseID ORDER BY id LIMIT $room->slphong";

    // $conn->query($update_room);

}

$sql = "UPDATE bookroom SET total=$total WHERE id=$booking_code";
$conn->query($sql);
echo "Bạn đã đặt phòng thành công";
$conn->close();

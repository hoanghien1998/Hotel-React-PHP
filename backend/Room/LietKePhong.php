<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db_conn = mysqli_connect("localhost","root","","hotel");

$allrooms = mysqli_query($db_conn,"SELECT roomtype.id, roomtype.image, roomtype.name, roomtype.price, roomtype.price_discount,
                                            roomtype.date_start, roomtype.date_end, room_type_detail.dientich,
                                            room_type_detail.huongphong, room_type_detail.giuong,COUNT(room.id)as count_room 
                                        FROM room,roomtype,room_type_detail 
                                        WHERE room.typeCode=roomtype.id and roomtype.id = room_type_detail.room_type_id 
                                                -- and roomtype.price_discount >0 and CURDATE() >= date_start AND CURDATE() <= date_end
                                        GROUP BY room.typeCode");


if(mysqli_num_rows($allrooms) > 0){

    $all_rooms = mysqli_fetch_all($allrooms, MYSQLI_ASSOC);

    echo json_encode(["success"=>1,"rooms"=>$all_rooms]);
}
else{
    echo json_encode(["success"=>0]);
}
<?php

//index
//Lấy số phòng còn trống trong các loại phòng
function get_list_room_type() {
    //Lấy 1 mảng trong database
    $result = db_fetch_array("SELECT roomtype.id,roomtype.name,COUNT(room.id)as count_room FROM `room`,`roomtype` WHERE room.typeCode=roomtype.id and state='0' GROUP BY room.typeCode");
    return $result;
}

//Lấy số phòng còn trống trong các loại phòng theo id cho trc
function get_list_room_type_id($id) {
    //Lấy 1 mảng trong database
    $result = db_fetch_row("SELECT roomtype.id,roomtype.name,COUNT(room.id)as count_room FROM `room`,`roomtype` WHERE room.typeCode=roomtype.id and state='0' and roomtype.id={$id}");
    return $result;
}

//lấy tổng số phòng hiện có trong giỏ hàng
function get_number_room_cart() {
    $result = db_fetch_row("SELECT SUM(`number_room`) AS sum_number_room FROM cart");
    return $result;
}

//kiểm tra loại phòng đó đã có trong giỏ hàng chưa
function check_num_room_type($id) {
    $check_room_type = db_num_rows("SELECT * FROM `cart` WHERE `id_roomtype`='{$id}'");
    if ($check_room_type > 0)
        return TRUE;
    return FALSE;
}

//==================================
//Thêm vào cart
function add_cart($data) {
    db_insert('cart', $data);
}

//Thông tin lấy ra trong cart và loại phòng
function get_info_cart() {
    //Lấy 1 mảng trong database
    $result = db_fetch_array("SELECT `id_roomtype`,roomtype.name,roomtype.price, `number_room` , cart.check_in,cart.check_out,((roomtype.price*`number_room`)*(DATEDIFF(check_out, check_in)+1)) as total_sum FROM `cart`, `roomtype` WHERE cart.id_roomtype=roomtype.id");
    return $result;
}

//Xóa loại phòng trong giỏ hàng
function delete_cart_room_type_id($id) {
    db_delete('cart', "`id_roomtype`={$id}");
}

//Lấy cart theo id
function get_info_cart_id($id) {
    $result = db_fetch_row("SELECT * FROM `cart` WHERE id_roomtype={$id}");
    return $result;
}

//update lại cart id
function update_info_cart_id($data, $id) {
    db_update('cart', $data, "`id_roomtype`={$id}");
}

//===================================================
//LẤy số phòng trống của ngày hôm nay ra
function check_date_now($datenow) {
    //Lấy 1 mảng trong database
    $result = db_fetch_array("SELECT Roomtype.id,Roomtype.name,(IFNULL(Roomtype.number_room-Detailbook.number_room,Roomtype.number_room)) AS number
FROM (SELECT room_type_id,SUM(number_room) AS number_room
	FROM `detailbook`
	WHERE detailbook.check_in <='{$datenow}' AND '{$datenow}' <= detailbook.check_out
    GROUP BY room_type_id) AS Detailbook RIGHT JOIN (SELECT roomtype.id,roomtype.name,COUNT(room.id) as number_room
            FROM `room`,`roomtype`
            WHERE room.typeCode=roomtype.id
            GROUP BY typeCode) AS Roomtype ON Detailbook.room_type_id=Roomtype.id");
    return $result;
}

//Lấy số phòng trống mà ngày mình nhập

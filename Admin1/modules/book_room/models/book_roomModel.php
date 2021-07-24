<?php

function get_info_cart() {
    //Lấy 1 mảng trong database
    $result = db_fetch_array("
    SELECT `id_roomtype`,roomtype.name,`number_room`,(DATEDIFF(check_out, check_in)+1)AS number_day , roomtype.price,((roomtype.price*`number_room`)*(DATEDIFF(check_out, check_in)+1)) as total_sum,check_out, check_in,number_adults,number_childrens, roomtype.date_start,roomtype.date_end, roomtype.price_discount
    FROM `cart`, `roomtype`
    WHERE cart.id_roomtype=roomtype.id");
    return $result;
    // SELECT `id_roomtype`,roomtype.name,`number_room`,(DATEDIFF(check_out, check_in)+1)AS number_day , roomtype.price,((roomtype.price*`number_room`)*(DATEDIFF(check_out, check_in)+1)) as total_sum,check_out, check_in,number_adults,number_childrens,((roomtype.price_discount*`number_room`)*(DATEDIFF(check_out, check_in)+1)) as total_sum_discount, roomtype.date_start,roomtype.date_end, roomtype.price_discount
    // FROM `cart`, `roomtype`
    // WHERE cart.id_roomtype=roomtype.id
}

// danh sách số ngày giảm Giá
function get_list_date_discount_money($id){
    $result=db_fetch_row(
        "SELECT (DATEDIFF(date_end , CURDATE())+1)AS number_day FROM `roomtype` WHERE `id`=$id"
    );
    return $result;
}

//kiem tra co chung minh nhan dan trong database
function get_num_row($from, $where) {
    $result = db_num_rows("SELECT * FROM {$from} WHERE cmnd={$where}");
    return $result;
}

//thêm khách hàng
function add_customer($data) {
    $result = db_insert('customer', $data);
    return $result;
}

//lấy id customer theo cmnd
function get_id_customer($cmnd) {
    $result = db_fetch_row("SELECT * FROM `customer` WHERE cmnd={$cmnd}");
    return $result;
}

// Thêm book_room
function add_book_room($data) {
    $result = db_insert('bookroom', $data);
    return $result;
}

//Thêm detail book room
function add_detail_book($data) {
    $result=db_insert('detailbook', $data);
    return $result;
}

//Xóa tất cả đặt phòng trong giỏ hàng
function detete_all_cart($table) {
    db_delete_all($table);
}

//Lấy danh sách phòng còn trống theo loại phòng ngày mà mình muốn đặt
//function get_list_room_empty($check_in,$check_out,$id_room_type){
//    $result = db_fetch_array("SELECT list_room_detail_book.id_room
//FROM (SELECT roomtype.id,room.id as id_room
//	FROM `roomtype`,`room`
//	WHERE roomtype.id=room.typeCode and roomtype.id={$id_room_type}) AS list_room_detail_book,
//    (SELECT detailbook_room.room_id, detailbook.room_type_id
//	FROM `detailbook_room`,`detailbook`
//	WHERE detailbook_room.detail_book_id=detailbook.id AND detailbook.room_type_id={$id_room_type} AND ((detailbook.check_in<='{$check_in}') AND ('{$check_in}' <= detailbook.check_out)) OR ((detailbook.check_in<='{$check_out}') AND ('{$check_out}' <= detailbook.check_out))) AS list_room_room_type
//WHERE list_room_detail_book.id_room != list_room_room_type.id");
//    return $result;
//}

//Lấy danh sách phòng đã được đặt trong detailbook theo ngày nhận và ngày trả và theo loại phòng
function get_list_room_detail_book($check_in,$check_out, $id_roomtype){
    $result= db_fetch_array("SELECT detailbook_room.room_id
	FROM `detailbook_room`,`detailbook`
	WHERE detailbook_room.detail_book_id=detailbook.id AND detailbook.room_type_id={$id_roomtype} AND ((detailbook.check_in<='{$check_in}') AND ('{$check_in}' <= detailbook.check_out))
        OR ((detailbook.check_in<='{$check_out}') AND ('{$check_out}' <= detailbook.check_out))");
    return $result;
}

//Lấy toàn bộ phòng theo từng loại phòng chỉ định sẵn
function get_list_room_of_room_type($id){
    $result= db_fetch_array("SELECT room.id as id_room
	FROM `roomtype`,`room`
	WHERE roomtype.id=room.typeCode and roomtype.id={$id}");
    return $result;
}




















//Thêm detail_book_room
function add_detailbool_room($data){
    $result = db_insert('detailbook_room', $data);
    return $result;
}
?>
<?php

function get_num_row($label) {
    $result = db_num_rows("SELECT * FROM {$label}");
    return $result;
}

function get_list_room($start = 0, $num_per_page = 6, $where = "") {
    if (!empty($where))
        $where = "WHERE {$where}";
    $list_rooms = db_fetch_array("SELECT room.id, room.roomNumber,roomtype.name,room.state FROM `room`,`roomtype` {$where} LIMIT {$start},{$num_per_page}");
    return $list_rooms;
}

function get_list_room_type() {
    //Lấy 1 mảng trong database
    $result = db_fetch_array("SELECT * FROM `roomtype`");
    return $result;
}

function get_room_id($id) {
    $result = db_fetch_row("SELECT * FROM `room` WHERE `id`={$id}");
    return $result;
}

function update_info_room_id($data, $id) {
    db_update('room', $data, "`id`={$id}");
}

function delete_room_id($id) {
    db_delete('room', "`id`={$id}");
}

function add_room($data) {
    db_insert('room', $data);
}

//Kiểm tra ngày hôm nay có những phòng nào đc đặt, nếu đặt thì cho phòng đó có trạng thái là đã đặt
function get_list_room_detail_book_room() {
    $result = db_fetch_array("SELECT DISTINCT room.id, room.state
FROM (SELECT detailbook_room.room_id
	FROM `detailbook_room`,`detailbook`
	WHERE detailbook_room.detail_book_id = detailbook.id AND (detailbook.check_in <= CURDATE()) OR (detailbook.check_out >= CURDATE())) AS room_detail_book_room, `room`
WHERE room_detail_book_room.room_id = room.id");
    return $result;
}

function update_room_to_detailbook_room($data,$id){
    db_update('room', $data, "`id`={$id}");
}

//Kiểm tra ngày hôm nay có những phòng nào đc trả, nếu trả thì cho phòng đó có trạng thái là còn trống
function get_list_room_detail_book_room_check_out() {
    $result = db_fetch_array("SELECT DISTINCT room.id, room.state FROM (SELECT detailbook_room.room_id FROM `detailbook_room`,`detailbook` WHERE detailbook_room.detail_book_id = detailbook.id AND (detailbook.check_out < CURDATE() OR detailbook.check_in > CURDATE())) AS room_detail_book_room, `room` WHERE room_detail_book_room.room_id = room.id");
    return $result;
}

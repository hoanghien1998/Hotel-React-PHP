<?php

function get_num_row($label){
    $result=db_num_rows("SELECT * FROM {$label}");
    return $result;
}

function get_list_roomtype($start=0,$num_per_page=6,$where=""){
    if(!empty($where))
        $where="WHERE {$where}";
    $list_rooms_type = db_fetch_array("SELECT * FROM `roomtype` LIMIT {$start},{$num_per_page}");
    return $list_rooms_type;
}

//function get_list_room_type(){
//    //Lấy 1 mảng trong database
//    $result= db_fetch_array("SELECT * FROM `roomtype`");
//    return $result;
//}

function get_room_type_id($id){
    $result= db_fetch_row("SELECT * FROM `roomtype` WHERE `id`={$id}");
    return $result;
}

function update_info_room_type_id($data,$id){
    db_update('roomtype', $data,"`id`={$id}");
}

// update ngày sự kiện khi đã kết thúc
function update_info_room_type($data){
    db_update('roomtype', $data , "`date_end` <"+date('Y-m-d')+"");
}

function delete_room_type_id($id){
    db_delete('roomtype', "`id`={$id}");
}

function add_room($data){
    db_insert('room', $data);
}

function insert_info_room_type($data){
    db_insert('roomtype', $data);
}

<?php

function insert_info_slide($data){
    db_insert('slide', $data);
}

function get_num_row($label){
    $result=db_num_rows("SELECT * FROM {$label}");
    return $result;
}

function get_list_slide($start=0,$num_per_page=6,$where=""){
    if(!empty($where))
        $where="WHERE {$where}";
    $list_slide = db_fetch_array("SELECT `id_slide`, `image`,`date_start`,`date_end` FROM `slide` {$where} LIMIT {$start},{$num_per_page}");
    return $list_slide;
}

function get_slide_id($id){
    $result= db_fetch_row("SELECT * FROM `slide` WHERE `id_slide`={$id}");
    return $result;
}

function update_info_slide_id($data,$id){
    db_update('slide', $data,"`id_slide`={$id}");
}

function delete_slide_id($id){
    db_delete('slide', "`id_slide`={$id}");
}

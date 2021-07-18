<?php

function get_num_row($label){
    $result=db_num_rows("SELECT * FROM {$label}");
    return $result;
}

function get_list_product($start=0,$num_per_page=6,$where=""){
    if(!empty($where))
        $where="WHERE {$where}";
    $list_product = db_fetch_array("SELECT `id`, `name_product`,`price`,`number` FROM `product` {$where} LIMIT {$start},{$num_per_page}");
    return $list_product;
}

function get_product_id($id){
    $result= db_fetch_row("SELECT * FROM `product` WHERE `id`={$id}");
    return $result;
}

function update_info_product_id($data,$id){
    db_update('product', $data,"`id`={$id}");
}

function delete_product_id($id){
    db_delete('product', "`id`={$id}");
}

function add_product($data){
    db_insert('product', $data);
}

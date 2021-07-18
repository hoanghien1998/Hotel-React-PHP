<?php

function get_num_row($label) {
    $result = db_num_rows("SELECT * FROM {$label}");
    return $result;
}

function get_list_bookroom($start = 0, $num_per_page = 6, $where = "") {
    if (!empty($where))
        $where = "WHERE {$where}";
    $list_customer = db_fetch_array("SELECT id,customer.name,customer.cus_code, total, bookroom.state FROM `bookroom`,`customer` {$where} LIMIT {$start},{$num_per_page}");
    return $list_customer;
}

function get_bookroom_id($id) {
    $result = db_fetch_row("SELECT id,customer.name,customer.cus_code, total, bookroom.state FROM `bookroom`,`customer` WHERE bookroom.id={$id} and bookroom.cus_code=customer.cus_code");
    return $result;
}

//lấy tổng tiền 1 ngày theo hóa đơn
function get_sum_money_one_day($id) {
    $result = db_fetch_row("SELECT SUM(price*number_room) AS Sum_money FROM `detailbook` WHERE booking_code={$id}");
    return $result;
}

function update_info_bill($data, $id) {
    db_update('bookroom', $data, "`id`={$id}");
}

//lấy danh sach sản phẩm
function get_list_product() {
    //Lấy 1 mảng trong database
    $result = db_fetch_array("SELECT * FROM `product`");
    return $result;
}

//Thêm phụ thu
function add_surcharge($data) {
    $result = db_insert('detail_surcharge', $data);
    return $result;
}

//Lấy thông tin phụ thu sau khi mới thêm xong
function get_info_surcharge($id) {
    $result = db_fetch_row("SELECT detail_surcharge.id, detail_surcharge.number, product.price, `sum_money` FROM `detail_surcharge`,`product` WHERE detail_surcharge.id_product=product.id AND detail_surcharge.id={$id}");
    return $result;
}

//Update thông tin phụ thu
function update_info_surcharge($data, $id) {
    db_update('detail_surcharge', $data, "detail_surcharge.id={$id}");
}

//lấy thông tin bookroom
function get_info_bookroom($id) {
    $result = db_fetch_row("SELECT total FROM `bookroom` WHERE `id`={$id}");
    return $result;
}

//cập nhật lại tiền của bookroom
function update_info_bookroom($data, $id) {
    db_update('bookroom', $data, "id={$id}");
}
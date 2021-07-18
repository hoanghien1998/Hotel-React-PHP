<?php

function get_list_detail_bookroom_booking_code($booking_code){
    $result=db_fetch_array("SELECT detailbook.id, `booking_code`, `room_type_id`, detailbook.price, `number_room`, `date_set`, roomtype.name, check_in,check_out,number_adults, number_childrens,((detailbook.price*`number_room`)*(DATEDIFF(check_out, check_in)+1)) as total"
            . " FROM `detailbook`,`roomtype`"
            . " WHERE detailbook.booking_code={$booking_code} and detailbook.room_type_id=roomtype.id");
    return $result;
}

//Lấy danh sách phụ thu theo hóa đơn
function get_list_detail_surcharge($booking_code){
    $result=db_fetch_array("SELECT product.name_product, detail_surcharge.number, detail_surcharge.price, `sum_money` FROM `detail_surcharge`,`product` WHERE detail_surcharge.booking_code={$booking_code} and detail_surcharge.id_product=product.id");
    return $result;
}

//Lấy danh sách phòng mà khách hàng đang ở
function get_ist_room_detail_book($booking_code){
    $result=db_fetch_array("SELECT room.roomNumber, detailbook.check_in,detailbook.check_out
FROM `detailbook_room`,`detailbook`,`room`
WHERE detailbook.booking_code={$booking_code} AND detailbook_room.detail_book_id=detailbook.id AND detailbook_room.room_id=room.id");
    return $result;
}

//update laijdetail book
function update_info_detail_bookroom($data,$id){
    db_update('detailbook', $data,"`id`={$id}");
}


//lấy tổng tiền của tất cả chi tiết hóa đơn theo từng hóa đơn
function get_total_money_detail_book($id){
    $result= db_fetch_row("SELECT SUM(A.total) as total_money FROM (SELECT ((detailbook.price*`number_room`)*(DATEDIFF(check_out, check_in)+1)) as total FROM `detailbook` WHERE booking_code={$id} GROUP BY room_type_id) AS A");
    return $result;
}

//Lấy tổng tiền của tất cả phụ thu theo hóa đơn
function get_total_money_surcharge($id){
    $result= db_fetch_row("SELECT SUM(sum_money) AS total_money_surcharge FROM `detail_surcharge` WHERE detail_surcharge.booking_code={$id} GROUP BY booking_code");
    return $result;
}

function update_info_bill($data,$id){
    db_update('bookroom', $data,"`id`={$id}");
}

//Lấy thông tin detail id
function get_info_detailbook_id($id){
    $result= db_fetch_row("SELECT * FROM `detailbook` WHERE id={$id}");
    return $result;
}

//Lấy số phòng còn trống theo loại phòng
function get_number_room_type_id($id){
    $result= db_fetch_row("SELECT COUNT(room.id)AS Number_room FROM `roomtype`,`room` WHERE roomtype.id=room.typeCode and roomtype.id={$id} and room.state=0 GROUP BY room.typeCode");
    return $result;
}

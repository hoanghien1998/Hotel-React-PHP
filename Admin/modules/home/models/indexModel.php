<?php

function get_revenue_month(){
    $result= db_fetch_array("SELECT DATE_FORMAT(check_out,'%m')AS Month, SUM(total) as SUM FROM `bookroom`,`detailbook` WHERE YEAR(check_out)=YEAR(NOW()) AND state=1 AND bookroom.id=detailbook.booking_code GROUP BY Month");
    return $result;
}

function get_revenue_room_type(){
    $result= db_fetch_array("SELECT roomtype.name,SUM(`number_room`) as y FROM `detailbook`,`roomtype` WHERE detailbook.room_type_id=roomtype.id GROUP BY room_type_id");
    return $result;
}

function get_sum_money_year_now(){
    $result= db_fetch_row("SELECT SUM(total) as Sum_year FROM `bookroom` WHERE state=1 GROUP BY YEAR(NOW())");
    return $result;
}

function get_number_client(){
    $result= db_fetch_row("SELECT COUNT(cus_code) as number_customer FROM `customer`");
    return $result;
}

// function update_price_discount(){
//     $data=array(
//         "price_discount"=>0,
//         "date_start"=>date("Y-m-d"),
//         "date_end"=>date("Y-m-d")
//     );
    
//     $where="( CURDATE() NOT BETWEEN date_start and date_end ) AND (date_start < CURDATE())";
//     $result=db_update("roomtype",$data,$where);
//     return $result;
// }
function update_price_discount(){
    $data=array(
        "price_discount"=>0
    );
    
    $where="( CURDATE() NOT BETWEEN date_start and date_end ) AND (date_start < CURDATE())";
    $result=db_update("roomtype",$data,$where);
    return $result;
}

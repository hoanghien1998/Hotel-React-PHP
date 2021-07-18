<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
    load('helper', 'format');
    $info_revenue_month = get_revenue_month();
    $x1 = 1;
    $x2 = 2;
    $x3 = 3;
    $x4 = 4;
    $x5 = 5;
    $x6 = 6;
    $x7 = 7;
    $x8 = 8;
    $x9 = 9;
    $x10 = 10;
    $x11 = 11;
    $x12 = 12;
    $y1 = 0;
    $y2 = 0;
    $y3 = 0;
    $y4 = 0;
    $y5 = 0;
    $y6 = 0;
    $y7 = 0;
    $y8 = 0;
    $y9 = 0;
    $y10 = 0;
    $y11 = 0;
    $y12 = 0;
    for ($i = 0; $i < 12; $i++) {
        if (isset($info_revenue_month[$i]['Month'])) {
            //tháng 1
            if ($info_revenue_month[$i]['Month'] == 1) {
                $x1 = $info_revenue_month[$i]['Month'];
                $y1 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 2) {
                $x2 = $info_revenue_month[$i]['Month'];
                $y2 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 3) {
                $x3 = $info_revenue_month[$i]['Month'];
                $y3 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 4) {
                $x4 = $info_revenue_month[$i]['Month'];
                $y4 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 5) {
                $x5 = $info_revenue_month[$i]['Month'];
                $y5 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 6) {
                $x6 = $info_revenue_month[$i]['Month'];
                $y6 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 7) {
                $x7 = $info_revenue_month[$i]['Month'];
                $y7 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 8) {
                $x8 = $info_revenue_month[$i]['Month'];
                $y8 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 9) {
                $x9 = $info_revenue_month[$i]['Month'];
                $y9 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 10) {
                $x10 = $info_revenue_month[$i]['Month'];
                $y10 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 11) {
                $x11 = $info_revenue_month[$i]['Month'];
                $y11 = $info_revenue_month[$i]['SUM'];
            } else if ($info_revenue_month[$i]['Month'] == 12) {
                $x12 = $info_revenue_month[$i]['Month'];
                $y12 = $info_revenue_month[$i]['SUM'];
            }
        }
    }
    $dataPoints = array(
        array("x" => $x1, "y" => $y1),
        array("x" => $x2, "y" => $y2),
        array("x" => $x3, "y" => $y3),
        array("x" => $x4, "y" => $y4),
        array("x" => $x5, "y" => $y5),
        array("x" => $x6, "y" => $y6),
        array("x" => $x7, "y" => $y7),
        array("x" => $x8, "y" => $y8),
        array("x" => $x9, "y" => $y9),
        array("x" => $x10, "y" => $y10),
        array("x" => $x11, "y" => $y11),
        array("x" => $x12, "y" => $y12)
    );
//Thống kê loại phòng ưa chuộng
    $dataPoints1 = get_revenue_room_type();
    $data['dataPoints'] = $dataPoints;
    $data['dataPoints1'] = $dataPoints1;

//Tổng tiền trong 1 năm
    $sum_money_one_year = get_sum_money_year_now();
    $data['sum_money_one_year'] = $sum_money_one_year;
//Tổng số khách hàng
    $number_customer = get_number_client();
    $data['number_customer'] = $number_customer;

//UPDATE ROOM-TYPE
    update_price_discount();

    load_view('index', $data);
}

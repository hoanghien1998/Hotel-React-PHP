<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('detail_bookroom');
}

function indexAction() {
    if (isset($_GET['id'])) {
        $list_detail_bookroom = get_list_detail_bookroom_booking_code($_GET['id']);
        $data['list_detail_bookroom'] = $list_detail_bookroom;
        
        $list_detail_surcharge=get_list_detail_surcharge($_GET['id']);
        $data['list_detail_surcharge'] = $list_detail_surcharge;
        
        $list_room_detail_book=get_ist_room_detail_book($_GET['id']);
        $data['list_room_detail_book'] = $list_room_detail_book;
    }
    if (isset($_POST['save-update-detail-bill-id'])) {
        update_detailbillAction();
    }
    load_view('detail_bookroom', $data);
}

//update
function update_detailbillAction() {
    if (isset($_POST['save-update-detail-bill-id'])) {
        // kiểm tra ngày trả phòng > hơn ngày nhận phòng
        $first_date = strtotime($_POST['detailbillCheckIn']);
        $second_date = strtotime($_POST['detailbillCheckOut']);
        $datediff = $second_date - $first_date;
        //Số ngày ở
        $num_day = floor(($datediff / (60 * 60 * 24)) + 1);
        if ($num_day <= 0) {
            echo "<script type='text/javascript'>";
            echo "alert('Ngày trả phòng không hợp lệ, vui lòng chọn lại')";
            echo "</script>";
        } else {
//            bắt đầu update lại detailbook_
            $id_detail = $_POST['detailbillId'];
            $data_detail_bill = array(
                'number_room' => $_POST['detailbillNumberRoom'],
                'check_in' => $_POST['detailbillCheckIn'],
                'check_out' => $_POST['detailbillCheckOut'],
                'number_adults' => $_POST['detailbill_Adults'],
                'number_childrens' => $_POST['detailbill_Childrens']
            );
            update_info_detail_bookroom($data_detail_bill, $id_detail);
            //update lại bill
//            lấy lại tổng tiền sua khi update lại detailbook
            $total_money_detailbook = get_total_money_detail_book($_GET['id']);
//            lấy tổng tiền trong phụ thu
            $total_money_surcharge=get_total_money_surcharge($_GET['id']);
            //Tổng tiền của bill sau khi lấy tiền của hai cái kia
            $total_money_bookroom=$total_money_detailbook['total_money']+$total_money_surcharge['total_money_surcharge'];
            //show_array($total_money);
            $data_bill = array(
                'total' => $total_money_bookroom
            );
            update_info_bill($data_bill, $_GET['id']);
            if (isset($_GET['page'])) {
                redirect('?mod=bill&controller=detail_bookroom&id=' . $_GET['id'] . '&' . $_GET['page']);
            } else {
                redirect('?mod=bill&controller=detail_bookroom&id=' . $_GET['id']);
            }
        }
    }
    if (isset($_POST['id'])) {
        //echo $_POST['id'];
        $detailbook_id = get_info_detailbook_id($_POST['id']);
        //lấy số phòng còn trống trong loại phòng
        $number = get_number_room_type_id($detailbook_id['room_type_id']);
        $result = array(
            'id' => $detailbook_id['id'],
            'check_in' => $detailbook_id['check_in'],
            'check_out' => $detailbook_id['check_out'],
            'number_room' => $detailbook_id['number_room'],
            'number_adults' => $detailbook_id['number_adults'],
            'number_childrens' => $detailbook_id['number_childrens'],
            'number_room_empty' => $number['Number_room']
        );
        echo json_encode($result);
    }
}

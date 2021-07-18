<?php

function construct() {
//    echo "Dùng chung, load đầu tiên";
    load_model('customer');
    load('lib', 'validation');
}

function indexAction() {
    echo "Không tìm thấy trang bạn tìm. Vui lòng click <a href='?'>Vào đây</a> để quay lại trang chủ";
}

function list_customerAction() {
    load('helper', 'state_customer');
    load('lib', 'pagging');
    //Đêm số dòng trên bảng database
    $num_rows = get_num_row("`customer`");
    //Số lượng bảng ghi trên bảng
    $num_per_page = 6;
    //Tổng số bảng ghi
    $total_row = $num_rows;
    //Tổng số trang
    $num_page = ceil($total_row / $num_per_page);
    //Tính chỉ số xuất của bản ghi cho từng page
    $page = isset($_GET['page']) ? (int) ($_GET['page']) : 1;
    //Chỉ số bắt đầu chạy
    $start = ($page - 1) * $num_per_page;
    $list_customer = get_list_room($start, $num_per_page, "");
    //đường dẫn theo từng pagging
    $get_pagging = get_pagging($num_page, $page, "?mod=customer&controller=customer&action=list_customer");
    //truyền dữ liệu từ controller qua cho view
    $data['list_customer'] = $list_customer;
    $data['start'] = $start;
    $data['get_pagging'] = $get_pagging;

    //update_room khi tồn tại nut lưu
    if (isset($_POST['save-update-customer-id'])) {
        update_customerAction();
    }
    //delete_room_id khi có tồn tại nút yes
//    if(isset($_POST['btn-delete-room'])){
//        delete_roomAction();
//    }
    //add_room khi tồn tại nút lưu của thêm phòng
//    if(isset($_POST['save-add-room-id'])){
//        add_roomAction();
//    }
    load_view('customer', $data);
}

function update_customerAction() {
    if (isset($_POST['save-update-customer-id'])) {

        $cus_code = $_POST['customerId'];
        $data = array(
            'name' => $_POST['customerName'],
            'phone' => $_POST['customerPhone'],
            'address' => $_POST['customerAddress'],
            'cmnd' => $_POST['customerCMND'],
            'email' => $_POST['customerEmail'],
            'state' => $_POST['customerState'],
        );
        update_info_customer_id($data, $cus_code);
        redirect("?mod=customer&controller=customer&action=list_customer");
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $customer_id = get_customer_id($id);
        //Alert
//        echo '<script language="javascript">';
//        echo 'alert("message successfully sent")';
//        echo '</script>';
        // end alert
        $result = array(
            'cus_code' => $customer_id['cus_code'],
            'name' => $customer_id['name'],
            'phone' => $customer_id['phone'],
            'address' => $customer_id['address'],
            'cmnd' => $customer_id['cmnd'],
            'email' => $customer_id['email'],
            'state' => $customer_id['state']
        );
        echo json_encode($result);
        //echo $customer_id['email'];
    }
}

function delete_roomAction() {
    if (isset($_POST['btn-delete-room'])) {
        $id = $_POST['roomId'];
        delete_room_id($id);
        redirect("?mod=room&controller=room&action=list_room");
    }
}

function add_roomAction() {
    if (isset($_POST['save-add-room-id'])) {
        $data = array(
            'roomNumber' => $_POST['roomNumber'],
            'typeCode' => $_POST['roomType'],
            'state' => $_POST['roomState']
        );
        add_room($data);
        redirect("?mod=room&controller=room&action=list_room");
    }
}

<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
    load('helper', 'state_bill');
    load('lib', 'pagging');
    //Đêm số dòng trên bảng database
    $num_rows = get_num_row("`bookroom`");
    //Số lượng bảng ghi trên bảng
    $num_per_page = 3;
    //Tổng số bảng ghi
    $total_row = $num_rows;
    //Tổng số trang
    $num_page = ceil($total_row / $num_per_page);
    //Tính chỉ số xuất của bản ghi cho từng page
    $page = isset($_GET['page']) ? (int) ($_GET['page']) : 1;
    //Chỉ số bắt đầu chạy
    $start = ($page - 1) * $num_per_page;
    $list_bookroom = get_list_bookroom($start, $num_per_page, "bookroom.cus_code=customer.cus_code");
    //đường dẫn theo từng pagging
    $get_pagging = get_pagging($num_page, $page, "?mod=bill");
    //truyền dữ liệu từ controller qua cho view
    $data['list_bookroom'] = $list_bookroom;
    $data['start'] = $start;
    $data['get_pagging'] = $get_pagging;

    //Lấy danh sach sản phẩm
    $get_list_product = get_list_product();
    $data['get_list_product'] = $get_list_product;
    //=========================================================================
    //Thêm phụ thu
    if (isset($_POST['save-add-product'])) {
        if ($_POST['surcharge_Name'] != 1) {
            $data = array(
                'booking_code' => $_POST['surcharge_Booking_code'],
                'id_product' => $_POST['surcharge_Name'],
                'number' => $_POST['surcharge_Number'],
                'price' => 0,
                'sum_money' => 0
            );
            $id_surcharge = add_surcharge($data);
            //Lấy id phụ thu mới thêm để cập nhật thêm giá và tổng tiền
            //lấy toàn bộ thông tin liên quan đến phụ thu, hóa đơn, và sản phẩm
            $get_info_surcharge = get_info_surcharge($id_surcharge);
            //cập nhật
            $sum_money = $get_info_surcharge['number'] * $get_info_surcharge['price'];
            $data_up_surcharge = array(
                'price' => $get_info_surcharge['price'],
                'sum_money' => $sum_money
            );
            update_info_surcharge($data_up_surcharge, $id_surcharge);
            //sau thi update thành công sẽ pải cập nhật lại bookroom
            //Lấy tiền cũ của book room có id
            $get_info_bookroom = get_info_bookroom($_POST['surcharge_Booking_code']);
            $total_bookroom = $get_info_bookroom['total'] + $sum_money;
            $data_up_bookroom = array(
                'total' => $total_bookroom
            );
            update_info_bookroom($data_up_bookroom, $_POST['surcharge_Booking_code']);

            if (isset($_GET['page'])) {
                redirect("?mod=bill&page={$_GET['page']}");
            } else {
                redirect("?mod=bill");
            }
        } else if ($_POST['surcharge_Name'] == 1 && $_POST['surcharge_Number'] < 4) {
            $data = array(
                'booking_code' => $_POST['surcharge_Booking_code'],
                'id_product' => $_POST['surcharge_Name'],
                'number' => $_POST['surcharge_Number'],
                'price' => 0,
                'sum_money' => 0
            );
            $id_surcharge = add_surcharge($data);
            //Lấy id phụ thu mới thêm để cập nhật thêm giá và tổng tiền
            //lấy toàn bộ thông tin liên quan đến phụ thu, hóa đơn, và sản phẩm
            $get_info_surcharge = get_info_surcharge($id_surcharge);
            //cập nhật
            $sum_money = $get_info_surcharge['number'] * $get_info_surcharge['price'];
            $data_up_surcharge = array(
                'price' => $get_info_surcharge['price'],
                'sum_money' => $sum_money
            );
            update_info_surcharge($data_up_surcharge, $id_surcharge);
            //sau thi update thành công sẽ pải cập nhật lại bookroom
            //Lấy tiền cũ của book room có id
            $get_info_bookroom = get_info_bookroom($_POST['surcharge_Booking_code']);
            $total_bookroom = $get_info_bookroom['total'] + $sum_money;
            $data_up_bookroom = array(
                'total' => $total_bookroom
            );
            update_info_bookroom($data_up_bookroom, $_POST['surcharge_Booking_code']);

            if (isset($_GET['page'])) {
                redirect("?mod=bill&page={$_GET['page']}");
            } else {
                redirect("?mod=bill");
            }
        } else {
            echo_alert("giờ phụ thu phải nhỏ hơn 4 tiếng");
        }
    }
    //=========================================================================
    //update_bill khi tồn tại nut lưu
    if (isset($_POST['save-update-bill-id'])) {
        updateAction();
    }
    load_view('index', $data);
}

function updateAction() {
    if (isset($_POST['save-update-bill-id'])) {
        $id = $_POST['billId'];
        $data_bill = array(
            'state' => $_POST['billState'],
        );
        update_info_bill($data_bill, $id);
        if (isset($_GET['page'])) {
            redirect("?mod=bill&page={$_GET['page']}");
        } else {
            redirect("?mod=bill");
        }
    }
    if (isset($_POST['id'])) {
        //echo $_POST['id'];
        $bookroom_id = get_bookroom_id($_POST['id']);
        $result = array(
            'id' => $bookroom_id['id'],
            'name' => $bookroom_id['name'],
            'total' => $bookroom_id['total'],
            'state' => $bookroom_id['state'],
        );
        echo json_encode($result);
    }
}

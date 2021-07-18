<?php

function construct() {
//    echo "Dùng chung, load đầu tiên";
    load_model('index');
    //load('helper', 'data');
}

function indexAction() {

    load('helper', 'format');
    load('lib', 'pagging');
    //Đêm số dòng trên bảng database
    $num_rows = get_num_row("`product`");
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
    $list_product = get_list_product($start, $num_per_page);
    //đường dẫn theo từng pagging
    $get_pagging = get_pagging($num_page, $page, "?mod=product");
    //truyền dữ liệu từ controller qua cho view
    $data['list_product'] = $list_product;
    $data['start'] = $start;
    $data['get_pagging'] = $get_pagging;
    
    //==========================================================================
    //Thêm product
    if (isset($_POST['save-add-product'])) {
        $data = array(
            'name_product' => $_POST['product_Name'],
            'price' => $_POST['product_Price'],
            'number' => $_POST['product_Number']
        );
        add_product($data);
        echo_alert("Thêm sản phẩm thành công");
        redirect("?mod=product");
    }
    //==========================================================================
    ////==========================================================================
    //Xóa product
    if (isset($_POST['btn-delete-product'])) {
        $id = $_POST['productId'];
        delete_product_id($id);
        redirect("?mod=product");
    }
    //==========================================================================
    //update_room khi tồn tại nut lưu
    if (isset($_POST['save-update-product-id'])) {
        update_productAction();
    }
    load_view('index', $data);
}

function update_productAction() {
    if (isset($_POST['save-update-product-id'])) {
        $product_id = $_POST['productId'];
        $data = array(
            'name_product' => $_POST['productName'],
            'price' => $_POST['productPrice'],
            'number' => $_POST['productNumber']
        );
        update_info_product_id($data, $product_id);
        redirect("?mod=product");
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $product_id = get_product_id($id);
        $result = array(
            'id' => $product_id['id'],
            'name_product' => $product_id['name_product'],
            'price' => $product_id['price'],
            'number' => $product_id['number']
        );
        echo json_encode($result);
    }
}

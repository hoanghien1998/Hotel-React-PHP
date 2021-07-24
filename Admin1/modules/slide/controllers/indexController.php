<?php

function construct() {
    load_model('index');
}

function indexAction() {

    load('helper', 'format');
    load('lib', 'pagging');
    //Đêm số dòng trên bảng database
    $num_rows = get_num_row("`slide`");
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
    $list_slide = get_list_slide($start, $num_per_page);
    //đường dẫn theo từng pagging
    $get_pagging = get_pagging($num_page, $page, "?mod=slide");
    //truyền dữ liệu từ controller qua cho view
    $data['list_slide'] = $list_slide;
    $data['start'] = $start;
    $data['get_pagging'] = $get_pagging;
    
    //==========================================================================
    //Thêm product
    if (isset($_POST['save-add-slide'])) {
        $message_submit = add_slideAction();
        $data['message_submit'] = $message_submit;
    }
    //update_slide khi tồn tại nut lưu
    if (isset($_POST['save-up-slide'])) {
        $message_submit = update_slideAction();
        $data['message_submit'] = $message_submit;
    }

    //delete_slide khi tồn tại nut yes
    if (isset($_POST['btn-delete-slide'])) {
        $message_submit = delete_slideAction();
        $data['message_submit'] = $message_submit;
    }
    
    load_view('index', $data);
}

function add_slideAction() {
    //Kiểm tra tồn tại nút submit add
    if (isset($_POST['save-add-slide'])) {
        global $error;
        $data= array();
        //kiểm tra tồn tại file ảnh không
        if (isset($_FILES['slide_add_image'])) {
            $imagetype = $_FILES['slide_add_image']['type'];
            if ($imagetype != "image/png" && $imagetype != "image/jpg" && $imagetype != "image/jpeg" && $imagetype != "image/git") {
                return $error['image'] = "File không đúng định dạng";
            }else{
                if ($_FILES['slide_add_image']['size'] > 1000000) {
                    return $error['image'] = "Kích thước ảnh quá lớn";
                }else{
                    move_uploaded_file($_FILES['slide_add_image']['tmp_name'], 'C:/xampp/htdocs/Hotel/Admin/public/images/slide/' . $_FILES['slide_add_image']['name']);
                    $data['image']=$_FILES['slide_add_image']['name'];
                }
            }
        }
        if(empty($_POST['slide_add_dateend']) || empty($_POST['slide_add_datestart'])){
            return $message_submit = "Vui lòng nhập đầy đủ thông tin";
        }else{
            $data['date_start']=$_POST['slide_add_datestart'];
            $data['date_end']=$_POST['slide_add_dateend'];
            // echo $data;
            insert_info_slide($data);
            if (isset($_GET['page'])) {
                redirect("?mod=slide&page={$_GET['page']}");
            } else {
                redirect("?mod=slide");
            }
        }
    }
}


//UPDATE SERVICE TYPE
function update_slideAction(){
    //Kiểm tra sự tồn tại của nút submit update service type
    if(isset($_POST['save-up-slide'])){
        global $error;
        $data= array();
        //kiểm tra tồn tại file ảnh không
        if (isset($_FILES['slide_up_image'])) {
            $imagetype = $_FILES['slide_up_image']['type'];
            if ($imagetype != "image/png" && $imagetype != "image/jpg" && $imagetype != "image/jpeg" && $imagetype != "image/git") {
                return $error['image'] = "Không đúng định dạng";
            }else{
                if ($_FILES['slide_up_image']['size'] > 1000000) {
                    return $error['image'] = "Kích thước ảnh quá lớn";
                }else{
                    move_uploaded_file($_FILES['slide_up_image']['tmp_name'], 'C:/xampp/htdocs/Hotel/Admin/public/images/slide/' . $_FILES['slide_up_image']['name']);
                    $data['image']=$_FILES['slide_up_image']['name'];
                }
            }
        }
        if(empty($_POST['slide_up_datestart']) || empty($_POST['slide_up_dateend'])){
            return $message_submit = "Vui lòng nhập đầy đủ thông tin";
        }else{
            $data['date_start']=$_POST['slide_up_datestart'];
            $data['date_end']=$_POST['slide_up_dateend'];
            // echo $data;
            update_info_slide_id($data, $_POST['slide_up_id']);
            if (isset($_GET['page'])) {
                redirect("?mod=slide&page={$_GET['page']}");
            } else {
                redirect("?mod=slide");
            }
        }
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $slide_id = get_slide_id($id);
        $result = array(
            'id_slide' => $slide_id['id_slide'],
            'date_start' => $slide_id['date_start'],
            'date_end' => $slide_id['date_end'],
        );
        echo json_encode($result);
    }
}

//UPDATE SLIDE
function delete_slideAction(){
    if(isset($_POST['btn-delete-slide'])){
        $id = $_POST['slide_del_id'];
        $page = $_GET['page'];
        delete_slide_id($id);
        redirect("?mod=slide");
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $slide_id = get_slide_id($id);
        $result = array(
            'id_slide' => $slide_id['id_slide'],
            'date_start' => $slide_id['date_start'],
            'date_end' => $slide_id['date_end'],
        );
        echo json_encode($result);
    }
}

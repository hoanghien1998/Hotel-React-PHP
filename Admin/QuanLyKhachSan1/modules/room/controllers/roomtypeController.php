<?php

function construct() {
//    echo "Dùng chung, load đầu tiên";
    load_model('roomtype');
    load('lib', 'validation');
}

function indexAction() {
    echo "Không tìm thấy trang bạn tìm. Vui lòng click <a href='?'>Vào đây</a> để quay lại trang chủ";
}

function list_room_typeAction() {
    load('helper', 'format');
    load('lib', 'pagging');
    //Đêm số dòng trên bảng database
    $num_rows = get_num_row("`roomtype`");
    //Số lượng bảng ghi trên bảng
    $num_per_page = 4;
    //Tổng số bảng ghi
    $total_row = $num_rows;
    //Tổng số trang
    $num_page = ceil($total_row / $num_per_page);
    //Tính chỉ số xuất của bản ghi cho từng page
    $page = isset($_GET['page']) ? (int) ($_GET['page']) : 1;
    //Chỉ số bắt đầu chạy
    $start = ($page - 1) * $num_per_page;
    $list_rooms_type = get_list_roomtype($start, $num_per_page);
    //đường dẫn theo từng pagging
    $get_pagging = get_pagging($num_page, $page, "?mod=room&controller=roomtype&action=list_room_type");
    //truyền dữ liệu từ controller qua cho view
    $data['list_rooms_type'] = $list_rooms_type;
    $data['start'] = $start;
    $data['get_pagging'] = $get_pagging;
    $data['page'] = $page;

    //update_room khi tồn tại nut lưu
    if (isset($_POST['save-update-room-type-id'])) {
        update_room_typeAction();
    }
    //delete_room_id khi có tồn tại nút yes
    if (isset($_POST['btn-delete-room-type'])) {
        delete_room_typeAction();
    }
    //add_room khi tồn tại nút lưu của thêm phòng
    if (isset($_POST['save-add-room-type-id'])) {
        $message_submit = add_room_typeAction();
        $data['message_submit'] = $message_submit;
    }
    load_view('roomtype', $data);
}

function update_room_typeAction() {

    if (isset($_POST['save-update-room-type-id'])) {
        $room_id = $_POST['roomtypeId'];
        global $error;
        if (isset($_FILES['roomtypeImage']) && $_FILES['roomtypeImage']['error'] == 0) {
            $imagetype = $_FILES['roomtypeImage']['type'];
            if ($imagetype != "image/png" && $imagetype != "image/jpg" && $imagetype != "image/jpeg" && $imagetype != "image/git") {
                return $error['image'] = "Không đúng định dạng";
            } else {
                if ($_FILES['roomtypeImage']['size'] > 1000000) {
                    return $error['image'] = "Kích thước ảnh quá lớn";
                } else {
                    if (empty($_POST['roomtypeName']) || empty($_POST['roomtypePrice'])) {
                        return $message_submit = "Vui lòng nhập đầy đủ thông tin";
                    } else {
                        move_uploaded_file($_FILES['roomtypeImage']['tmp_name'], 'C:/xampp/htdocs/Pro_Hotel/Admin/QuanLyKhachSan1/public/images/room/' . $_FILES['roomtypeImage']['name']);
                        $data = array(
                            'name' => $_POST['roomtypeName'],
                            'price' => $_POST['roomtypePrice'],
                            'image' => $_FILES['roomtypeImage']['name']
                        );
                        update_info_room_type_id($data, $room_id);
//                        redirect("?mod=room&controller=roomtype&action=list_room_type");
                        if (isset($_GET['page'])) {
                            redirect("?mod=room&controller=roomtype&action=list_room_type&page={$_GET['page']}");
                        } else {
                            redirect("?mod=room&controller=roomtype&action=list_room_type");
                        }
                    }
                }
            }
        } else {
            if (empty($_POST['roomtypeName']) || empty($_POST['roomtypePrice'])) {
                return $message_submit = "Vui lòng nhập đầy đủ thông tin";
            } else {
                $data = array(
                    'name' => $_POST['roomtypeName'],
                    'price' => $_POST['roomtypePrice']
                );
                update_info_room_type_id($data, $room_id);
//                redirect("?mod=room&controller=roomtype&action=list_room_type");
                if (isset($_GET['page'])) {
                    redirect("?mod=room&controller=roomtype&action=list_room_type&page={$_GET['page']}");
                } else {
                    redirect("?mod=room&controller=roomtype&action=list_room_type");
                }
            }
        }
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $room_type_id = get_room_type_id($id);
        $result = array(
            'id' => $room_type_id['id'],
            'name' => $room_type_id['name'],
            'price' => $room_type_id['price'],
                //'image' => $room_type_id['image']
        );
        echo json_encode($result);
    }
}

function delete_room_typeAction() {
    if (isset($_POST['btn-delete-room-type'])) {
        $id = $_POST['roomtypeId'];
        $page = $_GET['page'];
        delete_room_type_id($id);
        redirect("?mod=room&controller=roomtype&action=list_room_type&page=$page");
    }
}

function add_room_typeAction() {
//echo_alert("hihi");
    if (isset($_POST['save-add-room-type-id'])) {
//        $hihi="Thêm thành công hay không chưa biết";
//        return $hihi;
        global $error;
        if (isset($_FILES['roomtypeImageadd']['name']) && $_FILES['roomtypeImageadd']['error'] == 0) {
            $imagetype = $_FILES['roomtypeImageadd']['type'];
            if ($imagetype != "image/png" && $imagetype != "image/jpg" && $imagetype != "image/jpeg" && $imagetype != "image/git") {
                return $error['image'] = "Không đúng định dạng";
            } else {
                if ($_FILES['roomtypeImageadd']['size'] > 1000000) {
                    return $error['image'] = "Kích thước ảnh quá lớn";
                } else {
                    if (empty($_POST['roomtypeNameadd']) || empty($_POST['roomtypePriceadd'])) {
                        return $message_submit = "Vui lòng nhập đầy đủ thông tin";
                    } else {
                        move_uploaded_file($_FILES['roomtypeImageadd']['tmp_name'], 'C:/xampp/htdocs/Pro_Hotel/Admin/QuanLyKhachSan1/public/images/room/' . $_FILES['roomtypeImage']['name']);
                        $data = array(
                            'name' => $_POST['roomtypeNameadd'],
                            'price' => $_POST['roomtypePriceadd'],
                            'image' => $_FILES['roomtypeImageadd']['name']
                        );
                        insert_info_room_type($data);
                        if (isset($_GET['page'])) {
                            redirect("?mod=room&controller=roomtype&action=list_room_type&page={$_GET['page']}");
                        } else {
                            redirect("?mod=room&controller=roomtype&action=list_room_type");
                        }
                    }
                }
            }
        } else {
            if (empty($_POST['roomtypeNameadd']) || empty($_POST['roomtypePriceadd'])) {
                return $message_submit = "Vui lòng nhập đầy đủ thông tin";
            } else {
                $data = array(
                    'name' => $_POST['roomtypeNameadd'],
                    'price' => $_POST['roomtypePriceadd'],
                );
                insert_info_room_type($data);
                if (isset($_GET['page'])) {
                    redirect("?mod=room&controller=roomtype&action=list_room_type&page={$_GET['page']}");
                } else {
                    redirect("?mod=room&controller=roomtype&action=list_room_type");
                }
            }
        }
    }
}

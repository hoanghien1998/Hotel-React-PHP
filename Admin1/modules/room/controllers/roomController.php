<?php

function construct() {
//    echo "Dùng chung, load đầu tiên";
    load_model('room');
    load('lib', 'validation');
}

function indexAction() {
    echo "Không tìm thấy trang bạn tìm. Vui lòng click <a href='?'>Vào đây</a> để quay lại trang chủ";
}

function list_roomAction() {
    load('helper', 'format');
    load('lib', 'pagging');
    //Đêm số dòng trên bảng database
    $num_rows = get_num_row("`room`");
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
    $list_rooms = get_list_room($start, $num_per_page, "room.typeCode=roomtype.id");
    //đường dẫn theo từng pagging
    $get_pagging = get_pagging($num_page, $page, "?mod=room&controller=room&action=list_room");
    //truyền dữ liệu từ controller qua cho view
    $data['list_rooms'] = $list_rooms;
    $data['start'] = $start;
    $data['get_pagging'] = $get_pagging;
    //truyền loại phòng từ database vô controller và đẩy qua view
    $list_room_type = get_list_room_type();
    $data['list_room_type'] = $list_room_type;


    //update_room khi tồn tại nut lưu
    if (isset($_POST['save-update-room-id'])) {
        update_roomAction();
    }
    //delete_room_id khi có tồn tại nút yes
    if (isset($_POST['btn-delete-room'])) {
        delete_roomAction();
    }
    //add_room khi tồn tại nút lưu của thêm phòng
    if (isset($_POST['save-add-room-id'])) {
        add_roomAction();
    }
    if (isset($_POST['load_state'])) {
        //Kiểm tra ngày hôm nay có những phòng nào đc đặt, nếu đặt thì cho phòng đó có trạng thái là đã đặt
        $list_room_detailbook = get_list_room_detail_book_room();
        //Kiểm tra xem các phòng này đã chuyển thành trạng thái là 1 chưa nếu chưa thì update
        if (!empty($list_room_detailbook)) {
            foreach ($list_room_detailbook as $room) {
                if ($room['state'] == 0) {
                    $data_room = array(
                        'state' => 1
                    );
                    update_room_to_detailbook_room($data_room, $room['id']);
                }
            }
        }

        //Kiểm tra ngày hôm nay có phòng nào trả không, nếu có thì cho trangjthais phòng đó =0
        $list_room_detailbook_check_out = get_list_room_detail_book_room_check_out();
        //Kiểm tra xem các phòng này đã chuyển thành trạng thái là 0 chưa nếu chưa thì update
        if (!empty($list_room_detailbook_check_out)) {
            foreach ($list_room_detailbook_check_out as $room) {
                if ($room['state'] == 1) {
                    $data_room_check_out = array(
                        'state' => 0
                    );
                    update_room_to_detailbook_room($data_room_check_out, $room['id']);
                }
            }
        }
        if (isset($_GET['page'])) {
            redirect("?mod=room&controller=room&action=list_room&page={$_GET['page']}");
        } else {
            redirect("?mod=room&controller=room&action=list_room");
        }
    }
    load_view('room', $data);
}

function update_roomAction() {
    if (isset($_POST['save-update-room-id'])) {
        $room_id = $_POST['roomId'];
        $data = array(
            'roomNumber' => $_POST['roomNumber'],
            'typeCode' => $_POST['roomType'],
            'state' => $_POST['roomState']
        );
        update_info_room_id($data, $room_id);
        redirect("?mod=room&controller=room&action=list_room");
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $room_id = get_room_id($id);
        $result = array(
            'id' => $room_id['id'],
            'roomNuber' => $room_id['roomNumber'],
            'typeCode' => $room_id['typeCode'],
            'state' => $room_id['state']
        );
        echo json_encode($result);
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

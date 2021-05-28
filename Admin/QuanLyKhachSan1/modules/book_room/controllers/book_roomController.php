<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('book_room');
    load('lib','validation');
}

function indexAction() {
    //Lấy thông tin trong giỏ hàng
    $get_info_cart = get_info_cart();
    $data['get_info_cart'] = $get_info_cart;
    //TEST DỮ LIỆU
//    $c=array(1,2,3,4,5);
////    echo $c[3];
//    for ($i = 0; $i < 3; $i++) {
//        //Random lấy id_room bất kỳ
//        $rand_keys = array_rand($c, 1);
//        $id_room = $c[$rand_keys];
//        echo array_rand($c, 1);
//        echo $id_room;
//        unset($c[$rand_keys]);
//        show_array($c);
//    }
    //END TEST DỮ LIỆU
    if (isset($_POST['btn-book-room'])) {
        global $error,$email,$fullname,$cmnd,$phone, $address;
        //Kiểm tra gmail
        if (empty($_POST['email_BookRoom'])) {
            $error['email'] = "Email không được để trống";
        } else {
            if (!is_email($_POST['email_BookRoom'])) {
                $error['email'] = "Email đúng định dạng, vui lòng nhập lại";
            } else {
                $email = $_POST['email_BookRoom'];
            }
        }
        //Kiểm tra fullname
        if (empty($_POST['name_BookRoom'])) {
            $error['fullname'] = "Không được để trống họ và tên";
        } else {
            $fullname = $_POST['name_BookRoom'];
        }
        //Kiểm tra CMND
        if (empty($_POST['cmnd_BookRoom'])) {
            $error['cmnd'] = "CMND không được để trống";
        } else {
            if (!is_cmnd($_POST['cmnd_BookRoom'])) {
                $error['cmnd'] = "CMND không đủ ký tự, vui lòng nhập lại";
            } else {
                $cmnd = $_POST['cmnd_BookRoom'];
            }
        }
        //Kiểm tra SDT
        if (empty($_POST['phone_BookRoom'])) {
            $error['phone'] = "SDT không được để trống";
        } else {
            if (!is_phone($_POST['phone_BookRoom'])) {
                $error['phone'] = "SDT không đủ ký tự, vui lòng nhập lại";
            } else {
                $phone = $_POST['phone_BookRoom'];
            }
        }
        //Kiểm tra Address
        if (empty($_POST['address_BookRoom'])) {
            $error['address'] = "Không được để trống địa chỉ";
        } else {
            $address = $_POST['address_BookRoom'];
        }

        //Kết luận
        if (empty($error)) {
            //tổng tiền cho many day
            $sum_money_many_day = 0;
            foreach ($get_info_cart as $info_cart) {
                $sum_money_many_day = $sum_money_many_day + $info_cart['total_sum'];
            }
            if (get_num_row("`customer`", $_POST['cmnd_BookRoom']) == 0) {
                // thêm khách hàng
                $data_customer = array(
                    'name' => $_POST['name_BookRoom'],
                    'phone' => $_POST['phone_BookRoom'],
                    'address' => $_POST['address_BookRoom'],
                    'cmnd' => $_POST['cmnd_BookRoom'],
                    'email' => $_POST['email_BookRoom'],
                );
                //lấy id customer truyền vô database book room
                $id_customer = add_customer($data_customer);

                //Thêm book_room
                $data_book_room = array(
                    'cus_code' => $id_customer,
                    'total' => $sum_money_many_day,
                    'state' => 0
                );
                //lấy id book room truyền vô database bảng detail book room
                $id_bookroom = add_book_room($data_book_room);

                //thêm detail book room
                //chạy vòng lap for để thêm từng loại phòng vô trong bảng có cùng book room
                foreach ($get_info_cart as $info_cart) {
                    $data_detail_book = array(
                        'booking_code' => $id_bookroom,
                        'room_type_id' => $info_cart['id_roomtype'],
                        'price' => $info_cart['price'],
                        'number_room' => $info_cart['number_room'],
                        'date_set' => date("Y-m-d"),
                        'check_in' => $info_cart['check_in'],
                        'check_out' => $info_cart['check_out'],
                        'number_adults' => $info_cart['number_adults'],
                        'number_childrens' => $info_cart['number_childrens'],
                    );
                    //Lấy id_detail_book mà mình vừa mới thêm vào csdl
                    $id_detail_book = add_detail_book($data_detail_book);
                    //Kiểm tra ngày nhập vào đã có phòng nào dc đặt chưa theo loại phòng
                    $list_room_detail_book = get_list_room_detail_book($info_cart['check_in'], $info_cart['check_out'], $info_cart['id_roomtype']);
                    //Lấy danh sách tất cả các phòng theo loại phòng
                    $list_room_of_room_type = get_list_room_of_room_type($info_cart['id_roomtype']);
                    //Khai báo mảng c sẽ chứa các id room còn trống
                    $c = array();
                    $a = array();
                    $b = array();
                    if (empty($list_room_detail_book)) {
                        foreach ($list_room_of_room_type as $rooms) {
                            $c[] = $rooms['id_room'];
                        }
                    } else {
                        foreach ($list_room_of_room_type as $rooms) {
                            $a[] = $rooms['id_room'];
                        }
                        foreach ($list_room_detail_book as $rooms) {
                            $b[] = $rooms['room_id'];
                        }
                        $c = array_diff($a, $b);
                    }
                    for ($i = 0; $i < $info_cart['number_room']; $i++) {
                        //Random lấy id_room bất kỳ
                        $rand_keys = array_rand($c, 1);
                        $id_room = $c[$rand_keys];
                        //thêm id_room và detail_book_id vào bảng detailbook_room
                        $data_detail_book_room = array(
                            'detail_book_id' => $id_detail_book,
                            'room_id' => $id_room
                        );
                        add_detailbool_room($data_detail_book_room);
                        //Xóa cái mã id_room ra khỏi mảng để random tiếp nếu người đặt đặt số phòng >1
                        unset($c[$rand_keys]);
                    }
                }

                detete_all_cart('cart');
                redirect("?mod=book_room");
            } else {
                //lấy id customer truyền vô database book room
                $id_customer = get_id_customer($_POST['cmnd_BookRoom']);

                //Thêm book_room
                $data_book_room = array(
                    'cus_code' => $id_customer['cus_code'],
                    'total' => $sum_money_many_day,
                    'state' => 0
                );
                //lấy id book room truyền vô database bảng detail book room
                $id_bookroom = add_book_room($data_book_room);
                //thêm detail book room
                //chạy vòng lap for để thêm từng loại phòng vô trong ảng có cùng book room
                foreach ($get_info_cart as $info_cart) {
                    $data_detail_book = array(
                        'booking_code' => $id_bookroom,
                        'room_type_id' => $info_cart['id_roomtype'],
                        'price' => $info_cart['price'],
                        'number_room' => $info_cart['number_room'],
                        'date_set' => date("Y-m-d"),
                        'check_in' => $info_cart['check_in'],
                        'check_out' => $info_cart['check_out'],
                        'number_adults' => $info_cart['number_adults'],
                        'number_childrens' => $info_cart['number_childrens'],
                    );
                    //Sửa lại ở đây
                    //Lấy id_detail_book mà mình vừa mới thêm vào csdl
                    $id_detail_book = add_detail_book($data_detail_book);
                    //Kiểm tra ngày nhập vào đã có phòng nào dc đặt chưa theo loại phòng
                    $list_room_detail_book = get_list_room_detail_book($info_cart['check_in'], $info_cart['check_out'], $info_cart['id_roomtype']);
                    //Lấy danh sách tất cả các phòng theo loại phòng
                    $list_room_of_room_type = get_list_room_of_room_type($info_cart['id_roomtype']);
                    //Khai báo mảng c sẽ chứa các id room còn trống
                    $c = array();
                    $a = array();
                    $b = array();
                    if (empty($list_room_detail_book)) {
                        foreach ($list_room_of_room_type as $rooms) {
                            $c[] = $rooms['id_room'];
                        }
                    } else {
                        foreach ($list_room_of_room_type as $rooms) {
                            $a[] = $rooms['id_room'];
                        }
                        foreach ($list_room_detail_book as $rooms) {
                            $b[] = $rooms['room_id'];
                        }
                        $c = array_diff($a, $b);
                    }
                    for ($i = 0; $i < $info_cart['number_room']; $i++) {
                        //Random lấy id_room bất kỳ
                        $rand_keys = array_rand($c, 1);
                        $id_room = $c[$rand_keys];
                        //thêm id_room và detail_book_id vào bảng detailbook_room
                        $data_detail_book_room = array(
                            'detail_book_id' => $id_detail_book,
                            'room_id' => $id_room
                        );
                        add_detailbool_room($data_detail_book_room);
                        //Xóa cái mã id_room ra khỏi mảng để random tiếp nếu người đặt đặt số phòng >1
                        unset($c[$rand_keys]);
                    }
                    //KÊT THÚC SỬA
                    //add_detail_book($data_detail_book);
                    //SỬa ở trên nhớ sửa ở đây nữa
                }

                detete_all_cart('cart');
                redirect("?mod=book_room");
            }
        }
    }
    load_view('book_room', $data);
}

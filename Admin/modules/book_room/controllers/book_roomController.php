<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('book_room');
    load('lib','validation');
}

function indexAction() {
    //Lấy thông tin trong giỏ hàng
    $get_info_cart = get_info_cart();
    // Lấy thông tin ưu đãi
    $get_info_pricediscount=get_info_pricediscount();

    // Tổng tiền
    $sum_money_many_day=0;
    // số tiền pải trả
    $total_money_discount=0;
    // tổng số tiền đc giảm
    $be_discount_money=0;

    
    foreach ($get_info_cart as $info_cart){
        // ngày đặt và ngày trả nằm ngoài ưu đãi
        if((strtotime($info_cart["check_in"])<strtotime($get_info_pricediscount["date_start"])
            && strtotime($info_cart["check_out"])<strtotime($get_info_pricediscount["date_start"]))
            || (strtotime($info_cart["check_in"])>strtotime($get_info_pricediscount["date_end"])
            && strtotime($info_cart["check_out"])>strtotime($get_info_pricediscount["date_end"])))
        {
            $sum_money_many_day= $sum_money_many_day+ $info_cart['total_sum'];
        }
        else{
            // Ngày trả và ngày đăt nằm trong khoảng ngày ưu đãi
            if(strtotime($info_cart["check_in"])>=strtotime($get_info_pricediscount["date_start"])
            && strtotime($info_cart["check_out"])<=strtotime($get_info_pricediscount["date_end"])){
                $sum_money_many_day= $sum_money_many_day+ $info_cart['total_sum'];
                // Số tiền sau khi ưu đãi cho từng loại phòng
                $discount_money=($info_cart['total_sum']*$get_info_pricediscount["price_discount"])/100;
                // Tổng số tiền dc giảm
                $be_discount_money=$be_discount_money+$discount_money;
                
            }

            // ngày đặt không nằm trong khoảng đó, ngày trả nằm trong khoảng
            if(strtotime($info_cart["check_in"])<=strtotime($get_info_pricediscount["date_start"])
            && strtotime($info_cart["check_out"])<=strtotime($get_info_pricediscount["date_end"])
            && strtotime($info_cart["check_out"])>=strtotime($get_info_pricediscount["date_start"])){
                $sum_money_many_day= $sum_money_many_day+ $info_cart['total_sum'];
                // tính từ ngày trả đến ngày đặt bao nhiu ngày
                $total_date=$info_cart["number_day"];
                // tính từ ngày đặt đến ngày bắt đầu ưu đãi bao nhiu ngày
                $first_date=strtotime($info_cart["check_in"]);
                $second_date=strtotime($get_info_pricediscount["date_start"]);
                $datediff=abs($first_date-$second_date);
                $date_nodiscount=floor($datediff/(60*60*24));
                // tính từ ngày bắt đầu ưu đãi đến ngày trả bao nhiu ngày
                $date_discount=$total_date-$date_nodiscount;
                // Số tiền sau khi ưu đãi cho từng loại phòng
                $discount_money=($date_discount*$info_cart["price"]*$get_info_pricediscount["price_discount"]*$info_cart["number_room"])/100;
                // Tổng số tiền dc giảm
                $be_discount_money=$be_discount_money+$discount_money;

            }

            // Ngày đặt nằm trong khoảng đó, ngày trả nằm ngoài khoảng đó
            if(strtotime($info_cart["check_in"])>=strtotime($get_info_pricediscount["date_start"])
            && strtotime($info_cart["check_in"])<=strtotime($get_info_pricediscount["date_end"])
            && strtotime($info_cart["check_out"])>=strtotime($get_info_pricediscount["date_end"])){
                $sum_money_many_day= $sum_money_many_day+ $info_cart['total_sum'];
                // tính từ ngày trả đến ngày đặt bao nhiu ngày
                $total_date=$info_cart["number_day"];
                // tính từ ngày đặt đến ngày kết thúc ưu đãi bao nhiu ngày
                $first_date=strtotime($info_cart["check_in"]);
                $second_date=strtotime($get_info_pricediscount["date_end"]);
                $datediff=abs($first_date-$second_date);
                $date_discount=floor($datediff/(60*60*24))+1;
                // tính từ ngày kết thúc ưu đãi đến ngày trả bao nhiu ngày
                $date_nodiscount=$total_date-$date_discount;
                // Số tiền sau khi ưu đãi cho từng loại phòng
                $discount_money=($date_discount*$info_cart["price"]*$get_info_pricediscount["price_discount"]*$info_cart["number_room"])/100;
                // Tổng số tiền dc giảm
                $be_discount_money=$be_discount_money+$discount_money;
            }

            // Ngày đặt < ngày bắt đầu, ngày kết thúc < ngày trả
            if(strtotime($info_cart["check_in"])<=strtotime($get_info_pricediscount["date_start"])
            && strtotime($info_cart["check_out"])>=strtotime($get_info_pricediscount["date_end"])){
                $sum_money_many_day= $sum_money_many_day+ $info_cart['total_sum'];
                // tính từ ngày trả đến ngày đặt bao nhiu ngày
                $total_date=$info_cart["number_day"];
                // tính từ ngày đặt đến ngày bắt đầu ưu đãi bao nhiu ngày
                $first_date=strtotime($info_cart["check_in"]);
                $second_date=strtotime($get_info_pricediscount["date_start"]);
                $datediff=abs($first_date-$second_date);
                $date_nodiscount=floor($datediff/(60*60*24));
                // tính từ ngày trả đến ngày kết thúc ưu đãi bao nhiu ngày
                $first_date1=strtotime($info_cart["check_out"]);
                $second_date1=strtotime($get_info_pricediscount["date_end"]);
                $datediff1=abs($first_date1-$second_date1);
                $date_nodiscount1=floor($datediff1/(60*60*24));
                // tính từ ngày kết thúc ưu đãi đến ngày bắt đầu ưu đãi bao nhiu ngày
                $date_discount=$total_date-$date_nodiscount-$date_nodiscount1;
                // Số tiền sau khi ưu đãi cho từng loại phòng
                $discount_money=($date_discount*$info_cart["price"]*$get_info_pricediscount["price_discount"]*$info_cart["number_room"])/100;
                // Tổng số tiền dc giảm
                $be_discount_money=$be_discount_money+$discount_money;
            }
        }
    }
    // Số tiền phải trả
    $total_money_discount=$sum_money_many_day-$be_discount_money;
    // Tổng tiền tất cả
    $data['total_money']=$sum_money_many_day;
    // Số tiền dc giảm
    $data['total_money_be_discount']=$be_discount_money;
    // Số tài phải trả
    $data['total_money_late_discount']=$total_money_discount;
    $data['get_info_cart'] = $get_info_cart;

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
                    'total' => $total_money_discount,
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
                    //Lấy id_detail_book mà mình vừa mới thêm vào csdl
                    $id_detail_book = add_detail_book($data_detail_book);
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
                    'total' => $total_money_discount,
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
                    //Lấy id_detail_book mà mình vừa mới thêm vào csdl
                    $id_detail_book = add_detail_book($data_detail_book);          
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
            }
        }
    }
    load_view('book_room', $data);
}

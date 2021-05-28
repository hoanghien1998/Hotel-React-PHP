<?php

//Triệu gọi đến file xử lý thông qua request

$request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller() . 'Controller.php';

if (file_exists($request_path)) {
    require $request_path;
}
//kiểm tra xem module có không
//else {
////    echo "Không tìm thấy:$request_path ";
//    //echo "Không tìm thấy trang bạn tìm. Vui lòng click <a href='?'>Vào đây</a> để quay lại trang chủ";
//    //redirect();
//}

$action_name = get_action() . 'Action';
if (function_exists($action_name)) {
    call_function(array('construct', $action_name));
} else {
    echo "Không tìm thấy trang bạn tìm. Vui lòng click <a href='?'>Vào đây</a> để quay lại trang chủ";
}


//Kiểm tra login và 
if (!is_login() && get_action() != 'login') {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    unset($_SESSION['time_login']);
    unset($_SESSION['role']);
    redirect("?mod=admin&controller=login&action=login");
}
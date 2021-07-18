<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('login');
    load('lib', 'validation');
}

//xử lý login
function loginAction() {
    global $error, $username, $password;

    //Kiểm tra xem nut login có được click không
    if (isset($_POST['btn-login'])) {
        //Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Tên đăng nhập không được để trống";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Không đúng định dạng, vui lòng nhập lại";
            } else {
                $username = $_POST['username'];
            }
        }

        //Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Mật khẩu đăng nhập không được để trống";
        } else {
            if (!is_username($_POST['password'])) {
                $error['password'] = "Không đúng định dạng, vui lòng nhập lại";
            } else {
                $password = md5($_POST['password']);
            }
        }

        //Kết luận
        if (empty($error)) {
            if (check_login($username, $password)) {
                //Lấy quyền
                $get_role = get_role($username, $password);
                //Lưu trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                $_SESSION['time_login'] = time();
                $_SESSION['role'] = $get_role['role'];
                //Chuyển hướng vào hệ thống
                redirect();
            } else {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            }
        }
    }

    load_view('login');
}

//Xử lý logout
function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    unset($_SESSION['time_login']);
    unset($_SESSION['role']);
    redirect("?mod=admin&controller=login&action=login");
}
?>


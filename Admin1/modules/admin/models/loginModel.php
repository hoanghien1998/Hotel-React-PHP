<?php

//Kiểm tra username và password nhập vào có trong database không?
function check_login($username,$password){
    $check_user= db_num_rows("SELECT * FROM `admin` WHERE `username`='{$username}' AND `password`='{$password}'");
    if($check_user>0)
        return TRUE;
    return FALSE;
}

//Lấy quyền
function get_role($username, $password){
    $result=db_fetch_row("SELECT * FROM `admin` WHERE `username`='{$username}' AND `password`='{$password}'");
    return $result;
}
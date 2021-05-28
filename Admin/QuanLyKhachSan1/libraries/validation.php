<?php

function is_username($username){
    $partten="/^[A-Za-z0-9_\.]{3,32}$/";
    if(!preg_match($partten, $username,$matchs)){
        return FALSE;
    }
    return TRUE;
}
function is_password($password){
    $partten="/^([\w_\.!@#$%^&*()]+){5,32}$/";
    if(!preg_match($partten, $password,$matchs)){
        return FALSE;
    }
    return TRUE;
}
function is_email($email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return FALSE;
    }
    return TRUE;
}

function is_cmnd($cmnd){
    $partten="/^[0-9]{9}$/";
    if(!preg_match($partten, $cmnd,$matchs)){
        return FALSE;
    }
    return TRUE;
}

function is_phone($phone){
    $partten="/^[0-9]{10}$/";
    if(!preg_match($partten, $phone,$matchs)){
        return FALSE;
    }
    return TRUE;
}

function form_error($label_field){
    global $error;
    if(!empty($error[$label_field]))
        return "<span class='help-block small error'>{$error[$label_field]}</span>";
}

function error($label_field){
    global $error;
    if(!empty($error[$label_field]))
        return $error[$label_field];
}

function set_value($label_field){
    global $$label_field;
    if(!empty($$label_field))
        return $$label_field;
}

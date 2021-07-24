<?php

function state_Bill($state){
    $str_state="";
    if($state==0){
        return $str_state="Chưa thanh toán";
    }else if($state==1){
        return $str_state="Đã thanh toán";
    }
}

//màu trạng thái
function color_state_Bill($state){
    $str_state="";
    if($state==1){
        return $str_state="label-custom label label-default";
    }else if($state==2){
        return $str_state="label-primary label label-default";
    }else if($state==0){
        return $str_state="label-danger label label-default";
    }else{
        return $str_state="label-warning label label-default";
    }
}



<?php

function state_Customer($state){
    $str_state="";
    if($state==1){
        return $str_state="Đang ở";
    }else if($state==2){
        return $str_state="Chưa nhận phòng";
    }else if($state==3){
        return $str_state="Hủy phòng";
    }else{
        return $str_state="Chưa ở";
    }
}

//màu trạng thái
function color_state_Customer($state){
    $str_state="";
    if($state==1){
        return $str_state="label-custom label label-default";
    }else if($state==2){
        return $str_state="label-primary label label-default";
    }else if($state==3){
        return $str_state="label-danger label label-default";
    }else{
        return $str_state="label-warning label label-default";
    }
}



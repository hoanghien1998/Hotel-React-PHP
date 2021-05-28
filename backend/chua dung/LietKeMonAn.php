<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db_conn = mysqli_connect("localhost","root","","qlkhachsan");

$allres = mysqli_query($db_conn,"SELECT id, ten, hinhanh, gia, mota FROM restaurant");

if(mysqli_num_rows($allres) > 0){

    $all_res = mysqli_fetch_all($allres, MYSQLI_ASSOC);
   
    echo json_encode(["success"=>1,"restaurant"=>$all_res]);
}
else{
    echo json_encode(["success"=>0]);
}
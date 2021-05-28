<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db_conn = mysqli_connect("localhost","root","","qlkhachsan");

$allres = mysqli_query($db_conn,"SELECT sum(thanhtien) as ttt FROM cart");

if(mysqli_num_rows($allres) > 0){

    $all_res = mysqli_fetch_all($allres, MYSQLI_ASSOC);
   
    echo json_encode(["success"=>1,"tong"=>$all_res["ttt"]]);
}
else{
    echo json_encode(["success"=>0]);
}
?>
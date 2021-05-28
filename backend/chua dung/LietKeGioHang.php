<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db_conn = mysqli_connect("localhost","root","","qlkhachsan");

$allres = mysqli_query($db_conn,"SELECT * FROM cart");

if(mysqli_num_rows($allres) > 0){

    $all_res = mysqli_fetch_all($allres, MYSQLI_ASSOC);
    $tong=0;
    foreach($all_res as $key =>$value)
    {
        $tong=$tong+$value["thanhtien"];
    }
  // $tong=100;
    echo json_encode(["success"=>1,"cart"=>$all_res,"tong"=>$tong]);
}
else{
    echo json_encode(["success"=>0]);
}
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db_conn = mysqli_connect("localhost","root","","hotel");

$id = $_POST["id"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$cmnd = $_POST["cmnd"];
$update_user = "UPDATE customer SET `name` ='$name', `phone` = '$phone', `address` = '$address', `cmnd` = '$cmnd' WHERE `cus_code` = $id";
$db_conn->query($update_user);


$get_user = mysqli_query($db_conn,"SELECT * FROM customer where `cus_code` = $id");
if(mysqli_num_rows($get_user) > 0){

    $get_user = mysqli_fetch_all($get_user, MYSQLI_ASSOC);

    echo json_encode(["success"=>1,"user"=>$get_user]);
}
else{
    echo json_encode(["success"=>0]);
}

$db_conn->close();
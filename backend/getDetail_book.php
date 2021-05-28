<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../classes/JwtHandler.php';

$db_conn = mysqli_connect("localhost","root","","hotel");
$token = $_POST["token"];

//order rooms
$jwt = new JwtHandler();
$auth = $jwt->_jwt_decode_data($token);
$user_id = $auth['data']->user_id;
if (empty($user_id)) {
    echo "Phien dang nhap ban het han, vui long dang nhap lai";
    return;
}
var_dump($user_id);
die;
$allDetailBook = mysqli_query($db_conn,"SELECT *
                                        FROM bookroom, detailbook
                                        WHERE bookroom.id = detailbook.booking_code and bookroom.cus_code = $user_id");
if(mysqli_num_rows($allDetailBook) > 0){

    $allDetailBook = mysqli_fetch_all($allDetailBook, MYSQLI_ASSOC);

    echo json_encode(["success"=>1,"detail"=>$allDetailBook]);
}
else{
    echo json_encode(["success"=>0]);
}

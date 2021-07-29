<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$conn = mysqli_connect("localhost","root","","hotel");

$userId = $_POST["userId"];
$get_history = mysqli_query($conn, "SELECT bookroom.total, detailbook.number_room, detailbook.check_in, 
                            detailbook.check_out, roomtype.name
        FROM bookroom, detailbook, roomtype
        WHERE bookroom.id = detailbook.booking_code AND bookroom.cus_code = {$userId}
                AND detailbook.room_type_id = roomtype.id
        ");

// $kq= mysqli_fetch_assoc($get_history);
// var_dump($kq);
if(mysqli_num_rows($get_history) > 0){

    $get_historys = mysqli_fetch_all($get_history, MYSQLI_ASSOC);

    echo json_encode(["success"=>1,"historys"=>$get_historys]);
}
else{
    echo json_encode(["success"=>0]);
}




         
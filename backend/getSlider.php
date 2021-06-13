<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db_conn = mysqli_connect("localhost","root","","hotel");

$allSlider = mysqli_query($db_conn,"SELECT slide.image
                                        FROM slide
                                        WHERE CURDATE() >= date_start AND CURDATE() <= date_end");


if(mysqli_num_rows($allSlider) > 0){

    $all_sliders = mysqli_fetch_all($allSlider, MYSQLI_ASSOC);

    echo json_encode(["success"=>1,"slides"=>$all_sliders]);
}
else{
    echo json_encode(["success"=>0]);
}
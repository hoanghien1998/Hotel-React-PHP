<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$db_conn = mysqli_connect("localhost","root","","qlkhachsan");
$cart = $_POST["cart"];
$cart = json_decode($cart,true);
$id = $_POST["id"];
$sql="delete from cart where id = {$id}";
mysqli_query($db_conn, $sql);
$tong=0;
foreach($cart as $key=>$value)
{
    
    $sql3 = "update cart set thanhtien=".$value['thanhtien'].", soluong=".$value['soluong']." where id=".$value['id'];
    $tong=$tong+$value['thanhtien'];
    mysqli_query($db_conn, $sql3);
}
mysqli_close($db_conn);
echo $tong;
?>
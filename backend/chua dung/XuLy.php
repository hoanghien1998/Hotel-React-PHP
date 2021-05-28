<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$conn = mysqli_connect("localhost","root","","qlkhachsan");

$ten = $_POST["ten"];
$sdt = $_POST["sdt"];
$dc = $_POST["dc"];
$cart = $_POST["cart"];
$tong = $_POST["tong"];
$cart = json_decode($cart,true);

$kiemtra = !empty($ten) && !empty($sdt) && !empty($dc);
if ($kiemtra == true)
{
    $sql1 = "Insert into khachhang(tenkh,sdt,diachi) values('$ten','$sdt','$dc')"; 
    mysqli_query($conn, $sql1);

    $lastID = mysqli_insert_id($conn);
    foreach($cart as $key=>$value)
    {
        $sql2 = "Insert into hoadon(ngaydat,makh,tongtien) values (CURDATE(), $lastID,$tong)";
        mysqli_query($conn, $sql2);
    }
    
    $lastID2 = mysqli_insert_id($conn);
    foreach($cart as $key=>$value)
    {
        $sql3 = "Insert into CThoadon (sohd,masp,soluong) values ($lastID2,". $value['id'].",".$value['soluong'].")";
        mysqli_query($conn, $sql3);
    }
    // xoa gio hang
    $sql= "Delete from cart ";
    mysqli_query($conn, $sql);

    mysqli_close($conn);
    echo "You have successfully purchased!!!! We will contact you soonest";
}
else
{
    echo "You must enter full information for us to contact";
}
?>
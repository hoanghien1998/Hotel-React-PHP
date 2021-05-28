<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$id = $_POST["id"];
$ten = $_POST["ten"];
$hinhanh = $_POST["hinhanh"];
$sl =$_POST["sl"];
$gia=$_POST["gia"];

$conn = mysqli_connect("localhost", "root","","qlkhachsan");
$sql = "select * from cart where id=".$id;
$kq= mysqli_query($conn, $sql);
$bl="";

if(mysqli_num_rows($kq)==0)
{
    $tt = $sl * $gia;
    // echo $tt;
    // die;
    $sql="insert into cart(id,ten,hinhanh,soluong,gia,thanhtien) values($id,'$ten', '$hinhanh', $sl, $gia,$tt)";
    $kq= mysqli_query($conn, $sql);
    echo $kq;
    die;
    if($kq)
    {
       $bl= "Item added $ten in cart";
    //    $sql="select sum(thanhtien) as ttt from cart";
    //    $kq=mysqli_query($conn, $sql);
    //    $kq = mysqli_fetch_assoc($kq);
    //    $tt= $kq["ttt"];
    }
    else 
        $bl= "Erro !!! Do not add to cart";
}
else
{
    // $sql="update cart set soluong = soluong + $sl where id=".$id;
    // $kq= mysqli_query($conn, $sql);
    // if($kq)
    //     $bl= "Item added $ten in cart";
    // else 
    //     $bl= "Erro !!! Do not add to cart";
    $bl="Item $ten already exists";
}
mysqli_close($conn);
//echo $tt;
echo $bl;

?>
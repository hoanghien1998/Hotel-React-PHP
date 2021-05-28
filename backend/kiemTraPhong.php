<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$conn = mysqli_connect("localhost","root","","hotel");

$ngaynhan = $_POST["datenhan"];
$ngaytra = $_POST["datetra"];
$datenhan =date("Y-m-d",strtotime($ngaynhan));
$datetra =date("Y-m-d",strtotime($ngaytra));
$id = $_POST["choseID"];


$check_datenhan = mysqli_query($conn, "SELECT Roomtype.id,Roomtype.name,(IFNULL(Roomtype.number_room-Detailbook.number_room,Roomtype.number_room)) AS number
FROM (SELECT room_type_id,SUM(number_room) AS number_room
	FROM `detailbook`
	WHERE detailbook.check_in <='{$datenhan}' AND '{$datenhan}' <= detailbook.check_out AND detailbook.room_type_id = {$id}
    GROUP BY room_type_id) AS Detailbook RIGHT JOIN (SELECT roomtype.id,roomtype.name,COUNT(room.id) as number_room
            FROM `room`,`roomtype`
            WHERE room.typeCode=roomtype.id AND roomtype.id = {$id}
            GROUP BY typeCode) AS Roomtype ON Detailbook.room_type_id=Roomtype.id");
$kq= mysqli_fetch_assoc($check_datenhan);


$check_datetra =  mysqli_query($conn, "SELECT Roomtype.id,Roomtype.name,(IFNULL(Roomtype.number_room-Detailbook.number_room,Roomtype.number_room)) AS number
FROM (SELECT room_type_id,SUM(number_room) AS number_room
	FROM `detailbook`
	WHERE detailbook.check_in <='{$datetra}' AND '{$datetra}' <= detailbook.check_out AND detailbook.room_type_id = {$id}
    GROUP BY room_type_id) AS Detailbook RIGHT JOIN (SELECT roomtype.id,roomtype.name,COUNT(room.id) as number_room
            FROM `room`,`roomtype`
            WHERE room.typeCode=roomtype.id AND roomtype.id = {$id}
            GROUP BY typeCode) AS Roomtype ON Detailbook.room_type_id=Roomtype.id");

$kq1= mysqli_fetch_assoc($check_datetra);
$sl = 0;

if ($kq['number'] < $kq1['number'])
{
    $sl = $kq['number'];

}
else
{
    $sl = $kq1['number'];
}

$array = array(
    'id'=>$kq['id'],
    'name'=>$kq['name'],
    'number'=>$sl
);

echo json_encode($array);



         
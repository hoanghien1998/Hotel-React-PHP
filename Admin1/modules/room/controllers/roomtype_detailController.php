<?php

function construct() {
//    echo "Dùng chung, load đầu tiên";
    load_model('roomtype_detail');
    load('lib', 'validation');
}

function get_detailAction() {
    $id = $_GET['id'];
    $page = isset($_GET['get_page']) ? (int) ($_GET['get_page']) : 1;
    $roomtypedetail = get_roomtypedetail_id($id);
    $roomtypedetail_img = get_roomtypedetail_img_id($id);
    $data['roomtypedetail'] = $roomtypedetail;
    $data['roomtypedetail_img'] = $roomtypedetail_img;
    $data['page']=$page;
    $num_row_room_code=get_num_row("`room_type_detail`","WHERE room_type_id = {$id}");
    //$data['num_row_room_code']=$num_row_room_code;
    if (isset($_POST['save-update-room-type-id'])) {
        if($num_row_room_code==0){
            $data=array(
                'room_type_id'=>$id,
                'dientich'=>$_POST['roomtypedetailAcre'],
                'huongphong'=>$_POST['roomtypedetailDirection'],
                'giuong'=>$_POST['roomtypedetailBed']
            );
            insert_info_room_type_detail($data);
        }else{
            $data=array(
                'room_type_id'=>$id,
                'dientich'=>$_POST['roomtypedetailAcre'],
                'huongphong'=>$_POST['roomtypedetailDirection'],
                'giuong'=>$_POST['roomtypedetailBed']
            );
            update_room_type_detail($data,$id);
        }
        if (isset($_FILES['roomtypedetail_img'])) {
            for ($i = 0; $i < count($_FILES['roomtypedetail_img']['name']); $i++) {
                move_uploaded_file($_FILES['roomtypedetail_img']['tmp_name'][$i], 'D:/Unitop/xampp/htdocs/Backend/DoAn/QuanLyKhachSan1/public/images/room/' . $_FILES['roomtypedetail_img']['name'][$i]);
                $data = array(
                    'room_type_id' => $id,
                    'image' => $_FILES['roomtypedetail_img']['name'][$i]
                );
                insert_info_room_type_detail_image($data);
            }
        }
        redirect("?mod=room&controller=roomtype_detail&action=get_detail&id={$id}&get_page={$_GET['get_page']}");
    }
    if(isset($_POST['btn-delete-room-type-detail-img'])){
        delete_detailAction();
    }
    load_view('roomtype_detail', $data);
}

function delete_detailAction(){
    if(isset($_POST['btn-delete-room-type-detail-img'])){
        $id=$_POST['roomtypedetail_img_Id'];
        $id_room_code=$_GET['id'];
        delete_room_type_detail_id($id);
        redirect("?mod=room&controller=roomtype_detail&action=get_detail&id={$id_room_code}&get_page={$_GET['get_page']}");
    }
}

<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-home"></i>
        </div>
        <div class="header-title">
            <h1>Chi tiết phòng</h1>
            <small>Chi tiết loại phòng</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content content-wp">
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group">
                    <div class="buttonexport" id="buttonlist"> 
                        <a href="?mod=room&controller=roomtype&action=list_room_type&page=<?php echo $page; ?>" name="roomtypedetail_update" class="btn btn-add btn-sm" data-toggle="modal" room-id=""><i class="fa fa-pencil-square-o"></i> Danh sách loại phòng</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                            <?php
//                            show_array($roomtypedetail);
//                            show_array($roomtypedetail_img);
//                            echo $num_row_room_code;
                            ?>
                            <fieldset>

                                <!-- Số phòng-->
                                <div class="col-md-4 form-group">
                                    <input type="hidden" name="" value=""/>
                                    <label class="control-label">Diện Tích:</label>
                                    <input type="text" name="roomtypedetailAcre" placeholder="" value="<?php if (isset($roomtypedetail)) echo $roomtypedetail['dientich'] ?>" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Hướng phòng:</label>
                                    <input type="text" name="roomtypedetailDirection" placeholder="" value="<?php if (isset($roomtypedetail)) echo $roomtypedetail['huongphong'] ?>" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Giường:</label>
                                    <input type="number" min="1" name="roomtypedetailBed" placeholder="" value="<?php if (isset($roomtypedetail)) echo $roomtypedetail['giuong'] ?>" class="form-control">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="control-label">Hình ảnh:</label>
                                    <ul>
                                        <?php
                                        if (!empty($roomtypedetail_img)) {
                                            foreach ($roomtypedetail_img as $img) {
                                                ?>
                                                <li class="col-md-4">
                                                    <img class="roomtypedetail_image" src="http://localhost/Backend/DoAn/QuanLyKhachSan1/public/images/room/<?php echo $img['image']; ?>"/>
                                                    <button type="button" name="roomtypedetail_img_Delete" class="btn btn-danger btn-sm delete_img" data-toggle="modal" data-target="#customer2" del-room-type-detail-img-id="<?php echo $img['id']; ?>" title="Xóa hình ảnh chi tiết loại phòng"><i class="fa fa-trash-o"></i> </button>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="control-label">Thêm hình ảnh:</label>
                                    <ul>
                                        <div id="tamthoi"></div>
                                    </ul>
                                </div>
                                <div class="col-md-6 form-group user-form-group text-center">
                                    <input type="button" name="add_file_img" id="add_file_img" class="btn btn-warning btn-sm" value="Thêm file mới" style="width: 50%;"/>
                                </div>
                                <div class="col-md-6 form-group user-form-group text-center">
                                    <input type="submit" name="save-update-room-type-id" class="btn btn-add btn-sm" value="Save" style="width: 50%;"/>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <!-- Modal -->    
        <!-- delete Room -->
        <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-user m-r-5"></i> Xóa khỏi chi tiết loại phòng</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <div class="col-md-12 form-group user-form-group">
                                            <label class="control-label p-20">Bạn có chắc chắn muốn xóa hình ảnh này ra khỏi danh sách:</label>
                                            <div class="pull-right">
                                                <input type="hidden" name="roomtypedetail_img_Id" value=""/>
                                                <input type="button" class="btn btn-danger btn-sm"  data-dismiss="modal" value="NO"/>
                                                <input type="submit" name="btn-delete-room-type-detail-img" class="btn btn-add btn-sm" value="YES"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <div class="clearfix"></div>
    <!-- /.content -->
</div>
<?php
get_footer();
?>


<?php
get_header();
get_sidebar();
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-sliders"></i>
        </div>
        <div class="header-title">
            <h1>Slide</h1>
            <small>Danh sách quảng cáo</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content content-wp">
        <div class="row">
            <div class="col-sm-12">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                <div class="btn-group">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                        ?>
                        <div class="buttonexport" id="buttonlist"> 
                            <button type="button" name="productAdd" class="btn btn-add btn-sm m-b-10" data-toggle="modal" data-target="#customer3" room-id=""><i class="fa fa-plus"></i>Thêm quảng cáo</button>
                        </div>
                    <?php }
                    ?>
                </div>
                <!--bảng danh sách sản phẩm-->
                <?php
                if (!empty($list_slide)) {
                    ?>
                    <div class="table-responsive">
                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr class="info">
                                    <th class="col-md-1">STT</th>
                                    <th class="col-md-5">Hình ảnh</th>
                                    <th class="col-md-2">Ngày bắt đầu</th>
                                    <th class="col-md-2">Ngày kết thúc</th>
                                    <th class="col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list_slide)) {
                                    $t = $start;
                                    // global $room_id;
                                    foreach ($list_slide as $slide) {
                                        $t++;
                                        ?>
                                        <tr>
                                            <td><?php echo $t; ?></td>
                                            <td><img src="public/images/slide/<?php echo $slide['image']; ?>" class="img-rounded thumb" alt="User Image" width="" height="100"></td>
                                            <td><?php echo $slide['date_start']; ?></td>
                                            <td><?php echo $slide['date_end']; ?></td>
                                            <td>
                                                <button type="button" name="slideUpdate" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1" slide_up-id="<?php echo $slide['id_slide']; ?>"><i class="fa fa-pencil"></i></button>
                                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                                                    ?>
                                                    <button type="button" name="slideDelete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2" del-slide-id="<?php echo $slide['id_slide']; ?>"><i class="fa fa-trash-o"></i> </button>
                                                <?php }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } else {
                    echo "<p> Chưa có sản phẩm nào được thêm, click <a href='?mod=product'>Vào đây!</a> để thêm sản phẩm</p>";
                }
                ?>

            </div>
        </div>
        <!-- add slide -->
        <div class="modal fade" id="customer3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-sliders m-r-5"></i> Thêm quảng cáo</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    <fieldset>
                                        <!-- Hinh ảnh slide-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Hình ảnh:</label>
                                            <input type="file" name="slide_add_image" placeholder="" value="" class="form-control">
                                        </div>
                                        <!--Ngày bắt đầu-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Ngày bắt đầu:</label>
                                            <input type="datetime" id='received-date' name="slide_add_datestart"  class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 30px;right: 30px;"></i>
                                        </div>
                                        <!--Ngày kết thúc-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Ngày kết thúc:</label>
                                            <input type="datetime" id='pay-date' name="slide_add_dateend" class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 30px;right: 30px;"></i>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-add-slide" class="btn btn-add btn-sm" value="Save"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- update Slide -->
        <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-sliders m-r-5"></i> Cập nhật quảng cáo</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    <fieldset>
                                        <!-- Hinh ảnh slide-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Hình ảnh:</label>
                                            <input type="hidden" name="slide_up_id" value=""/>
                                            <input type="file" name="slide_up_image" placeholder="" value="" class="form-control">
                                        </div>
                                        <!--Ngày bắt đầu-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Ngày bắt đầu:</label>
                                            <input type="datetime" id='received-date1' name="slide_up_datestart"  class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 30px;right: 30px;"></i>
                                        </div>
                                        <!--Ngày kết thúc-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Ngày kết thúc:</label>
                                            <input type="datetime" id='pay-date1' name="slide_up_dateend" class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 30px;right: 30px;"></i>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-up-slide" class="btn btn-add btn-sm" value="Save"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal -->    
        <!-- delete Room -->
        <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-user m-r-5"></i> Xóa quảng cáo</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <div class="col-md-12 form-group user-form-group">
                                            <label class="control-label">Bạn có chắc chắn muốn xóa nội dung này không:</label>
                                            <div class="pull-right">
                                                <input type="hidden" name="slide_del_id" value=""/>
                                                <input type="button" class="btn btn-danger btn-sm"  data-dismiss="modal" value="NO"/>
                                                <input type="submit" name="btn-delete-slide" class="btn btn-add btn-sm" value="YES"/>
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
        <!--Thiết kế phân trang-->

    </section>
    <?php
    echo $get_pagging;
    ?>
    <div class="clearfix"></div>
    <!-- /.content -->
</div>
<?php
get_footer();
?>
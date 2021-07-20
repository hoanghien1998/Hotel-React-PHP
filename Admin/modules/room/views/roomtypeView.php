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
            <h1>Loại Phòng</h1>
            <small>Danh sách loại phòng</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content content-wp">
        <div class="row">
            <div class="col-sm-12">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                <!-- Thêm phòng -->
                <div class="btn-group">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                        ?>
                        <div class="buttonexport" id="buttonlist"> 
                            <button type="button" name="roomtype_add" class="btn btn-add btn-sm m-b-10" data-toggle="modal" data-target="#customer3" room-id=""><i class="fa fa-plus"></i> Thêm phòng</button>
                        </div>
                    <?php }
                    ?>
                </div>

                <!-- ƯU ĐÃI GIẢM GIÁ -->
                <div class="btn-group">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                        ?>
                        <div class="buttonexport" id="buttonlist"> 
                            <button type="button" name="roomtype_discount" class="btn btn-add btn-sm m-b-10" data-toggle="modal" data-target="#customer4" room-id=""><i class="fa fa-money"></i> Ưu đãi giảm giá</button>
                        </div>
                    <?php }
                    ?>
                </div>

                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                <div class="table-responsive">
                    <table id="dataTableExample1" class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr class="info">
                                <th class="col-md-1">STT</th>
                                <th class="col-md-4">Tên loại phòng</th>
                                <th class="col-md-3">Hình ảnh</th>
                                <th class="col-md-2">Giá(VND)</th>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                                    ?>
                                    <th class="col-md-2"></th>
                                <?php }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list_rooms_type)) {
                                $t = $start;
                                global $room_id;
                                foreach ($list_rooms_type as $room_type) {
                                    $t++;
                                    ?>
                                    <tr>
                                        <td><p><?php echo $t; ?></p></td>
                                        <td style="text-align:left"><?php echo $room_type['name']; ?></td>
                                        <td><img src="public/images/room/<?php echo $room_type['image']; ?>" class="img-rounded thumb" alt="User Image" width="" height="100"> </td>
                                        <td><?php echo currency_format($room_type['price']); ?></td>
                                <!--<td><input type="text" value="<?php echo number_format($room_type['price']); ?>" disabled="" class="text-center border-price-roomtype" id="roomtype_price"/></td>-->

                                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                                            ?>
                                            <td>
                                                <button type="button" name="roomtypeUpdate" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1" update-room-type-id="<?php echo $room_type['id']; ?>" title="Cập nhật loại phòng"><i class="fa fa-pencil"></i></button>
                                                <button type="button" name="roomtypeDelete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2" del-room-type-id="<?php echo $room_type['id']; ?>" title="Xóa loại phòng"><i class="fa fa-trash-o"></i> </button>
                                                <a name="roomtypeDetail" href="?mod=room&controller=roomtype_detail&action=get_detail&id=<?php echo $room_type['id']; ?>&get_page=<?php echo $page; ?>" class="btn btn-warning btn-sm" data-toggle="modal" del-room-type-id="<?php echo $room_type['id']; ?>" title="Chi tiết loại phòng"><i class="fa fa-asterisk"></i> </a>
                                            </td>
                                        <?php }
                                        ?>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ƯU ĐÃI GIẢM GIÁ -->
        <div class="modal fade" id="customer4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-home m-r-5"></i> Ưu đãi giảm giá</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                                    <fieldset>
                                        <!-- giá giảm roomtype-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Giảm giá (%):</label>
                                            <select class="custom-select form-control" id="inputGroupSelect01" name="roomtype_pricediscount">
                                                <option value="0">0%</option>
                                                <option value="5">5%</option>
                                                <option value="10">10%</option>
                                                <option value="15">15%</option>
                                                <option value="20">20%</option>
                                                <option value="25">25%</option>
                                                <option value="30">30%</option>
                                            </select>
                                            <!-- <input type="number" name="roomtype_add_pricediscount" min="0" placeholder="" value="" class="form-control"> -->
                                        </div>
                                        <!--Ngày bắt đầu-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Ngày bắt đầu:</label>
                                            <input type="datetime" id='received-date' name="roomtype_datestart"  class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 40px;right: 30px;"></i>
                                        </div>
                                        <!--Ngày kết thúc-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Ngày kết thúc:</label>
                                            <input type="datetime" id='pay-date' name="roomtype_dateend" class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 40px;right: 30px;"></i>
                                        </div>

                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-room-type-pricediscount" class="btn btn-add btn-sm" value="Save"/>
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
        <!-- END ƯU ĐÃI GIẢM GIÁ -->

        <!-- add Room -->
        <div class="modal fade" id="customer3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-home m-r-5"></i> Thêm loại phòng</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                                    <fieldset>
                                        <!-- Số phòng-->
                                        <div class="col-md-4 form-group">
                                            <!--<input type="hidden" name="roomId" value=""/>-->
                                            <label class="control-label" style="margin-bottom: 10px;">Tên loại phòng:</label>
                                            <input type="text" name="roomtypeNameadd" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Giá loại phòng:</label>
                                            <input type="number" name="roomtypePriceadd" min="0" placeholder="" value="" class="form-control">
                                        </div>
                                        <!-- giá giảm roomtype-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Giảm giá(%):</label>
                                            <select class="custom-select form-control" id="inputGroupSelect01" name="roomtype_add_pricediscount">
                                                <option value="0">0%</option>
                                                <option value="5">5%</option>
                                                <option value="10">10%</option>
                                                <option value="15">15%</option>
                                                <option value="20">20%</option>
                                                <option value="25">25%</option>
                                                <option value="30">30%</option>
                                            </select>
                                            <!-- <input type="number" name="roomtype_add_pricediscount" min="0" placeholder="" value="" class="form-control"> -->
                                        </div>
                                        <!--Ngày bắt đầu-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Ngày bắt đầu:</label>
                                            <input type="datetime" id='received-date' name="roomtype_add_datestart"  class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 40px;right: 30px;"></i>
                                        </div>
                                        <!--Ngày kết thúc-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Ngày kết thúc:</label>
                                            <input type="datetime" id='pay-date' name="roomtype_add_dateend" class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 40px;right: 30px;"></i>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px; margin-top: 5px;">Hình ảnh loại phòng:</label>
                                            <input type="file" name="roomtypeImageadd" value="">
                                            <?php echo form_error('image'); ?>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-add-room-type-id" class="btn btn-add btn-sm" value="Save"/>
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
        <!-- update Room -->
        <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-home m-r-5"></i> Cập nhật loại phòng</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                                    <fieldset>
                                        <!-- Số phòng-->
                                        <div class="col-md-4 form-group">
                                            <input type="hidden" name="roomtypeId" value=""/>
                                            <label class="control-label" style="margin-bottom: 10px;">Tên loại phòng:</label>
                                            <input type="text" name="roomtypeName" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Giá loại phòng:</label>
                                            <input type="number" min="0" name="roomtypePrice" placeholder="" value="" class="form-control">
                                        </div>

                                        <!-- giá giảm roomtype-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Giảm giá(%):</label>
                                            <select class="custom-select form-control" id="inputGroupSelect01" name="roomtype_up_pricediscount">
                                                <option value="0">0%</option>
                                                <option value="5">5%</option>
                                                <option value="10">10%</option>
                                                <option value="15">15%</option>
                                                <option value="20">20%</option>
                                                <option value="25">25%</option>
                                                <option value="30">30%</option>
                                            </select>
                                            <!-- <input type="number" name="roomtype_up_pricediscount" min="0" placeholder="" value="" class="form-control"> -->
                                        </div>
                                        <!--Ngày bắt đầu-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Ngày bắt đầu:</label>
                                            <input type="datetime" id='received-date1' name="roomtype_up_datestart"  class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 40px;right: 30px;"></i>
                                        </div>
                                        <!--Ngày kết thúc-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Ngày kết thúc:</label>
                                            <input type="datetime" id='pay-date1' name="roomtype_up_dateend" class="form-control years" style="position: relative;" value="<?php echo date('Y-m-d');?>"/><i class="fa fa-calendar" style="position: absolute;top: 40px;right: 30px;"></i>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px; margin-top: 5px;">Hình ảnh loại phòng:</label>
                                            <!--<input type="file" name="roomtypeImage" value="" class="form-control">-->
                                            <input type="file" name="roomtypeImage" value="">
                                            <?php echo form_error('image'); ?>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-update-room-type-id" class="btn btn-add btn-sm" value="Save"/>
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
                        <h3><i class="fa fa-home m-r-5"></i> Xóa phòng</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <div class="col-md-12 form-group user-form-group">
                                            <label class="control-label">Bạn có chắc chắn muốn xóa loại phòng: <span id="roomtypeName_del"></span></label>
                                            <div class="pull-right">
                                                <input type="hidden" name="roomtypeId" value=""/>
                                                <input type="button" class="btn btn-danger btn-sm"  data-dismiss="modal" value="NO"/>
                                                <input type="submit" name="btn-delete-room-type" class="btn btn-add btn-sm" value="YES"/>
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
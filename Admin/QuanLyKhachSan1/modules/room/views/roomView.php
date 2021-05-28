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
            <h1>Phòng</h1>
            <small>Danh sách phòng</small>
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
                        <div class="col-sm-4 m-b-10" id=""> 
                            <button type="button" name="roomAdd" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer3" room-id=""><i class="fa fa-plus"></i>Thêm phòng</button>
                        </div>
                    <?php }
                    ?>
                    <form method="POST" class="col-sm-4">
                        <div id=""> 
                            <input type="submit" name="load_state" class="btn btn-add btn-sm" room-id="" value="Cập nhật trạng thái mới" />
                        </div>
                    </form>
                </div>
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                <div class="table-responsive">
                    <table id="dataTableExample1" class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr class="info">
                                <th class="col-md-1">STT</th>
                                <th class="col-md-2">Số phòng</th>
                                <th class="col-md-5">Loại phòng</th>
                                <th class="col-md-2">Trạng thái</th>
                                <th class="col-md-2">Chỉnh sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list_rooms)) {
                                $t = $start;
                                global $room_id;
                                foreach ($list_rooms as $room) {
                                    $t++;
                                    ?>
                                    <tr>
                                        <td><?php echo $t; ?></td>
                                        <td><?php echo $room['roomNumber']; ?></td>
                                        <td><?php echo $room['name']; ?></td>
                                        <td><?php
                                            if ($room['state'] == 0) {
                                                echo "<span class='label-danger label label-default'>Còn trống</span>";
                                            } elseif ($room['state'] == 1) {
                                                echo "<span class='label-custom label label-default'>Đã đặt</span>";
                                            }
                                            ?></td>
                                        <td>
                                            <button type="button" name="roomUpdate" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1" room-id="<?php echo $room['id']; ?>"><i class="fa fa-pencil"></i></button>
                                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                                                ?>
                                                <button type="button" name="roomDelete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2" del-room-id="<?php echo $room['id']; ?>"><i class="fa fa-trash-o"></i> </button>
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
            </div>
        </div>
        <!-- add Room -->
        <div class="modal fade" id="customer3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-home m-r-5"></i> Thêm phòng</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <!-- Số phòng-->
                                        <div class="col-md-4 form-group">
                                            <input type="hidden" name="roomId" value=""/>
                                            <label class="control-label" style="margin-bottom: 10px;">Số phòng:</label>
                                            <input type="text" name="roomNumber" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Loại phòng:</label>
                                            <select class="form-control" name="roomType" id="roomType">
                                                <?php
                                                foreach ($list_room_type as $room_type) {
                                                    ?>
                                                    <option value="<?php echo $room_type['id']; ?>"><?php echo $room_type['name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label class="control-label"  style="margin-bottom: 10px;">Trạng thái:</label>
                                            <select class="form-control" name="roomState" id="roomState">
                                                <option value="0">Còn trống</option>
                                                <option value="1">Đã đặt</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-add-room-id" class="btn btn-add btn-sm" value="Save"/>
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
                        <h3><i class="fa fa-home m-r-5"></i> Update Room</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <!-- Số phòng-->
                                        <div class="col-md-4 form-group">
                                            <input type="hidden" name="roomId" value=""/>
                                            <label class="control-label" style="margin-bottom: 10px;">Số phòng:</label>
                                            <input type="text" name="roomNumber" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Loại phòng:</label>
                                            <select class="form-control" name="roomType" id="roomType">
                                                <?php
                                                foreach ($list_room_type as $room_type) {
                                                    ?>
                                                    <option value="<?php echo $room_type['id']; ?>"><?php echo $room_type['name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Trạng thái:</label>
                                            <select class="form-control" name="roomState" id="roomState">
                                                <option value="0">Còn trống</option>
                                                <option value="1">Đã đặt</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-update-room-id" class="btn btn-add btn-sm" value="Save"/>
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
                                            <label class="control-label">Bạn có chắc chắn muốn xóa phòng: <span id="roomNumber_del"></span></label>
                                            <div class="pull-right">
                                                <input type="hidden" name="roomId" value=""/>
                                                <input type="button" class="btn btn-danger btn-sm"  data-dismiss="modal" value="NO"/>
                                                <input type="submit" name="btn-delete-room" class="btn btn-add btn-sm" value="YES"/>
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
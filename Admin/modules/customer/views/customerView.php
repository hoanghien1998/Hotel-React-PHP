<?php
get_header();
get_sidebar();
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-users"></i>
        </div>
        <div class="header-title">
            <h1>Khách hàng</h1>
            <small>Danh sách khách hàng</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content content-wp">
        <div class="row">
            <div class="col-sm-12">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                <div class="btn-group">
                    <div class="buttonexport" id="buttonlist"> 
<!--                        <a class="btn btn-add" href="?mod=room&action=add"> <i class="fa fa-plus"></i> Thêm phòng
                        </a> -->
                        <!--<button type="button" name="roomAdd" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer3" room-id=""><i class="fa fa-plus"></i>Thêm khách hàng</button>-->
                    </div>
                </div>
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                <div class="table-responsive">
                    <table id="dataTableExample1" class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr class="info">
                                <th class="col-md-1">STT</th>
                                <th class="col-md-2">Tên khách hàng</th>
                                <th class="col-md-1">Số điện thoại</th>
                                <th class="col-md-3">Địa chỉ</th>
                                <th class="col-md-1">CMND</th>
                                <th class="col-md-2">Email</th>
                                <th class="col-md-1">Trạng thái</th>
                                <th class="col-md-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list_customer)) {
                                $t = $start;
                                //global $room_id;
                                foreach ($list_customer as $customers) {
                                    $t++;
                                    ?>
                                    <tr>
                                        <td><?php echo $t; ?></td>
                                        <td style="text-align:left"><?php echo $customers['name']; ?></td>
                                        <td><?php echo $customers['phone']; ?></td>
                                        <td style="text-align:left"><?php echo $customers['address']; ?></td>
                                        <td><?php echo $customers['cmnd']; ?></td>
                                        <td style="text-align:left"><?php echo $customers['email']; ?></td>
                                        <td><span class="<?php echo color_state_Customer($customers['state']); ?>"><?php echo state_Customer($customers['state']); ?></span></td>
                                        <td>
                                            <button type="button" name="customerUpdate" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1" update-customer-id="<?php echo $customers['cus_code']; ?>"><i class="fa fa-pencil"></i></button>
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
        <!-- update Room -->
        <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-user m-r-5"></i> Cập nhật khách hàng</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <!-- Số phòng-->
                                        <div class="col-md-4 form-group">
                                            <!--<input type="hidden" name="customerId" value=""/>-->
                                            <label class="control-label" style="margin-bottom: 10px;">Tên khách hàng:</label>
                                            <input type="text" name="customerName" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <input type="hidden" name="customerId" value=""/>
                                            <label class="control-label" style="margin-bottom: 10px;">Số điện thoại:</label>
                                            <input type="text" name="customerPhone" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Địa chỉ</label>
                                            <input type="text" name="customerAddress" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">CMND:</label>
                                            <input type="text" name="customerCMND" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Email:</label>
                                            <input type="text" name="customerEmail" placeholder="" value="" class="form-control">
                                        </div>
                                        <!--Trạng thái-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Trạng thái:</label>
                                            <select class="form-control" name="customerState" id="customerState">
                                                <option value="0">Chưa ở</option>
                                                <option value="1">Đang ở</option>
                                                <option value="2">Chưa nhận phòng</option>
                                                <option value="3">Hủy phòng</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-update-customer-id" class="btn btn-add btn-sm" value="Save"/>
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

        <!--Thiết kế phân trang-->
        <?php
        echo $get_pagging;
        ?>
        <div class="clearfix"></div>
    </section>

    <!-- /.content -->
</div>
<?php
get_footer();
?>
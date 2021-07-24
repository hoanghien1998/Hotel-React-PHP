<?php
get_header();
get_sidebar();
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="hvr-buzz-out fa fa-hotel"></i>
        </div>
        <div class="header-title">
            <h1>Quản lý đặt phòng</h1>
            <small>Thông tin chi tiết hóa đơn</small>
        </div>
        <?php
        //show_array($list_detail_bookroom);
        ?>
    </section>
    <!-- Main content -->
    <section class="content content-wp">
        <div class="row">
            <div class="col-sm-12">
                
                <!--BẢng danh sách phòng mà khách hàng đặt-->
                <?php
                if (!empty($list_room_detail_book)) {
                    ?>
                    <div class = "table-responsive">
                        <table id = "dataTableExample1" class = "table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr class = "info">
                                    <th class = "col-md-3">STT</th>
                                    <th class = "col-md-3">Số phòng</th>
                                    <th class = "col-md-3">Ngày nhận</th>
                                    <th class = "col-md-3">Ngày trả</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list_room_detail_book)) {
                                    $t = 0;
                                    foreach ($list_room_detail_book as $detail_room) {
                                        $t++;
                                        ?>
                                        <tr>
                                            <td><?php echo $t; ?></td>
                                            <td><?php echo $detail_room['roomNumber']; ?></td>
                                            <td><?php echo $detail_room['check_in']; ?></td>
                                            <td><?php echo $detail_room['check_out']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                }
                ?>
                
                <!-- Bảng chi tiêt đặt phòng -->
                <div class="table-responsive">
                    <table id="dataTableExample1" class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr class="info">
                                <th class="col-md-1">STT</th>
                                <th class="col-md-3">Loại phòng</th>
                                <!-- <th class="col-md-2">Giá phòng</th> -->
                                <th class="col-md-1">Số lượng</th>
                                <th class="col-md-2">Ngày đặt</th>
                                <th class="col-md-2">Tổng tiền</th>
                                <!-- <th class="col-md-1">Chỉnh sửa</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list_detail_bookroom)) {
                                $t = 0;
                                foreach ($list_detail_bookroom as $detail_bookroom) {
                                    $t++;
                                    ?>
                                    <tr>
                                        <td><?php echo $t; ?></td>
                                        <td><?php echo $detail_bookroom['name']; ?></td>
                                        <!-- <td><?php echo $detail_bookroom['price']; ?></td> -->
                                        <td><?php echo $detail_bookroom['number_room']; ?></td>
                                        <td><?php echo $detail_bookroom['date_set']; ?></td>
                                        <td><?php echo $detail_bookroom['total']; ?></td>
                                        <!-- <td>
                                            <button type="button" name="detailbillUpdate" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1" update-detailbill-id="<?php //echo $detail_bookroom['id']; ?>"><i class="fa fa-pencil"></i></button>
                                        </td> -->
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                

                <!--Bảng phụ thu-->
                <?php
                if (!empty($list_detail_surcharge)) {
                    ?>
                    <div class = "table-responsive">
                        <table id = "dataTableExample1" class = "table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr class = "info">
                                    <th class = "col-md-1">STT</th>
                                    <th class = "col-md-3">Tên sản phẩm</th>
                                    <th class = "col-md-2">Số lượng</th>
                                    <th class = "col-md-3">Giá</th>
                                    <th class = "col-md-3">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list_detail_surcharge)) {
                                    $t = 0;
                                    foreach ($list_detail_surcharge as $detail_surcharge) {
                                        $t++;
                                        ?>
                                        <tr>
                                            <td><?php echo $t; ?></td>
                                            <td><?php echo $detail_surcharge['name_product']; ?></td>
                                            <td><?php echo $detail_surcharge['number']; ?></td>
                                            <td><?php echo $detail_surcharge['price']; ?></td>
                                            <td><?php echo $detail_surcharge['sum_money']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
        <!-- update Room -->
        <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-user m-r-5"></i> Cập nhật chi tiết hóa đơn</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <!-- Số phòng-->
                                        <div class="col-md-4 form-group">
                                            <!--<input type="hidden" name="customerId" value=""/>-->
                                            <label class="control-label" style="margin-bottom: 10px;">Số phòng:</label>
                                            <input type="number" name="detailbillNumberRoom" min="1" max="" placeholder="" value="" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 form-group date">
                                            <input type="hidden" name="detailbillId" value=""/>
                                            <label class="control-label" style="margin-bottom: 10px;">Ngày nhận phòng:</label>
                                            <!--<input type="text" name="billReceived_date" placeholder="" value="" class="form-control">-->
                                            <input type="datetime" id='received-date' name="detailbillCheckIn"  class="form-control years" style="position: relative;" value=""/><i class="fa fa-calendar" style="position: absolute;top: 40px;right: 30px;"></i>
                                        </div>
                                        <div class="col-md-4 form-group date">
                                            <label class="control-label" style="margin-bottom: 10px;">Ngày trả phòng</label>
                                            <!--<input type="text" name="billPay_date" placeholder="" value="" class="form-control">-->
                                            <input type="datetime" id='pay-date' name="detailbillCheckOut" class="form-control years" style="position: relative;"/><i class="fa fa-calendar" style="position: absolute;top: 40px;right: 30px;"></i>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Số người lớn:</label>
                                            <input type="number" name="detailbill_Adults" placeholder="" value="" class="form-control"/>
                                        </div>
                                        <!--Trạng thái-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Số trẻ em:</label>
                                            <input type="number" name="detailbill_Childrens" placeholder="" value="" class="form-control"/>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-update-detail-bill-id" class="btn btn-add btn-sm" value="Save"/>
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
        <!--Thiết kế phân trang-->
    </section>
    <div class="clearfix"></div>
    <!-- /.content -->
</div>
<?php
get_footer();
?>
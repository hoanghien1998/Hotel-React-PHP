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
            <small>Thông tin hóa đơn</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content content-wp">
        <div class="row">
            <div class="col-sm-12">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                <div class="table-responsive">
                    <table id="dataTableExample1" class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr class="info">
                                <th class="col-md-1">STT</th>
                                <th class="col-md-3">Tên khách hàng</th>
                                <th class="col-md-3">Tổng tiền</th>
                                <th class="col-md-3">Trạng thái</th>
                                <th class="col-md-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list_bookroom)) {
                                $t = $start;
                                //global $room_id;
                                foreach ($list_bookroom as $bookroom) {
                                    $t++;
                                    ?>
                                    <tr>
                                        <td><?php echo $t; ?></td>
                                        <td><?php echo $bookroom['name']; ?></td>
                                        <td><?php echo $bookroom['total']; ?></td>
                                        <td><span class="<?php echo color_state_Bill($bookroom['state']); ?>"><?php echo state_Bill($bookroom['state']); ?></span></td>
                                        <td>
                                            <button type="button" name="billUpdate" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1" update-bill-id="<?php echo $bookroom['id']; ?>"><i class="fa fa-pencil"></i></button>
                                            <a name="roomtypeDetail" href="?mod=bill&controller=detail_bookroom&id=<?php echo $bookroom['id']; ?><?php
                                            if (isset($_GET['page'])) {
                                                echo "&page={$_GET['page']}";
                                            }
                                            ?>" class="btn btn-warning btn-sm" data-toggle="modal" del-room-type-id="<?php echo $bookroom['id']; ?>" title="Chi tiết loại phòng"><i class="fa fa-asterisk"></i> </a>
                                               <?php
                                               if ($bookroom['state'] == 0) {
                                                   ?>
                                                <button type="button" name="surchargeAdd" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#customer3" title="Thêm phụ thu" add-surcharge_bill-id="<?php echo $bookroom['id']; ?>"><i class="fa fa-plus"></i></button>
                                                <?php
                                            }
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
        <!-- add Phụ thu -->
        <div class="modal fade" id="customer3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-hotel m-r-5"></i> Thêm phụ thu</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <!-- Tên sản phẩm-->
                                        <div class="col-md-4 form-group">
                                            <input type="hidden" name="surcharge_Booking_code" value=""/>
                                            <label class="control-label" style="margin-bottom: 10px;">Tên sản phẩm:</label>
                                            <!--<input type="text" name="product_Name" placeholder="" value="" class="form-control">-->
                                            <select class="form-control" name="surcharge_Name" id="product_Name">
                                                <?php
                                                foreach ($get_list_product as $product) {
                                                    ?>
                                                    <option value="<?php echo $product['id']; ?>"><?php echo $product['name_product']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!--Số lượng-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Số lượng:</label>
                                            <input type="number" min="1" name="surcharge_Number" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-add-product" class="btn btn-add btn-sm" value="Save"/>
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
        <!-- update Room -->
        <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-hotel m-r-5"></i> Cập nhật hóa đơn</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <!-- Số phòng-->
                                        <div class="col-md-4 form-group">
                                            <input type="hidden" name="billId" value=""/>
                                            <label class="control-label" style="margin-bottom: 10px;">Tên khách hàng:</label>
                                            <p type="text" name="billName" placeholder="" value="" class="form-control"></p>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Tổng tiền:</label>
                                            <p type="text" name="billTotal" placeholder="" value="" class="form-control"></p>
                                        </div>
                                        <!--Trạng thái-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Trạng thái:</label>
                                            <select class="form-control" name="billState" id="billState">
                                                <option value="0">Chưa thanh toán</option>
                                                <option value="1">Đã thanh toán</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-update-bill-id" class="btn btn-add btn-sm" value="Save"/>
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
    <?php
    echo $get_pagging;
    ?>
    <div class="clearfix"></div>
    <!-- /.content -->
</div>
<?php
get_footer();
?>
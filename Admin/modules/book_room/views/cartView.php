<?php
get_header();
get_sidebar();
?>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header clearfix">
        <div class="fl-left">
            <div class="header-icon">
                <i class="fa fa-home"></i>
            </div>
            <div class="header-title">
                <h1>Quản lý đặt phòng</h1>
                <small>Thông tin đặt phòng</small>
            </div>
        </div>
        <!--CART-->
        <div class="fl-right cart-icon">
            <a href="?mod=book_room&action=cart" title="" id="btn-cart">
                <span class="hvr-buzz-out fa fa-cart-plus">
                    <span class="label label-primary num-order-cart"><?php
                        if (empty($get_number_room_cart['sum_number_room'])) {
                            echo 0;
                        }echo $get_number_room_cart['sum_number_room'];
                        ?></span>
                </span>
            </a>
        </div>
        <!--END CART-->

    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content content-wp">
        <div class="row">
            <div class="col-sm-12">
                <?php
                if (!empty($get_info_cart)) {
                    ?>
                    <div class="table-responsive">
                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr class="info">
                                    <th class="col-md-1">STT</th>
                                    <th class="col-md-3">Tên loại phòng</th>
                                    <!-- <th class="col-md-1">Giá($)</th> -->
                                    <th class="col-md-1">Số lượng</th>
                                    <th class="col-md-2">Ngày nhận phòng</th>
                                    <th class="col-md-2">Ngày trả phòng</th>
                                    <th class="col-md-1">Số người lớn</th>
                                    <th class="col-md-1">Số trẻ em</th>
                                    <th class="col-md-1">Chỉnh sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($get_info_cart)) {
                                    $t = 0;
                                    foreach ($get_info_cart as $info_room) {
                                        $t++;
                                        ?>
                                        <tr>
                                            <td><p><?php echo $t; ?></p></td>
                                            <td><?php echo $info_room['name']; ?></td>
                                            <!-- <td><?php 
                                            // if($info_room['price_discount']>0 && ($info_room['date_start']<= date('Y-m-d') && $info_room['date_end']>= date('Y-m-d'))){
                                            //     echo number_format($info_room['price_discount']);
                                            // }else{
                                            //     echo number_format($info_room['price']);
                                            // }
                                             ?></td> -->
                                            <td><?php echo $info_room['number_room']; ?></td>
                                            <td><?php echo $info_room['check_in']; ?></td>
                                            <td><?php echo $info_room['check_out']; ?></td>
                                            <td><?php echo $info_room['number_adults']; ?></td>
                                            <td><?php echo $info_room['number_childrens']; ?></td>
                                            <td>
                                                <button type="button" name="cartUpdate" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1" update-cart-id="<?php echo $info_room['id_roomtype'];  ?>" title="Cập nhật giỏ hàng"><i class="fa fa-pencil"></i></button>
                                                <a href="?mod=book_room&action=cart&del-cart-room-type-id=<?php echo $info_room['id_roomtype']; ?>" name="cart_roomtypeDelete" class="btn btn-danger btn-sm" del-cart-room-type-id="<?php echo $info_room['id_roomtype']; ?>" title="Xóa loại phòng"><i class="fa fa-trash-o"></i> </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!--Xác nhận đặt phòng-->
                        <div class="fl-right">
                            <a href="?mod=book_room&controller=book_room" style="font-size: 15px;
                               margin-bottom: 25px;"class="btn btn-add btn-sm" title="Xác nhận đặt phòng">Xác nhân đặt phòng</a>
                        </div>
                        <!--END Xác nhận đặt phòng-->
                    </div>
                    <?php
                } else {
                    ?>
                    <p>Chưa có phòng được đặt, vui lòng click <a href="?mod=book_room"><u>Tại đây</u></a> để đặt hàng</p>
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
                        <h3><i class="fa fa-user m-r-5"></i> Cập nhật giỏ hàng</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                                    <fieldset>
                                        <!-- Số phòng-->
                                        <div class="col-md-4 form-group">
                                            <input type="hidden" name="cartId" value=""/>
                                            <label class="control-label">Số lượng:</label>
                                            <input type="number" name="cartNumber" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Ngày nhận phòng:</label>
                                            <input type="datetime" id='received-date' name="receiveddate_BookRoom"  class="form-control years" style="position: relative;" value=""/><i class="fa fa-calendar" style="position: absolute;top: 30px;right: 30px;"></i>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Ngày trả phòng:</label>
                                            <input type="datetime" id='pay-date' name="paydate_BookRoom" class="form-control years" style="position: relative;"/><i class="fa fa-calendar" style="position: absolute;top: 30px;right: 30px;"></i>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Số người lớn:</label>
                                            <input type="number" name="adults_BookRoom" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Số trẻ em:</label>
                                            <input type="number" name="childrens_BookRoom" class="form-control"/>
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-update-cart-id" class="btn btn-add btn-sm" value="Save"/>
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
    </section>
    <!-- /.content -->
</div>
<?php
get_footer();
?>


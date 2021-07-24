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
                <small>Đặt phòng</small>
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
        <?php //show_array($check_in_date); ?>
        <!--END CART-->

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel lobidisable panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Chọn loại phòng</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST">
                            <div class="form-group">
                                <!--Ngày đặt-->
                                <div class="form-group">
                                    <div class="field-wl">
                                        <label class="lbl-book">Ngày nhận phòng</label>
                                        <div class=" input-group date form_date">
                                            <input type="text" id='received-date' name="checkin_BookRoom"  class="form-control years" value="<?php if(isset($_POST['btn-search-roomtype'])){echo $_POST['checkin_BookRoom'];}else{echo date("Y-m-d");} ?>" /><span class="input-group-addon"><a><i class="fa fa-calendar"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                <!--ngày trả-->
                                <div class="form-group">
                                    <div class="field-wr">
                                        <label class="lbl-book">Ngày trả phòng</label>
                                        <div class=" input-group date form_date">
                                            <input type="text" id='pay-date' name="checkout_BookRoom" class="form-control years" value="<?php if(isset($_POST['btn-search-roomtype'])){echo $_POST['checkout_BookRoom'];}else{echo date("Y-m-d");} ?>"/><span class="input-group-addon"><a><i class="fa fa-calendar"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                <!--Tìm kiếm-->
                                <div class="form-group text-center">
                                    <input type="submit" name="btn-search-roomtype" class="btn btn-add" value="Tìm kiếm"/>
                                </div>
                                <label class="lbl-book">Loại phòng</label>
                                <!--<input type="text" class="form-control" placeholder="Nhập loại phòng" required>-->
                                <select class="form-control" name="roomType" id="roomType_select">
                                    <?php
                                    foreach ($get_list_room_type as $room_type) {
                                        ?>
                                        <option value="<?php echo $room_type['id']; ?>" count_room="<?php echo $room_type['count_room']; ?>"><?php echo $room_type['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--Số lượng-->
                            <div class="form-group">
                                <label class="lbl-book">Số lượng</label>
                                <input type="number" name="count_room" min="1" max="" value="1" class="form-control">
                            </div>

                            <!--Người lớn-->
                            <div class="form-group">
                                <div class="field-wl">
                                    <label class="lbl-book">Số người lớn</label>
                                    <div class=" input-group date form_date">
                                        <input type="number"name="adults_BookRoom" min="1" value="1" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <!--Trẻ em-->
                            <div class="form-group">
                                <div class="field-wr">
                                    <label class="lbl-book">Số trẻ em</label>
                                    <div class=" input-group date form_date">
                                        <input type="number" name="childrens_BookRoom" min="0" value="0" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="btn-add-roomtype-cart" class="btn btn-add" value="Thêm vào đặt phòng"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="panel lobidisable panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Số lượng phòng theo loại phòng</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="info">
                                        <th>Loại phòng</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!isset($_POST['btn-search-roomtype'])) {
                                        foreach ($check_in_now as $room_type) {
                                            ?>
                                            <tr>
                                                <td><?php echo $room_type['name']; ?></td>
                                                <td><?php echo $room_type['number']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        foreach ($number_room_empty as $room_type) {
                                            ?>
                                            <tr>
                                                <td><?php echo $room_type['name']; ?></td>
                                                <td><?php echo $room_type['number']; ?></td>
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
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php
get_footer();
?>  

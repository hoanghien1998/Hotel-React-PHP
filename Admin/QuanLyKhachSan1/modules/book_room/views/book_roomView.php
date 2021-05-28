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
            <?php
            //echo  date("Y-m-d");
            ?>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="panel-body">
                <form method="POST">
                    <div class="col-sm-7">
                        <h3 class="title-book">Thông tin khách hàng</h3>
                        <div class="detail">
                            <div class="field-wl">
                                <label class="lbl-book">Họ và tên</label>
                                <input type="text" name="name_BookRoom" class="input-book" placeholder=" <?php echo error('fullname'); ?>" value="<?php echo set_value('fullname'); ?>"/>
                                 <?php // echo form_error('fullname'); ?>
                            </div>
                            <div class="field-wr">
                                <label class="lbl-book">CMND</label>
                                <input type="text" name="cmnd_BookRoom" class="input-book" placeholder=" <?php echo error('cmnd'); ?>" value="<?php echo set_value('cmnd'); ?>"/>
                            </div>
                            <div class="field-wl">
                                <label class="lbl-book">Số điện thoại</label>
                                <input type="text" name="phone_BookRoom" class="input-book" placeholder=" <?php echo error('phone'); ?>" value="<?php echo set_value('phone'); ?>"/>
                            </div>
                            <div class="field-wr">
                                <label class="lbl-book">Email</label>
                                <input type="email" name="email_BookRoom" class="input-book" placeholder=" <?php echo error('email'); ?>" value="<?php echo set_value('email'); ?>"/>
                            </div>
                            <div class="">
                                <label class="lbl-book">Địa chỉ</label>
                                <!--<input type="text" class="input-book"/>-->
                                <textarea class="input-book" name="address_BookRoom" placeholder=" <?php echo error('address'); ?>" value="<?php echo set_value('address'); ?>" style="min-height:130px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <h3  class="title-book">Thông tin đặt phòng</h2>
                            <div class="detail">
                                <?php
                                if (!empty($get_info_cart)) {
//                                    show_array($get_info_cart);
                                    ?>
                                    <table class="shop-table">
                                        <thead>
                                            <tr>
                                                <td>Loại phòng x Số phòng x Số ngày</td>
                                                <td>Tổng<td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tong_tien_1_ngay = 0;
                                            foreach ($get_info_cart as $info_cart) {
                                                $tong_tien_1_ngay = $tong_tien_1_ngay + $info_cart['total_sum'];
                                                ?>
                                                <tr>
                                                    <td><span><?php echo $info_cart['name']; ?></span> x <span><?php echo $info_cart['number_room']; ?> </span></span> x <span><?php echo $info_cart['number_day']; ?> </span></td>
                                                    <td><?php echo $info_cart['total_sum']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><span>Tổng tiền: (VND)</span></td>
                                                <td><span><?php echo $tong_tien_1_ngay; ?></span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="place-order-wp clearfix">
                                        <input type="submit" value="Đặt phòng" name="btn-book-room"/>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php
get_footer();
?>


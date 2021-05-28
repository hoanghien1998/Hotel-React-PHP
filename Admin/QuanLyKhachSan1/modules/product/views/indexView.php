<?php
get_header();
get_sidebar();
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-product-hunt"></i>
        </div>
        <div class="header-title">
            <h1>Sản phẩm</h1>
            <small>Danh sách sản phẩm</small>
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
                            <button type="button" name="productAdd" class="btn btn-add btn-sm m-b-10" data-toggle="modal" data-target="#customer3" room-id=""><i class="fa fa-plus"></i>Thêm sản phẩm</button>
                        </div>
                    <?php }
                    ?>
                </div>
                <!--bảng danh sách sản phẩm-->
                <?php
                if (!empty($list_product)) {
                    ?>
                    <div class="table-responsive">
                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr class="info">
                                    <th class="col-md-1">STT</th>
                                    <th class="col-md-5">Tên sản phẩm</th>
                                    <th class="col-md-2">Giá</th>
                                    <th class="col-md-2">Số lượng</th>
                                    <th class="col-md-2">Chỉnh sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list_product)) {
                                    $t = $start;
                                    // global $room_id;
                                    foreach ($list_product as $product) {
                                        $t++;
                                        ?>
                                        <tr>
                                            <td><?php echo $t; ?></td>
                                            <td><?php echo $product['name_product']; ?></td>
                                            <td><?php echo $product['price']; ?></td>
                                            <td><?php echo $product['number']; ?></td>
                                            <td>
                                                <button type="button" name="productUpdate" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1" product-id="<?php echo $product['id']; ?>"><i class="fa fa-pencil"></i></button>
                                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                                                    ?>
                                                    <button type="button" name="productDelete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2" del-product-id="<?php echo $product['id']; ?>"><i class="fa fa-trash-o"></i> </button>
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
        <!-- add Room -->
        <div class="modal fade" id="customer3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-product-hunt m-r-5"></i> Thêm sản phẩm</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <!-- Tên sản phẩm-->
                                        <div class="col-md-4 form-group">
                                            <!--<input type="hidden" name="productId" value=""/>-->
                                            <label class="control-label" style="margin-bottom: 10px;">Tên sản phẩm:</label>
                                            <input type="text" name="product_Name" placeholder="" value="" class="form-control">
                                        </div>
                                        <!--Giá-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Giá:</label>
                                            <input type="text" name="product_Price" placeholder="" value="" class="form-control">
                                        </div>
                                        <!--Số lượng-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Số lượng:</label>
                                            <input type="text" name="product_Number" placeholder="" value="" class="form-control">
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
        <!-- /.modal -->
        <!-- update Room -->
        <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog w-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><i class="fa fa-product-hunt m-r-5"></i> Cập nhật sản phẩm</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <!-- Số phòng-->
                                        <div class="col-md-4 form-group">
                                            <input type="hidden" name="productId" value=""/>
                                            <label class="control-label" style="margin-bottom: 10px;">Tên sản phẩm:</label>
                                            <input type="text" name="productName" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Giá sản phẩm:</label>
                                            <input type="text" name="productPrice" placeholder="" value="" class="form-control">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label class="control-label" style="margin-bottom: 10px;">Số lượng:</label>
                                            <input type="text" name="productNumber" placeholder="" value="" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                            <div class="pull-right">
                                                <input type="submit" name="save-update-product-id" class="btn btn-add btn-sm" value="Save"/>
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
                        <h3><i class="fa fa-user m-r-5"></i> Xóa sản phẩm</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST">
                                    <fieldset>
                                        <div class="col-md-12 form-group user-form-group">
                                            <label class="control-label">Bạn có chắc chắn muốn xóa sản phẩm này không:</label>
                                            <div class="pull-right">
                                                <input type="hidden" name="productId" value=""/>
                                                <input type="button" class="btn btn-danger btn-sm"  data-dismiss="modal" value="NO"/>
                                                <input type="submit" name="btn-delete-product" class="btn btn-add btn-sm" value="YES"/>
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
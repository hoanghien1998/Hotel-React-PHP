<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from thememinister.com/crm/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:09:03 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Đăng nhập quản lý khách sạn</title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="public/dist/img/ico/favicon.png" type="image/x-icon">
        <!-- Bootstrap -->
        <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="public/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Pe-icon-7-stroke -->
        <link href="public/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- style css -->
        <link href="public/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style_login.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <!--<link href="public/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper">
            <div class="container-center">
                <div class="login-area">
                    <div class="panel panel-bd panel-custom">
                        <div class="panel-heading">
                            <div class="view-header">
                                <div class="header-icon">
                                    <i class="pe-7s-unlock"></i>
                                </div>
                                <div class="header-title">
                                    <h3>Đăng nhập</h3>
                                    <small><strong>Vui lòng nhập thông tin tài khoản để đăng nhập.</strong></small>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="" method="POST" id="loginForm" novalidate>
                                <div class="form-group">
                                    <label class="control-label" for="username">Tên đăng nhập</label>
                                    <input type="text" placeholder="tendangnhap" title="Vui lòng nhập tên đăng nhập vào đây" required="" value="<?php echo set_value('username'); ?>" name="username" id="username" class="form-control">
                                    <?php echo form_error('username'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Mật khẩu</label>
                                    <input type="password" title="Please enter your password" placeholder="Vui lòng nhập mật khẩu vào đây" required="" value="" name="password" id="password" class="form-control">
                                    <?php echo form_error('password'); ?>
                                    <?php echo form_error('account'); ?>
                                </div>
                                <div style="width: 100%; text-align: center;">
                                    <input type="submit" class="btn btn-add" name="btn-login" value="Đăng nhập"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="public/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>

<!-- Mirrored from thememinister.com/crm/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:09:03 GMT -->
</html>
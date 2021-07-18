<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from thememinister.com/crm/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:06:57 GMT -->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home manager hotel</title>
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="public/dist/img/ico/favicon.png" type="image/x-icon">
        <!-- Start Global Mandatory Style
           =====================================================================-->
        <!-- jquery-ui css -->
        <link href="public/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap -->
        <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="public/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Lobipanel css -->
        <link href="public/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pace css -->
        <link href="public/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link href="public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon -->
        <link href="public/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- Themify icons -->
        <link href="public/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
        <!-- End Global Mandatory Style
           =====================================================================-->
        <!-- Start page Label Plugins 
           =====================================================================-->
        <!-- Emojionearea -->
        <link href="public/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" type="text/css"/>
        <!-- Monthly css -->
        <link href="public/plugins/monthly/monthly.css" rel="stylesheet" type="text/css"/>
        <!-- End page Label Plugins 
           =====================================================================-->
        <!-- Start Theme Layout Style
           =====================================================================-->
        <!-- Theme style -->
        <link href="public/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <!--<link href="public/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
        <!-- End Theme Layout Style
           =====================================================================-->
        <!--style tự thêm-->
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style.css" rel="stylesheet" type="text/css"/>
    <a href="libraties/ckeditor/config.js"></a>
</head>
<body class="hold-transition sidebar-mini">
    <!--preloader-->
    <div id="preloader">
        <div id="status"></div>
    </div>
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <a href="?" class="logo">
                <!-- Logo -->
                <span class="logo-mini">
                    <img src="public/dist/img/mini-logo.png" alt="">
                </span>
                <span class="logo-lg">
                    <!--<img src="public/dist/img/logoks1.png" alt="">-->
                    <span class="logo-ks">ROXANDREA</span>
                </span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <!-- Sidebar toggle button-->
                    <span class="sr-only">Toggle navigation</span>
                    <span class="pe-7s-angle-left-circle"></span>
                    <span id="<?php if (isset($message_submit)) echo "message-submit"; ?>" style="<?php if (isset($message_submit)) echo "display: initial;position: relative;background: #fff;
                          font-size: 20px;
                          padding: 10px;
                          color: #e5343d;"; ?>"><?php if (isset($message_submit)) echo $message_submit; ?></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User -->
                        <li class="dropdown dropdown-help hidden-xs">
                            <a id="user_login" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $_SESSION['user_login']; ?></a>
                            <!--                            <ul class="dropdown-menu" >
                                                            <li>
                                                                <a href="profile.html">
                                                                    <i class="fa fa-line-chart"></i> Networking</a>
                                                            </li>
                                                            <li><a href="#"><i class="fa fa fa-bullhorn"></i> Lan settings</a></li>
                                                            <li><a href="#"><i class="fa fa-bar-chart"></i> Settings</a></li>
                                                            <li><a href="login.html">
                                                                    <i class="fa fa-wifi"></i> wifi</a>
                                                            </li>
                                                        </ul>-->
                        </li>
                        <!-- user -->
                        <li class="dropdown dropdown-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="public/dist/img/avatar5.png" class="img-circle" width="45" height="45" alt="user"></a>
                            <ul class="dropdown-menu" >
                                <li><a href="?mod=admin&controller=login&action=logout">
                                        <i class="fa fa-sign-out"></i> Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
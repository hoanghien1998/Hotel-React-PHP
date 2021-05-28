
<!-- =============================================== -->
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="?"><i class="fa fa-tachometer"></i><span>Trang chủ</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-home"></i><span>Quản lý phòng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="?mod=room&controller=roomtype&action=list_room_type">Danh sách loại phòng</a></li>
                    <li><a href="?mod=room&controller=room&action=list_room">Danh sách phòng</a></li>
                </ul>
            </li>
            <!--<li><a href="?mod=book_room"><i class="fa fa-home"></i><span>Quản lý đặt phòng</span></a></li>-->
            <li><a href="?mod=customer&controller=customer&action=list_customer"><i class="fa fa-users"></i><span>Quản lý khách hàng</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="hvr-buzz-out fa fa-hotel"></i><span>Quản lý đặt phòng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="?mod=book_room">Đặt phòng</a></li>
                    <li><a href="?mod=bill">Hóa đơn</a></li>
                </ul>
            </li>
            <!--Product-->
            <li class="active">
                <a href="?mod=product"><i class="fa fa-product-hunt"></i><span>Quản lý phụ thu</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
<?php
get_header();
get_sidebar();
?>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-dashboard"></i>
        </div>
        <div class="header-title">
            <h1>Trang chủ</h1>
            <small>Thống kê</small>
            <?php
//            echo time() - $_SESSION['time_login'];
//            echo "hihi";
//            echo time();
//            echo "hihi";
//            echo $_SESSION['time_login'];
//            echo "role";
//            echo $_SESSION['role'];
            ?>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox1">
                    <div class="statistic-box">
                        <i class="fa fa-user-plus fa-3x"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number"><?php echo $number_customer['number_customer']; ?></span> 
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                            </span>
                        </div>
                        <h3> Số khách hàng</h3>
                    </div>
                </div>
            </div>
            <!--            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div id="cardbox2">
                                <div class="statistic-box">
                                    <i class="fa fa-user-secret fa-3x"></i>
                                    <div class="counter-number pull-right">
                                        <span class="count-number">4</span> 
                                        <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                                        </span>
                                    </div>
                                    <h3>  Active Admin</h3>
                                </div>
                            </div>
                        </div>-->
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox3">
                    <div class="statistic-box">
                        <i class="fa fa-money fa-3x"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number"><?php
                                if (!empty($sum_money_one_year)) {
                                    echo currency_format($sum_money_one_year['Sum_year'], $suffix = 'vnd');
                                }
                                ?></span> 
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                            </span>
                        </div>
                        <h3>  Doanh thu năm(<?php echo date("Y"); ?>)</h3>
                    </div>
                </div>
            </div>
            <!--            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div id="cardbox4">
                                <div class="statistic-box">
                                    <i class="fa fa-files-o fa-3x"></i>
                                    <div class="counter-number pull-right">
                                        <span class="count-number">11</span> 
                                        <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                                        </span>
                                    </div>
                                    <h3> Running Projects</h3>
                                </div>
                            </div>
                        </div>-->
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Thống kê doanh thu</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!--XỬ LÝ Ở ĐÂY-->
                        <script>
                            window.onload = function () {

                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    exportEnabled: true,
                                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                                    title: {
                                        text: "Doanh thu theo tháng trong năm <?php echo date("Y"); ?>",
                                        fontSize: 25,
                                        fontFamily: "arial",
                                        fontWeight: "bold",
                                        horizontalAlign: "center",
                                        fontColor: "red"
                                    },
                                    axisY: {
                                        title: "Tiền(VND)",
                                        titleFontColor: "red",
                                        titleFontSize: 16,
                                        includeZero: true
                                    },
                                    axisX: {
                                        title: "Tháng",
                                        titleFontColor: "red",
                                        titleFontSize: 16,
                                        includeZero: true,
                                        interval: 1, //biểu thị khoảng cách giữa các cột, 12345...
                                    },
                                    data: [{
                                            type: "column", //change type to bar, line, area, pie, etc
                                            indexLabel: "{y}", //Shows y value on all Data Points
                                            //indexLabel: "{x}",
                                            indexLabelFontColor: "#5A5757",
                                            indexLabelPlacement: "outside",
                                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                        }]
                                });
                                chart.render();

                                var chart11 = new CanvasJS.Chart("chartContainer1", {
                                    animationEnabled: true,
                                    exportEnabled: true,
                                    theme: "light1",
                                    title: {
                                        text: "Tỉ lệ loại phòng",
                                        fontSize: 25,
                                        fontFamily: "arial",
                                        fontWeight: "bold",
                                        horizontalAlign: "center",
                                        fontColor: "red"
                                    },
//                                    subtitles: [{
//                                            text: "Currency Used: Thai Baht (฿)"
//                                        }],
                                    data: [{
                                            type: "pie",
                                            showInLegend: "true",
                                            legendText: "{name}",
                                            indexLabelFontSize: 16,
                                            indexLabel: "{name} - #percent%",
                                            yValueFormatString: "SOPHONG:#,##0",
                                            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                                        }]
                                });
                                chart11.render();
                            }
                        </script>
                        <input type="hidden" name="thongke_DoanhThu"/>
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        <!--KÊT THÚC XỬ LÝ-->
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Loại phòng ưa chuộng</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
get_footer();
?>
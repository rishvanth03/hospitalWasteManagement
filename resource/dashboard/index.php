    <!DOCTYPE html>
    <html lang="en">


    <?php
    include '../../include/init.php';
    $path = $GLOBALS['_path'];
    head();
    checkSession();
    include '../../api/db/connection.php';
    $db = db();
    $userData = array();
    $userData = $_SESSION['userDataHwms'];

    if ($userData['roleId'] == 2) {
        header("Location: ../wastage");
    }

    ?>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">

                <!-- LOGO -->
                <a href="index-2.html" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="<?php echo $path ?>/assets/images/logo.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="<?php echo $path ?>/assets/images/logo_sm.png" alt="" height="16">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="index-2.html" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="<?php echo $path ?>/assets/images/logo-dark.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="<?php echo $path ?>/assets/images/logo_sm_dark.png" alt="" height="16">
                    </span>
                </a>

                <div class="h-100" id="leftside-menu-container" data-simplebar>

                    <!--- Sidemenu -->
                    <?php menu() ?>

                    <!-- Help Box -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <?php navbar() ?>
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <form class="d-flex">
                                            <a onclick="Wreload()" class="btn btn-primary ms-2">
                                                <i class="mdi mdi-autorenew"></i>
                                            </a>
                                        </form>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-3 col-lg-4">
                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class='uil uil-users-alt float-end'></i>
                                        <h6 class="text-uppercase mt-0">Active Hospital</h6>
                                        <h2 class="my-2">
                                            <?php

                                            $sql = "select count(*) from master_hospital";
                                            $result = mysqli_query($db, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            echo $row['count(*)'];

                                            ?>
                                        </h2>
                                        <p class="mb-0 text-muted">
                                            <span class="text-nowrap">Since Today</span>
                                        </p>
                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!--end card-->

                                <div class="card tilebox-one">
                                    <div class="card-body">
                                        <i class='uil uil-window-restore float-end'></i>
                                        <h6 class="text-uppercase mt-0">Today's Wastage</h6>
                                        <h2 class="my-2">
                                            <?php
                                            $date = date("Y-m-d");

                                            $sql = "select sum(quanity_kg) from wastage_log where date = '$date'";
                                            $result = mysqli_query($db, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            if ($row['sum(quanity_kg)'] != null) {


                                                echo $row['sum(quanity_kg)'] . " Kg";
                                            } else {
                                                echo "0 Kgs";
                                            }

                                            ?>
                                        </h2>
                                        <p class="mb-0 text-muted">
                                            <span class="text-nowrap">Since Today</span>
                                        </p>
                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!--end card-->

                                <div class="card cta-box overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h3 class="m-0 fw-normal cta-box-title">A Clean Hospital is a <b>Healthy Hospital</b> <i class="mdi mdi-arrow-right"></i></h3>
                                            </div>
                                            <img class="ms-3" src="<?php echo $path ?>/assets/images/logo.jpeg" width="92" alt="Generic placeholder image">
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-9 col-lg-8">
                                <div class="card card-h-100">
                                    <div class="card-body">

                                        <h4 class="header-title mb-3">Total Wastage ( Past 15 Days )</h4>

                                        <div dir="ltr">
                                            <div id="sessions-overview" class="apex-charts mt-3" data-colors="#0acf97"></div>
                                        </div>
                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card-->
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-1 mb-3">Wastage By city</h4>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-centered mb-0 font-14">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>City</th>
                                                        <th>Wastage</th>
                                                        <th style="width: 40%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php

                                                    $sql = "SELECT SUM(quanity_kg) FROM wastage_log";
                                                    $result = mysqli_query($db, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        $row = mysqli_fetch_assoc($result);

                                                        $total = $row['SUM(quanity_kg)'];

                                                        $sql = "SELECT city,SUM(quanity_kg) FROM wastage_log wl INNER JOIN master_hospital mh ON mh.user_id = wl.hospital_⁯id GROUP BY mh.city";
                                                        $result = mysqli_query($db, $sql);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $progress = $row['SUM(quanity_kg)'] / $total * 100;
                                                            echo "<tr>
                                                                <td>$row[city]</td>
                                                                <td>" . $row['SUM(quanity_kg)'] . " Kgs</td>
                                                                <td>
                                                                    <div class='progress' style='height: 3px;'>
                                                                        <div class='progress-bar bg-danger' role='progressbar' style='width: $progress%; height: 20px;' aria-valuenow='$progress' aria-valuemin='0' aria-valuemax='100'></div>
                                                                    </div>
                                                                </td>
                                                            </tr>";
                                                        }
                                                    }



                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive-->
                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card-->
                            </div>

                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-1 mb-3">Wastage By Types</h4>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-centered mb-0 font-14">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Types</th>
                                                        <th>Wastage</th>
                                                        <th style="width: 40%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php

                                                    $sql = "SELECT SUM(quanity_kg) FROM wastage_log";
                                                    $result = mysqli_query($db, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        $row = mysqli_fetch_assoc($result);

                                                        $total = $row['SUM(quanity_kg)'];

                                                        $sql = "SELECT type,SUM(quanity_kg) FROM wastage_log wl GROUP BY type";
                                                        $result = mysqli_query($db, $sql);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $progress = $row['SUM(quanity_kg)'] / $total * 100;
                                                            echo "<tr>
                                                                <td>$row[type]</td>
                                                                <td>" . $row['SUM(quanity_kg)'] . " Kgs</td>
                                                                <td>
                                                                    <div class='progress' style='height: 3px;'>
                                                                        <div class='progress-bar bg-danger' role='progressbar' style='width: $progress%; height: 20px;' aria-valuenow='$progress' aria-valuemin='0' aria-valuemax='100'></div>
                                                                    </div>
                                                                </td>
                                                            </tr>";
                                                        }
                                                    }



                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive-->
                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card-->
                            </div>
                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">Wastage Status</h4>

                                        <div id="sessions-os" class="apex-charts mt-3" data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00"></div>

                                        <div class="row text-center mt-2">
                                            <div class="col-6">
                                                <h4 class="fw-normal">
                                                    <span>
                                                        <?php


                                                        $sql = "select count(status) from wastage_log where status = '0'";
                                                        $result = mysqli_query($db, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        if ($row['count(status)'] != null) {
                                                            echo $row['count(status)'] . " Requests";
                                                        } else {
                                                            echo "0 Requests";
                                                        }


                                                        ?>
                                                    </span>
                                                </h4>
                                                <p class="text-muted mb-0">Total Pending Request</p>
                                            </div>
                                            <div class="col-6">
                                                <h4 class="fw-normal">
                                                    <span>
                                                        <?php
                                                        $date = date("Y-m-d");

                                                        $sql = "select count(status) from wastage_log where status = '2'";
                                                        $result = mysqli_query($db, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        if ($row['count(status)'] != null) {
                                                            echo $row['count(status)'] . " Requests";
                                                        } else {
                                                            echo "0 Requests";
                                                        }

                                                        ?>
                                                    </span>
                                                </h4>
                                                <p class="text-muted mb-0">Waiting PickUp</p>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end card-body
                                </div>
                                <!-- end card-->
                                </div>
                                <!-- end col-->
                            </div>
                            <!-- end row -->


                        </div>
                        <!-- container -->

                    </div>
                    <!-- content -->

                    <!-- Footer Start -->
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> © Hyper - Coderthemes.com
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end footer-links d-none d-md-block">
                                        <a href="javascript: void(0);">About</a>
                                        <a href="javascript: void(0);">Support</a>
                                        <a href="javascript: void(0);">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- end Footer -->

                </div>

                <!-- ============================================================== -->
                <!-- End Page content -->
                <!-- ============================================================== -->


            </div>
            <!-- END wrapper -->

            <!-- Right Sidebar -->
          <?php  
          settings()
          ?>

            <div class="rightbar-overlay"></div>
            <!-- /End-bar -->

            <?php footer() ?>

            <script src="<?php echo $path ?>/assets/js/vendor/apexcharts.min.js"></script>
            <script src="<?php echo $path ?>/assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="<?php echo $path ?>/assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
            <!-- third party js ends -->

            <script>
                function Wreload() {
                    location.reload()
                }
                $.ajax({
                    url: '../../api/dashboard/chart.php',
                    method: 'post',
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        let data = []
                        let axis = []
                        data = result.data;
                        axis = result.axis;
                        getChart(data, axis)
                    }
                })


                function getChart(data, axis) {
                    window.Apex = {
                        chart: {
                            parentHeightOffset: 0,
                            toolbar: {
                                show: !1
                            }
                        },
                        grid: {
                            padding: {
                                left: 0,
                                right: 0
                            }
                        },
                        colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
                    };

                    a = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
                    o = $("#sessions-overview").data("colors");
                    o && (a = o.split(","));
                    var r = {
                        chart: {
                            height: 350,
                            type: "area"
                        },
                        dataLabels: {
                            enabled: !1
                        },
                        stroke: {
                            curve: "smooth",
                            width: 4
                        },
                        series: [{
                            name: "Sessions",
                            data: data
                        }],
                        zoom: {
                            enabled: !1
                        },
                        legend: {
                            show: !1
                        },
                        colors: a,
                        xaxis: {
                            type: "string",
                            categories: axis,
                            tooltip: {
                                enabled: !1
                            },
                            axisBorder: {
                                show: !1
                            },
                            labels: {}
                        },
                        yaxis: {
                            labels: {
                                formatter: function(e) {
                                    return e + " kg"
                                },
                                offsetX: -15
                            }
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                type: "vertical",
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: .45,
                                opacityTo: .05,
                                stops: [45, 100]
                            }
                        }
                    };
                    new ApexCharts(document.querySelector("#sessions-overview"), r).render();
                }
            </script>

            <!-- demo app -->
            <script src="<?php echo $path ?>/assets/js/pages/demo.dashboard-analytics.js"></script>

    </body>

    </html>
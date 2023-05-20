<!DOCTYPE html>
<html lang="en">


<?php
include '../../include/init.php';
$path = $GLOBALS['_path'];
head();
checkSession();
include '../../api/db/connection.php';
$db = db();
$res_id = 2;
$userData = array();
$userData = $_SESSION['userDataHwms'];

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
                                <h4 class="page-title">Wastage In</h4>
                            </div>
                        </div>
                    </div>

                    <div style="padding:20px" class="card">
                        <table class="table table-centered table-striped mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S.No</th>
                                    <th>Hospital</th>
                                    <th>Wastage Type</th>
                                    <th>Quanity (in Kg)</th>
                                    <th>Status</th>
                                    <th style="width: 300px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="wastageInBody">

                                <tr>
                                    <th colspan="7">Loading</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="danger-alert" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-danger">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-wrong h1"></i>
                                        <h4 class="mt-2">Error!</h4>
                                        <p id="dangerMsg" class="mt-3"></p>
                                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <div id="success-alert" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-success">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-checkmark h1"></i>
                                        <h4 class="mt-2">Success</h4>
                                        <p id="successMsg" class="mt-3"></p>
                                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Continue</button>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
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
        <?php settings() ?>

        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->

        <?php footer() ?>

        <script>
            getWastage()

            function toast(message, isSuccess) {
                if (isSuccess) {
                    $('#successMsg').text(message)
                    $('#success-alert').modal('show')
                } else {
                    $('#dangerMsg').text(message)
                    $('#danger-alert').modal('show')
                }
            }

            function ApproveState(state, id) {
                $.ajax({
                    url: '../../api/wastageIn/approve.php',
                    method: 'post',
                    data: {
                        id,
                        state
                    },
                    dataType: 'json',
                    success: function(result) {
                        toast(result.message, result.success)
                        getWastage()
                    }
                })
            }

            function getWastage() {
                $.ajax({
                    url: '../../api/wastageIn/getAll.php',
                    method: 'post',
                    dataType: 'json',
                    success: function(result) {
                        $('#wastageInBody').empty()
                        if (result.success) {
                            let data = result.data;
                            let i = 1;

                            data.forEach(element => {
                                let status = '';
                                let button = `
                                    <button type="button" onClick=ApproveState(1,${element.id}) class="btn btn-primary btn-rounded btn-sm" ><i class="uil-check"></i> Approve</button>
                                    <button type="button" onClick=ApproveState(3,${element.id}) class="btn btn-danger btn-rounded btn-sm" ><i class="uil-ban"></i> Reject</button>
                             `;

                                if (element.status == '0') {
                                    status = '<i class="mdi mdi-circle text-primary"></i> Pending'
                                } else if (element.status == '1') {
                                    status = '<i class="mdi mdi-circle text-success"></i> Accepted'
                                } else if (element.status == '2') {
                                    status = '<i class="mdi mdi-circle text-warning"></i> Time Alloted'
                                } else if (element.status == '3') {
                                    status = '<i class="mdi mdi-circle text-danger"></i> Rejected'
                                } else if (element.status == '4') {
                                    status = '<i class="mdi mdi-circle text-success"></i> Picked Up'
                                }
                                $('#wastageInBody').append(`
                                    <tr>
                                        <th>${i}</th>
                                        <td>${element.name}</td>
                                        <td>${element.type}</td>
                                        <td>${element.quanity_kg} Kg</td>
                                        <td>${status}</td>
                                        <td>${button}</td>
                                    </tr>
                                `)

                                i++
                            });
                        } else {
                            $('#wastageInBody').append(`
                                    <tr>
                                        <th colspan="7">${result.message}</th>
                                    </tr>
                                `)
                        }
                    },
                    error: function(result) {
                        console.log(result)
                    }
                })
            }
        </script>

</body>

</html>
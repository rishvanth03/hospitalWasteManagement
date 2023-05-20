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
                                <h4 class="page-title">Wastage Out</h4>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#add-new"><i class="uil-plus"></i> Rise Ticket</button> <br><br>

                    <div id="add-new" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="standard-modalLabel">Rise Ticket</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <!-- <input type="text" id="type" class="form-control" placeholder="Enter the Wastage Type"> -->
                                        <select name="type" id="type"class="form-control">
                                            <option value="Infectious">Infectious Waste</option>
                                            <option value="Sharps">Sharps Waste</option>
                                            <option value="Pharmaceutical">Pharmaceutical Waste</option>
                                            <option value="Radioactive">Radioactive Waste</option>
                                            <option value="Non-hazardous">Non-hazardous Waste</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" placeholder="Description for thw Wastage" id="description" style="height: 100px;"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quanity" class="form-label">Quanity in Kg</label>
                                        <input type="number" id="quanity" class="form-control" placeholder="Enter the Wastage Quanity in Kg">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button onclick="riseTicket()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Rise Ticket</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>


                    <div style="padding:20px" class="card">
                        <table class="table table-centered table-striped mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S.No</th>
                                    <th>Wastage Type</th>
                                    <th>Quanity (in Kg)</th>
                                    <th>Slot & Timing</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="wastageOutBody">

                                <tr>
                                    <th colspan="5">Loading</th>
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
                                        <i class="dripicons-wrong h1"></i>
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


            function riseTicket() {
                var type = $('#type').val()
                var description = $('#description').val()
                var quanity = $('#quanity').val()

                $.ajax({
                    url: '../../api/wastageOut/riseTicket.php',
                    method: 'post',
                    data: {
                        type,
                        description,
                        quanity
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        toast(result.message, result.success)
                        getWastage()
                    },
                    error: function(result) {
                        console.log(result)
                        getWastage()
                    }
                })
            }



            function getWastage() {
                $.ajax({
                    url: '../../api/wastageOut/getAll.php',
                    method: 'post',
                    dataType: 'json',
                    success: function(result) {
                        $('#wastageOutBody').empty()
                        if (result.success) {
                            let data = result.data;
                            let i = 1;

                            data.forEach(element => {
                                let status = '';
                                let slot = '';

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

                                if (element.date != null || element.time != null) {
                                    slot = `${element.date}(${element.time})`
                                } else {
                                    slot = '-';
                                }

                                $('#wastageOutBody').append(`
                                    <tr>
                                        <th>${i}</th>
                                        <td>${element.type}</td>
                                        <td>${element.quanity_kg} Kg</td>
                                        <td>${slot}</td>
                                        <td>${status}</td>
                                    </tr>
                                `)

                                i++
                            });
                        } else {
                            $('#wastageOutBody').append(`
                                    <tr>
                                        <th colspan="5">${result.message}</th>
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
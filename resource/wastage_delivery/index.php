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
                                <h4 class="page-title">Wastage Slot Timing</h4>
                            </div>
                        </div>
                    </div>

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
                                        <input type="text" id="type" class="form-control" placeholder="Enter the Wastage Type">
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

                    <div id="slot-book" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="standard-modalLabel">Book Slot</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Hosptial</label>
                                        <input type="text" id="name" class="form-control" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" id="city" class="form-control" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="delivery" class="form-label">Quanity in Kg</label>
                                        <select name="delivery" id="delivery" class="form-control">
                                            <?php
                                            $sql = "select * from master_delivery";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value = '$row[user_id]' >$row[name]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" id="date" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="time" class="form-label">Time</label>
                                        <input type="time" id="time" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button onclick="bookSlot()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Rise Ticket</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                    <div style="padding:20px" class="card">
                        <table class="table table-centered table-striped mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S.No</th>
                                    <th>Hospital</th>
                                    <th>City</th>
                                    <th>Wastage Type</th>
                                    <th>Quanity (in Kg)</th>
                                    <th>Slot</th>
                                    <th style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="wastageInBody">

                                <tr>
                                    <th colspan="7  ">Loading</th>
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
            let Wid = 0;

            function toast(message, isSuccess) {
                if (isSuccess) {
                    $('#successMsg').text(message)
                    $('#success-alert').modal('show')
                } else {
                    $('#dangerMsg').text(message)
                    $('#danger-alert').modal('show')
                }
            }


            function pickup(id) {

                $.ajax({
                    url: '../../api/wastageDelivery/delivery.php',
                    method: 'post',
                    data: {
                        id,
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
                    url: '../../api/wastageDelivery/getAll.php',
                    method: 'post',
                    dataType: 'json',
                    success: function(result) {
                        $('#wastageInBody').empty()
                        if (result.success) {
                            let data = result.data;
                            let i = 1;

                            data.forEach(element => {
                                let slot = '';
                                let button = `
                                    <button type="button" onClick="pickup(${element.id})" class="btn btn-primary btn-rounded btn-sm" >Picked Up</button>
                                    `;


                                if (element.date != null || element.time != null) {
                                    slot = `${element.date}(${element.time})`
                                } else {
                                    slot = '-';
                                }

                                $('#wastageInBody').append(`
                                    <tr>
                                        <th>${i}</th>
                                        <td>${element.name}</td>
                                        <td>${element.city}</td>
                                        <td>${element.type}</td>
                                        <td>${element.quanity_kg} Kg</td>
                                        <td>${slot}</td>
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
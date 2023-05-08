<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/fonts/flaticon.css">

    <link rel="stylesheet" href="assets/css/nice-select.min.css">

    <link rel="stylesheet" href="assets/css/boxicons.min.css">

    <link rel="stylesheet" href="assets/css/meanmenu.css">

    <link rel="stylesheet" type="text/css" href="assets/css/settings.css">
    <link rel="stylesheet" type="text/css" href="assets/css/layers.css">
    <link rel="stylesheet" type="text/css" href="assets/css/navigation.css">

    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="assets/css/modal-video.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- Custom fonts for this template-->
    <link href="assets/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                <img class="rounded-pill img-fluid" width="65" src="assets/images/user.jpg" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                    <span>Setting</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                    <span>Logout</span></a>
            </li>

            <!-- <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li> -->
            <!-- Divider -->




        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="container-fluid mx-2">
                            <div class="content rounded-3 p-3">
                                <h1 class="fs-3">Product Details</h1>
                                <p class="mb-0">Hello Jone Doe, welcome to your awesome dashboard!</p>
                            </div>
                            <!-- <div class="call">
                              
                                <a href="index.php">
                                <img src="assets/images/logo.png" alt="Logo">
                           
                              Home</a>
                            </div> -->
                        </div>
                    </form>


                </nav>
                <div class="user-area ptb-100">
                    <div class="container-fluid">
                        <div class="user-item">
                            <form>
                                <h2>Product Details</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Product Name*</label>
                                            <input type="text" class="form-control" placeholder="Product Name:">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Product Image</label>
                                        <input type="file" class="custom-file-input" id="" aria-describedby="">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Product Price*</label>
                                            <input type="number" class="form-control" placeholder="Product Price:">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Discount</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>10%</option>
                                                <option>18%</option>
                                                <option>30%</option>
                                                <option>50%</option>
                                                <option>100%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Description" id=""
                                                style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Description</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">specialisation</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>xyz</option>
                                                <option>abc</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Add color your product</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>red</option>
                                                <option>green</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Categories</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>A</option>
                                                <option>B</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Add color your product</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>red</option>
                                                <option>green</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">width*</label>
                                            <input type="number" class="form-control" placeholder="width:">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">height*</label>
                                            <input type="number" class="form-control" placeholder="height:">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Brand</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>A</option>
                                                <option>B</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Country</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>India</option>
                                                <option>nepal</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">

                                        <label for="exampleInputEmail1" class="form-label">Image1</label>
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01">
                                    </div>
                                    <div class="col-md-4">

                                        <label for="exampleInputEmail1" class="form-label">Image1</label>
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01">
                                    </div>
                                    <div class="col-md-4">

                                        <label for="exampleInputEmail1" class="form-label">Image1</label>
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                            aria-describedby="inputGroupFileAddon01">
                                    </div>


                                    <button type="submit" class="btn common-btn mt-3">
                                        Submit
                                        <img src="assets/images/shape1.png" alt="Shape">
                                        <img src="assets/images/shape2.png" alt="Shape">
                                    </button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>



        </div>


    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>

    <script src="assets/js/dashboard.js"></script>
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/form-validator.min.js"></script>

    <script src="assets/js/contact-form-script.js"></script>

    <script src="assets/js/jquery.ajaxchimp.min.js"></script>

    <script src="assets/js/jquery.nice-select.min.js"></script>

    <script src="assets/js/jquery.meanmenu.js"></script>

    <script src="assets/js/jquery.themepunch.tools.min.js"></script>
    <script src="assets/js/jquery.themepunch.revolution.min.js"></script>

    <script src="assets/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="assets/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="assets/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="assets/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="assets/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="assets/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="assets/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="assets/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="assets/js/extensions/revolution.extension.video.min.js"></script>

    <script src="assets/js/jquery.mixitup.min.js"></script>

    <script src="assets/js/owl.carousel.min.js"></script>

    <script src="assets/js/jquery-modal-video.min.js"></script>

    <script src="assets/js/thumb-slide.js"></script>

    <script src="assets/js/custom.js"></script>


</body>

</html>
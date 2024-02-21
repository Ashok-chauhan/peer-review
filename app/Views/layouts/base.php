<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= $this->renderSection("title"); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png">

    <!-- jquery.vectormap css -->
    <link href="<?= base_url(); ?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="<?= base_url(); ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url(); ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url(); ?>assets/css/spinner.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-webcomponent@2/dist/tinymce-webcomponent.min.js"></script>
    <script src="<?= base_url(); ?>js/tinymce/tinymce.min.js"></script>
</head>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <?php if (session()->get('role') == 1) : ?>
                            <a href="<?= base_url(); ?>admin" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-dark">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 2) : ?>
                            <a href="<?= base_url(); ?>editor" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-dark">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 3) : ?>
                            <a href="<?= base_url(); ?>author/profile" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-dark">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 4) : ?>
                            <a href="<?= base_url(); ?>peer" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-dark">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 5) : ?>
                            <a href="<?= base_url(); ?>translator" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-dark">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 6) : ?>
                            <a href="<?= base_url(); ?>reader" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-dark">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 7) : ?>
                            <a href="<?= base_url(); ?>editcopy" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-dark">
                                </span>
                            </a>
                        <?php endif; ?>
                        <?php if (session()->get('role') == 1) : ?>

                            <a href="<?= base_url(); ?>admin" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm-light" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-light">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 2) : ?>
                            <a href="<?= base_url(); ?>editor" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm-light" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-light">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 3) : ?>
                            <a href="<?= base_url(); ?>author/profile" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm-light" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-light">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 4) : ?>
                            <a href="<?= base_url(); ?>peer" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm-light" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-light">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 5) : ?>
                            <a href="<?= base_url(); ?>translator" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm-light" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-light">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 6) : ?>
                            <a href="<?= base_url(); ?>reader" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm-light" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-light">
                                </span>
                            </a>
                        <?php elseif (session()->get('role') == 7) : ?>
                            <a href="<?= base_url(); ?>editcopy" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-sm-light" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>assets/images/Scripture-logo.png" alt="logo-light">
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="ri-menu-2-line align-middle"></i>
                    </button>


                </div>

                <div class="d-flex">

                    <!-- <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-search-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="mb-3 m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-notification-3-line"></i>
                            <span class="noti-dot"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small"> View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="ri-shopping-cart-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-1">Your order is placed</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">If several languages coalesce the grammar</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <img src="<?= base_url(); ?>assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="mb-1">James Lemire</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">It will seem like simplified English.</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-success rounded-circle font-size-16">
                                                <i class="ri-checkbox-circle-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-1">Your item is shipped</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">If several languages coalesce the grammar</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <img src="<?= base_url(); ?>assets/images/users/avatar-4.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="mb-1">Salena Layfield</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 border-top">
                                <div class="d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block user-dropdown">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?= base_url(); ?>assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1"><?= session()->get('username') . ' ' . session()->get('middle_name') . ' ' . session()->get('last_name'); ?></span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?= base_url(); ?>author/logout"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                        </div>
                    </div>



                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!-- User details -->
                <div class="user-profile text-center mt-3">
                    <div class="">
                        <img src="<?= base_url(); ?>assets/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
                    </div>
                    <div class="mt-3">
                        <h4 class="font-size-16 mb-1" style="color: #ffffff;"><?= session()->get('username') . ' ' . session()->get('middle_name') . ' ' . session()->get('last_name'); ?></h4>
                        <span class="text-muted1"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
                    </div>
                </div>

            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->

                    <!-- end page title -->
                    <br>
                    <!-- content block -->
                    <?= $this->renderSection("content"); ?>
                    <!-- end row -->
                </div>

            </div>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/node-waves/waves.min.js"></script>


    <!-- apexcharts -->
    <!-- <script src="<?= base_url(); ?>assets/libs/apexcharts/apexcharts.min.js"></script> -->

    <!-- jquery.vectormap map -->
    <script src="<?= base_url(); ?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

    <!-- Required datatable js -->
    <script src="<?= base_url(); ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="<?= base_url(); ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="<?= base_url(); ?>assets/js/app.js"></script>
    <?= $this->renderSection("javascript"); ?>
</body>

</html>
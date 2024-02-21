<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>SCRIPTURE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png">

    <!-- Bootstrap Css -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url(); ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">

                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="#" class="auth-logo">
                                <img src="<?= base_url(); ?>assets/images/logo.png" class="logo-dark mx-auto" alt="">
                                <img src="<?= base_url(); ?>assets/images/logo.png" class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>

                    <h4 class="text-muted text-center font-size-18"><b>RESET PASSWORD</b></h4>


                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger"><?= $validation->listErrors(); ?></div>
                    <?php endif; ?>
                    <?php if (session()->getTempdata('error')) : ?>
                        <div class="alert alert-danger"><?= session()->getTempdata('error'); ?></div>
                    <?php endif; ?>

                    <div class="p-3">
                        <!-- <form class="form-horizontal mt-3" action="#"> -->
                        <?= form_open() ?>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="email" value="<?= set_value('email'); ?>" id="email" class="form-control" placeholder="Email address" type="email" required>
                            </div>
                        </div>



                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Submit</button>
                            </div>
                        </div>

                        <div class="form-group mb-0 row mt-2">
                            <div class="col-sm-5 mt-3">
                                <a href="<?= base_url(); ?>registration" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                    <!-- end -->
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>
    <!-- end -->


</body>

</html>
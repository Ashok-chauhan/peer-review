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
                            <a href="thank-you.html" class="auth-logo">
                                <img src="<?= base_url(); ?>assets/images/logo.png" class="logo-dark mx-auto" alt="">
                                <img src="<?= base_url(); ?>assets/images/logo.png" class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>

                    <br>
                    <!-- <h4 class="text-muted text-center font-size-40" style=" font-family: Courgette, cursive"><b><i>Thank You</i></b></h4> -->
                    <?php if (isset($error)) : ?>
                        <h4 class="text-muted text-center font-size-47 alert alert-danger"><b>Error!</b></h4>
                        <h4 class="text-muted text-left font-size-14" style="margin-top: 17px;"><?= $error; ?></h4>
                        <h4 class="text-muted text-left font-size-14" style="margin-top: 17px;"><b>TEAM SCRIPTURE</b></h4>
                    <?php endif; ?>

                    <?php if (isset($success)) : ?>
                        <h4 class="text-muted text-center font-size-47"><b>Success!</b></h4>
                        <h4 class="text-muted text-left font-size-14" style="margin-top: 17px;"><?= $success; ?></h4>
                        <h4 class="text-muted text-left font-size-14" style="margin-top: 17px;"><b>TEAM SCRIPTURE</b></h4>
                    <?php endif; ?>
                    <div class="p-3">
                        <form class="form-horizontal mt-3" action="<?= base_url(); ?>">

                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Cilck Here To Login</button>
                                </div>
                            </div>


                        </form>
                        <!-- end form -->
                    </div>
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
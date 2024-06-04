<?php $page_session = \Config\Services::session(); ?>
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
    <link href="<?= base_url(); ?>assets/css/registration.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/css/tag.css" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">

                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="register.html" class="auth-logo">
                                <img src="assets/images/logo.png" class="logo-dark mx-auto" alt="">
                                <img src="assets/images/logo.png" class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>

                    <h4 class="text-muted text-center font-size-18"><b>REGISTER</b></h4>

                    <?php if ($page_session->getTempdata("success")): ?>
                        <div class="alert alert-success"><?= $page_session->getTempdata("success"); ?></div>
                    <?php endif; ?>

                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger"><?= $validation->listErrors(); ?></div>
                    <?php endif; ?>
                    <div id="error"></div>
                    <div class="p-3">
                        <!-- <form class="form-horizontal mt-3" action="#"> -->
                        <?php $attributes = ['class' => 'form-horizontal mt-3', 'id' => 'registration']; ?>
                        <?= form_open('', $attributes) ?>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <!--  <input class="form-control" type="text" required="" placeholder="Title"> -->
                                <select class="form-select" name="title">
                                    <option selected>Dr.</option>
                                    <option selected>Prof.</option>
                                    <option selected>Mr.</option>
                                    <option selected>Ms.</option>
                                    <option selected>Mrs.</option>
                                    <option selected>Title</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <!-- <input class="form-control" type="text" required="" placeholder="First name"> -->
                                <input name="username" value="<?= set_value('username'); ?>" id="username"
                                    class="form-control" placeholder="First name" type="text">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">

                                <input name="middle_name" value="<?= set_value('middle_name'); ?>" id="middle_name"
                                    class="form-control" placeholder="Middle name" type="text">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="last_name" value="<?= set_value('last_name'); ?>" id="last_name"
                                    class="form-control" placeholder="Last name" type="text" required>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <!-- <input class="form-control" type="email" required="" placeholder="Email"> -->
                                <input name="email" value="<?= set_value('email'); ?>" id="email" class="form-control"
                                    placeholder="Email address" type="email">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <!-- <input class="form-control" type="text" required="" placeholder="Phone number"> -->
                                <input name="phone" value="<?= set_value('phone'); ?>" id="phone" class="form-control"
                                    placeholder="Phone number" type="text">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="country" value="<?= set_value('country'); ?>" id="country"
                                    class="form-control" placeholder="Country" type="text">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="password" value="<?= set_value('password'); ?>" id="password"
                                    class="form-control" placeholder="Create password" type="password">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="cpass" value="<?= set_value('cpass'); ?>" id="cpass" class="form-control"
                                    placeholder="Repeat password" type="password">
                                <input type="hidden" id="roleID" name="roleID" value="3">
                            </div>
                        </div>

                        <!--  <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="form-label ms-1 fw-normal" for="customCheck1" style="color: #000000">I accept <a href="#" class="text-muted">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                </div> -->
                        <h6 class="alert-warning">You have to select appropriate role to register</h6>
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="data_consent">
                                        <input type="checkbox" class="custom-control-input" id="author" name="roles[]"
                                            value="3"><a href="#" class="text-muted ms-6 ">
                                            Author</a></label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="notification">
                                        <input type="checkbox" class="custom-control-input" id="reviewer" name="roles[]"
                                            value="4"> <a href="#" class="text-muted  ms-6 ">
                                            Reviewer</a></label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="notification">
                                        <input type="checkbox" class="custom-control-input" id="copy-editor"
                                            name="roles[]" value="5"> <a href="#" class="text-muted  ms-6 ">
                                            Copy-editor</a></label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="notification">
                                        <input type="checkbox" class="custom-control-input" id="translator"
                                            name="roles[]" value="6"> <a href="#" class="text-muted  ms-6 ">
                                            Translator</a></label>
                                </div>


                            </div>

                        </div>



                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="data_consent">
                                        <input type="checkbox" class="custom-control-input" id="data_consent"
                                            name="data_consent" required><a href="#" class="text-muted ms-6 ">Yes, I
                                            agree to have my data collected and stored according to the Policy
                                            Statement.</a></label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="notification">
                                        <input type="checkbox" class="custom-control-input" id="notification"
                                            name="notification"> <a href="#" class="text-muted  ms-6 ">Yes, I would like
                                            to be notified of new publications and announcements.</a></label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="contact">
                                        <input type="checkbox" class="custom-control-input" id="contact"
                                            name="contact"><a href="#" class="text-muted  ms-6">Yes, I would like to be
                                            contacted with requests to review submissions to this journal.</a></label>
                                </div>

                            </div>

                        </div>


                        <div class="tag-area" id="review-interests">
                            <label for="tag-input" class="label">Review Interests</label>
                            <ul>
                                <input type="text" class="tag-input" id="tag-input" name="interests" />
                            </ul>
                        </div>

                        <div class="form-group text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light"
                                    type="submit">Register</button>
                            </div>
                        </div>


                        <div class="form-group mt-2 mb-0 row">
                            <div class="col-12 mt-3 text-center">
                                <a href="<?= base_url(); ?>" class="text-muted">Already have account?</a>
                            </div>
                        </div>
                        <!-- </form> -->
                        <?= form_close() ?>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>


    <script type="text/javascript" src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/libs/node-waves/waves.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>js/registration.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>js/tag.js"></script>
</body>

</html>
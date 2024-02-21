<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<div class="container-fluid">

    <!-- end page title -->

    <div class="row" style="text-align:center">
        <div class="col-lg-12">
            <div class="card">

                <div id="basic-pills-wizard" class="twitter-bs-wizard text-center">
                    <div class="twitter-bs-wizard-tab-content">
                        <div class="tab-pane" id="seller-details">
                            <form>
                                <div class="page-title-box">
                                    <br>
                                    <h4 class="text-muted text-center font-size-38" style="text-transform: capitalize;"><b>Congratulations! </b></h4>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="card-title font-size-22" style="margin-top:-13px">Your submission has reached us!</h4>
                                        <h4 class="card-title font-size-13">You must read and acknowledge that you've completed the requirements below before proceeding.</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="card-title font-size-20 fake-legend"><span><button type="submit" class="btn btn-primary1 waves-effect waves-light me-1">What Happens Next?</button></span> </h4>
                                    </div>

                                    <div class="col-1"> </div>
                                    <div class="col-10">
                                        <h4 class="card-title font-size-13">The journal has been notified of your submission, and you’ve been emailed a confirmation for your records. Once the editor has reviewed the submission, they will contact you. </h4>
                                    </div>
                                    <div class="col-1"> </div>
                                </div>

                                <br> <br>
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <a href="<?= base_url(); ?>author/viewsubmission">
                                            <div class="card">
                                                <div class="card-body1">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <span class="text-primary rounded-3">
                                                                <img src="<?= base_url(); ?>assets/images/icon/icon-4.png">
                                                            </span>
                                                            <h4 class="mb-2 mt-6 font-size-15"><b>Review this Submission</b></h4>

                                                        </div>

                                                    </div>
                                                </div><!-- end cardbody -->
                                            </div><!-- end card -->
                                        </a>
                                    </div><!-- end col -->
                                    <div class="col-xl-4 col-md-6">
                                        <a href="<?= base_url(); ?>author/submission">
                                            <div class="card">
                                                <div class="card-body1">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">

                                                            <span class="text-primary rounded-3">
                                                                <img src="<?= base_url(); ?>assets/images/icon/icon-5.png">
                                                            </span>
                                                            <h4 class="mb-2 mt-6 font-size-15"><b>Creat a New Submission</b></h4>

                                                        </div>


                                                    </div>
                                                </div><!-- end cardbody -->
                                            </div><!-- end card -->
                                        </a>
                                    </div><!-- end col -->
                                    <div class="col-xl-4 col-md-6">
                                        <a href="<?= base_url(); ?>author/profile">
                                            <div class="card">
                                                <div class="card-body1">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <span class="text-primary rounded-3">
                                                                <img src="<?= base_url(); ?>assets/images/icon/icon-6.png">
                                                            </span>
                                                            <h4 class="mb-2 mt-6 font-size-15"><b>Return to your Dashboard</b></h4>

                                                        </div>

                                                    </div>
                                                </div><!-- end cardbody -->
                                            </div><!-- end card -->
                                        </a>
                                    </div><!-- end col -->

                                </div>


                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- end page title -->


<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/submission.js"></script>

<?= $this->endSection(); ?>

<?= $this->endSection(); ?>
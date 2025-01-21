<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add User</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">New Users Register Here</h4>
                    <form class="needs-validation" action="../admin/registration" method="POST" novalidate="">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <select class="form-select" name="title">
                                        <option selected="" disabled="" value="">-- Select Title --</option>
                                        <option>Dr.</option>
                                        <option>Prof.</option>
                                        <option>Mr.</option>
                                        <option>Ms.</option>
                                        <option>Mrs.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <!-- <label for="validationCustom01" class="form-label">First
                                                                name</label> -->
                                    <input type="text" class="form-control" id="username" placeholder="Enter First name"
                                        required name="username">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <!-- <label for="validationCustom02" class="form-label">Middle
                                                                name</label> -->
                                    <input type="text" class="form-control" id="middle_name"
                                        placeholder="Enter Middle name" name="middle_name" required="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <!-- <label for="validationCustom02" class="form-label">Last
                                                                name</label> -->
                                    <input type="text" class="form-control" id="last_name" placeholder="Enter Last name"
                                        required="" name="last_name">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <!-- <label for="validationCustom04"
                                                                class="form-label">Email address</label> -->
                                    <input type="email" class="form-control" id="email" placeholder="email@.com"
                                        required="" name="email">
                                    <div class="invalid-feedback">
                                        Please Enter valid Email id.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <!-- <label for="validationCustom04"
                                                                class="form-label">Phone number
                                                            </label> -->
                                    <input type="number" class="form-control" id="phone" placeholder="+91 0000000000"
                                        required="" name="phone">
                                    <div class="invalid-feedback">
                                        Please enter valid Phone no.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <!-- <label for="validationCustom04"
                                                                class="form-label">Country
                                                            </label> -->
                                    <input type="text" class="form-control" id="country"
                                        placeholder="Enter Your Country" required="" name="country">
                                    <div class="invalid-feedback">
                                        Please enter valid Phone no.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <!-- <label for="validationCustom05"
                                                                class="form-label">Create Password</label> -->
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Create Your Password" required="" name="password">
                                    <div class="invalid-feedback">
                                        Create password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <!-- <label for="validationCustom05"
                                                                class="form-label">Repeat Password</label> -->
                                    <input type="text" class="form-control" id="cpass" placeholder="Repeat Your Pssword"
                                        required="" name="cpass">
                                    <div class="invalid-feedback">
                                        Please Enetr Repeat password.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="card-title">You Have To Select Appropriate Role To
                                Register</h4>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" id="checkbox1" name="roles[]" class="form-check-input"
                                        value="1">
                                    <label class="form-check-label" for="checkbox1">Admin</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" id="checkbox2" name="roles[]" class="form-check-input"
                                        value="2">
                                    <label class="form-check-label" for="checkbox2">Editor</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" id="checkbox3" name="roles[]" class="form-check-input"
                                        value="3">
                                    <label class="form-check-label" for="checkbox3">Author</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" id="reviewer" name="roles[]" class="form-check-input"
                                        value="4">
                                    <label class="form-check-label" for="checkbox4">Reviewer</label>
                                </div>
                            </div>

                            <!-- journal -->
                            <div class="form-group mb-3 row" id="review-interests">
                                <div class="col-12">
                                    <?php if ($journals): ?>
                                        <label for="intrest" class="">Review Interests/Journal</label>
                                        <select class="js-example-basic-multiple" style="width:100%;" name="interests[]"
                                            multiple="multiple">

                                            <?php foreach ($journals as $value): ?>
                                                <option value="<?= $value->id; ?>"><?= $value->journal_name; ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <!-- journal -->


                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" id="checkbox5" name="roles[]" class="form-check-input"
                                        value="5">
                                    <label class="form-check-label" for="checkbox5">Copy-editor</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" id="checkbox6" name="roles[]" class="form-check-input"
                                        value="6">
                                    <label class="form-check-label" for="checkbox6">Production</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" id="checkbox7" name="roles[]" class="form-check-input"
                                        value="7">
                                    <label class="form-check-label" for="checkbox7">Translator</label>
                                </div>
                            </div>

                        </div>

                        <div>
                            <button class="btn btn-primary" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>

<?= $this->section('javascript'); ?>
<link href="<?= base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="<?= base_url(); ?>js/admin.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/registration.js"></script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
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
                <h4 class="mb-sm-0">Edit User Informations</h4>
                <div class="page-title-right">
                    <a href="../" class="btn btn-success waves-effect waves-light">
                        <i class="fa fa-user align-middle me-2"></i> User Management
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <?php
    $role = [
        '1' => 'Admin',
        '2' => 'Editor',
        '3' => 'Author',
        '4' => 'Reviewr',
        '5' => 'Copy-editor',
        '6' => 'Production',
        '7' => 'Translator',
        '8' => 'Reader',
    ];
    $status = [
        'active' => 'Active',
        'inactive' => 'Inactive',

    ];
    $options = [
        'Dr.' => 'Dr.',
        'Prof.' => 'Prof.',
        'Mr.' => 'Mr.',
        'Ms.' => 'Ms.',
        'Mrs.' => 'Mrs.',
    ];
    $att = [
        'class' => 'form-select',
    ];
    ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Users Register Here</h4>

                    <form class="needs-validation" action="../useredit" method="POST">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">Title</label>
                                    <?php echo form_dropdown('title', $options, '<?php=$user->title;?>', $att); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">First
                                        name</label>
                                    <input type="text" class="form-control" value="<?= $user->username; ?>"
                                        id="username" name="username" placeholder="Enter First name" required>
                                    <input type="hidden" name="userid" value="<?= $user->userID; ?>" />
                                    <input type="hidden" name="roleID" value="<?= $user->roleID; ?>" />

                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Middle
                                        name</label>
                                    <input type="text" class="form-control" value="<?= $user->middle_name; ?>"
                                        id="middle_name" name="middle_name" placeholder="Enter Middle name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Last
                                        name</label>
                                    <input type="text" class="form-control" value="<?= $user->last_name; ?>"
                                        id="last_name" name="last_name" placeholder="Enter Last name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Email address</label>
                                    <input type="email" class="form-control" value="<?= $user->email; ?>" id="email"
                                        name="email" placeholder="email@.com" required="">
                                    <div class="invalid-feedback">
                                        Please Enter valid Email id.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Phone number
                                    </label>
                                    <input type="number" class="form-control" value="<?= $user->phone; ?>" id="phone"
                                        name="phone" placeholder="+91 0000000000" required>
                                    <div class="invalid-feedback">
                                        Please enter valid Phone no.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Country
                                    </label>
                                    <input type="text" class="form-control" value="<?= $user->country; ?>" id="country"
                                        name="country" placeholder="Enter Your Country" required>
                                    <div class="invalid-feedback">
                                        Please enter valid Phone no.
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <?php if ($user->status == 'active'): ?>
                                        <input type="checkbox" id="checkbox1" name="status" class="form-check-input"
                                            value="<?= $user->status; ?>" checked>
                                        <h4 class="card-title"> User status</h4>
                                    <?php else: ?>
                                        <input type="checkbox" id="checkbox1" name="status" class="form-check-input"
                                            value="<?= $user->status; ?>">
                                        <h4 class="card-title"> User status</h4>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="card-title">You Have To Select Appropriate Role To
                                Register
                            </h4>


                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <?php if (in_array('1', $roles)): ?>
                                        <input type="checkbox" id="checkbox1" name="roles[]" class="form-check-input"
                                            value="1" checked="">
                                    <?php else: ?>
                                        <input type="checkbox" id="checkbox1" name="roles[]" class="form-check-input"
                                            value="1">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="checkbox1">Admin</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <?php if (in_array('2', $roles)): ?>
                                        <input type="checkbox" id="checkbox2" name="roles[]" class="form-check-input"
                                            value="2" checked>
                                    <?php else: ?>
                                        <input type="checkbox" id="checkbox2" name="roles[]" class="form-check-input"
                                            value="2">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="checkbox2">Editor</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <?php if (in_array('3', $roles)): ?>
                                        <input type="checkbox" id="checkbox3" name="roles[]" class="form-check-input"
                                            value="3" checked>
                                    <?php else: ?>
                                        <input type="checkbox" id="checkbox3" name="roles[]" class="form-check-input"
                                            value="3">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="checkbox3">Author</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <?php if (in_array('4', $roles)): ?>
                                        <input type="checkbox" id="checkbox4" name="roles[]" class="form-check-input"
                                            value="4" checked>
                                    <?php else: ?>
                                        <input type="checkbox" id="checkbox4" name="roles[]" class="form-check-input"
                                            value="4">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="checkbox4">Reviewer</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <?php if (in_array('5', $roles)): ?>
                                        <input type="checkbox" id="checkbox5" name="roles[]" class="form-check-input"
                                            value="5" checked>
                                    <?php else: ?>
                                        <input type="checkbox" id="checkbox5" name="roles[]" class="form-check-input"
                                            value="5">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="checkbox5">Copy-editor</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <?php if (in_array('6', $roles)): ?>
                                        <input type="checkbox" id="checkbox6" name="roles[]" class="form-check-input"
                                            value="6" checked>
                                    <?php else: ?>
                                        <input type="checkbox" id="checkbox6" name="roles[]" class="form-check-input"
                                            value="6">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="checkbox6">Production</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <?php if (in_array('7', $roles)): ?>
                                        <input type="checkbox" id="checkbox7" name="roles[]" class="form-check-input"
                                            value="7" checked>
                                    <?php else: ?>
                                        <input type="checkbox" id="checkbox7" name="roles[]" class="form-check-input"
                                            value="7">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="checkbox7">Translator</label>
                                </div>
                            </div>


                        </div>

                        <div>
                            <button class="btn btn-primary" type="submit">Update Now</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!--container-->


<?= $this->section('javascript'); ?>
<link href="<?= base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?= base_url(); ?>js/admin.js"></script>

<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
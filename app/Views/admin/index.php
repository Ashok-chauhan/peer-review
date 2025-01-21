<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>


<div class="container">
    <!-- design bof  -->
    <div class="container-fluid">
        <br>
        <!-- content block -->
        <div class="container">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('warning')): ?>
                <div class="alert alert-warning">
                    <?= session()->getFlashdata('warning') ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="list-group col-12">
                    <div class="row mb-2">
                        <div class="col-sm-9">
                            <h4>User Management</h4>
                        </div>
                        <div class="col-sm-3 text-end userbtn">
                            <a href="../admin/registration" class="btn btn-success waves-effect waves-light">
                                <i class="fa fa-user align-middle me-2"></i> Add User
                            </a>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" width="30%">Name</th>
                                <th scope="col" width="10%">Email</th>
                                <th scope="col" width="5%">Role</th>
                                <th scope="col" width="10%">Status</th>
                                <th scope="col" width="3%">Edit</th>
                                <!-- <th scope="col">Username</th> -->
                            </tr>
                        </thead>
                        <?php if ($users): ?>
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
                            ?>
                            <?php if ($users): ?>
                                <tbody>
                                    <?php foreach ($users as $key => $user): ?>

                                        <form id="<?= $user->userID; ?>" method="POST" action="admin">
                                            <tr>
                                                <td><?= $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->last_name; ?>
                                                </td>
                                                <td><?= $user->email; ?></td>
                                                <input type="hidden" name="userid" value="<?= $user->userID; ?>">
                                                <td>
                                                    <div class="row role">
                                                        <div class="col-sm-12">
                                                            <?php
                                                            foreach ($role as $k => $rol): ?>
                                                                <?php if (in_array($k, (array) $user->userRoles)): ?>
                                                                    <div class="form-check mb-2">
                                                                        <label class="form-check-label"
                                                                            id="checkbox<?= $k; ?>"><?= $rol; ?></label>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <?php if ($user->status == 'active'): ?>
                                                            <div class="alert alert-success" role="alert">
                                                                <?= $user->status; ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="alert alert-danger" role="alert">
                                                                <?= $user->status; ?>
                                                                </di>
                                                            <?php endif; ?>
                                                        </div>
                                                </td>
                                                <td>
                                                    <a href="admin/useredit/<?= $user->userID; ?>"
                                                        class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </form>

                                    <?php endforeach; ?>

                                </tbody>
                            <?php endif; ?>
                        </table>
                    </div>
                </div> <!-- row -->
            </div> <!--container-->


            <!-- end row -->
        </div>
        <!-- design eof  -->


    <?php endif; ?>

    <!-- right col bof -->
    <!-- <div class="col-4">
        <h4>Submissions</h4>
        <?php //if ($submissions): ?>
        <table class="table table-striped">
            <tbody>
                <?php //foreach ($submissions as $submission): ?>
                <tr>
                    <td class="fw-bold">
                        <?//=$submission->title; ?>
                    </td>
                </tr>
                <?php //endforeach; ?>
            </tbody>
        </table>

        <?php // endif; ?>
    </div> -->
    <!-- right col eof -->



</div> <!-- row -->
</div> <!--container-->


<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/admin.js"></script>
<link href="<?= base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />

<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
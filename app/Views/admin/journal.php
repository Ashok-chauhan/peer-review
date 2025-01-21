<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<div class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="list-group col-12">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h4>Manage Journal</h4>
                </div>
                <div class="col-sm-3 text-end userbtn">
                    <a href="../admin/addJournal" class="btn btn-success waves-effect waves-light">
                        <i class="fa fa-user align-middle me-2"></i> Add Journal&nbsp;
                    </a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="30%">Journal&nbsp;Name</th>
                        <th scope="col" width="10%">Journal&nbsp;Logo</th>
                        <th scope="col" width="10%">Status</th>
                        <th scope="col" width="3%">Edit</th>
                        <!-- <th scope="col">Username</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php if ($journals): ?>
                        <?php foreach ($journals as $journal): ?>
                            <tr>
                                <td>

                                    <a href="../admin/journalDetails/<?= $journal->id; ?>">
                                        <?= $journal->journal_name; ?>
                                    </a>
                                </td>
                                <td>

                                    <?php if ($journal->icon): ?>
                                        <img class="rounded img-thumbnail"
                                            src="<?= base_url() . 'assets/images/icon/' . $journal->icon; ?>" alt="">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="">
                                        <?php if ($journal->status): ?>
                                            <div class="alert alert-success" role="alert">
                                                Active
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-danger" role="alert">
                                                Inactive
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <a href="../admin/editJournal/<?= $journal->id; ?>"
                                        class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>


                </tbody>
            </table>
        </div>
    </div> <!-- row -->
</div> <!-- container -->


<?= $this->section('javascript'); ?>
<link href="<?= base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?= base_url(); ?>js/admin.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
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
                <h4 class="mb-sm-0">Edit Journal</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <form action="../editJournal" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Journal
                                        Name</label>
                                    <input type="text" class="form-control" id="journal_name"
                                        placeholder="Enter Journal Name" required="" name="journal_name"
                                        value="<?= $journal->journal_name; ?>">
                                    <input type="hidden" name="jid" value="<?= $journal->id; ?>">

                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-2">
                                <div class="form-check mb-2">
                                    <?php if ($journal->status == 1): ?>
                                        <input type="checkbox" id="checkbox1" name="status" class="form-check-input"
                                            value="<?= $journal->status; ?>" checked>
                                        <h4 class="card-title"> Journal status</h4>
                                    <?php else: ?>
                                        <input type="checkbox" id="checkbox1" name="status" class="form-check-input"
                                            value="1">
                                        <h4 class="card-title"> Journal status</h4>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="mb-3">
                                <?php if ($journal->icon): ?>
                                    <img class="rounded img-thumbnail" width="200"
                                        src="<?= base_url() . 'assets/images/icon/' . $journal->icon; ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Add logo</label>
                                <input class="form-control" type="file" id="icon" name="icon">
                            </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update
                            Journal</button>
                    </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- Container -->


<?= $this->section('javascript'); ?>
<link href="<?= base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?= base_url(); ?>js/admin.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
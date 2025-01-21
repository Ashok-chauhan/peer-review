<?php $page_session = \Config\Services::session(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Peer Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<div class="container">
    <?php if ($page_session->getTempdata("success")): ?>
        <div class="alert alert-success"><?= $page_session->getTempdata("success"); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata("error")): ?>
        <div class="alert alert-danger"><?= $page_session->getTempdata("error"); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="list-group col-8 p-2 mx-auto">
                        <h2 class="text-center">Upload files</h2>

                        <!-- <form method="POST" action="../../detailview"> -->
                        <form method="POST" action="../../updateReview" enctype="multipart/form-data">
                            <div class="d-grid gap-2 col-6 mx-auto">

                                <input type="hidden" name="reviewID" value="<?= $peer_id ?>" />
                                <input type="hidden" name="submissionid" value="<?= $submission_id ?>" />
                                <input type="hidden" value="3" name="status">


                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Article file*</label>
                                    <input class="form-control" type="file" id="article_file" name="article_file">
                                </div>
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-info" type="submit">Submit</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/peer.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
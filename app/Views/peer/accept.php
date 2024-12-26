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
                    <div class="list-group col-6 p-2 mx-auto">
                        <h2>Review request</h2>
                        <div class="p-2">
                            <p>
                            <h5><?= $copyTerms->title; ?></h5>
                            </p>

                            <?= $copyTerms->message; ?>

                        </div>

                        <!-- <form method="POST" action="<?php //$_SERVER['PHP_SELF'] 
                        ?>"> -->
                        <!-- <form method="POST" action="../../detailview"> -->
                        <form method="POST" action="../../accept">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <div class="alert alert-warning">

                                    <b>Completion date: </b>
                                    <?= date("l jS \of F Y ", strtotime($data->completion_date)); ?>

                                </div>
                                <div class="form-check">
                                    <input type="hidden" name="id" value="<?= $data->reviewID ?>" />
                                    <input type="hidden" name="submission_id" value="<?= $data->submissionID ?>" />
                                    <input class="checkmark" type="checkbox" value="2" id="accept" name="consent">
                                    <label class="form-check-label fw-bold" for="accept">
                                        Accept
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="checkmark" type="checkbox" value="20" id="decline" name="consent">
                                    <label class="form-check-label fw-bold" for="decline">
                                        Decline
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-outline-secondary" type="submit">Submit</button>

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
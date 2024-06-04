<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row ">
        <div class="col-12 d-flex justify-content-center">
            <div class="page-title-box ">
                <h5 class="mb-sm-0 font-size-24">Editorial history</h5>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <?php session_start(); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    <?php
                    // print '<pre>';
                    // print_r($notifications);
                    ?>
                    <?php if ($notifications): ?>
                        <div class="accordion" id="accordionNotifications">
                            <?php foreach ($notifications as $note): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $note['id']; ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse<?= $note['id']; ?>" aria-expanded="true"
                                            aria-controls="collapse<?= $note['id']; ?>">
                                            <?= $note['title']; ?> &nbsp; <code> <?= $note['date_created']; ?></code>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $note['id']; ?>" class="accordion-collapse collapse "
                                        aria-labelledby="heading<?= $note['id']; ?>" data-bs-parent="#accordionNotifications">
                                        <div class="accordion-body">
                                            <strong>Sender : <?= $note['sender']; ?></strong>
                                            <p><strong>Recipient : <?= $note['recipient']; ?></strong></p>
                                            <p><strong>Submission# : <?= $note['submissionID']; ?></strong></p>
                                            <p>Message : <?= $note['message']; ?></p>
                                            <?php if ($note['file']): ?>
                                                <?= $note['file']; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>

                    <?php endif; ?>

                    <div class="">
                        <!-- = $pager->links() ?> -->
                        <?= $pager->simpleLinks() ?>
                    </div>
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
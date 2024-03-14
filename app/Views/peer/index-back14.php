<?php $page_session = \Config\Services::session(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Peer Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>



<div class="container">
    <?php if ($page_session->getTempdata("success")) : ?>
        <div class="alert alert-success"><?= $page_session->getTempdata("success"); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata("error")) : ?>
        <div class="alert alert-danger"><?= $page_session->getTempdata("error"); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="list-group col-6 p-2 mx-auto">
            <h2><span class="badge bg-secondary">Contents to be reviewed</span></h2>
            <div id="msg"></div>
            <?php if ($reviews) : ?>
                <?php foreach ($reviews as $key => $review) : ?>
                    <?php if ($review->status == 2 || $review->status == 3) : ?>
                        <div>
                            <h5><span class="badge text-bg-secondary  "><?= $review->title; ?></span></h5>
                        </div>
                        <form id="<?= $review->submissionID; ?>" method="POST" action="updateStatus">
                            <div class="d-flex justify-content-start">
                                <div class="form-check">
                                    <?php if ($review->status == 2) : ?>
                                        <input class="checkmark" type="radio" value="2" id="accepted" name="radiobtn" onClick="radioCtr(2,<?= $review->reviewID; ?>);" checked>
                                    <?php else : ?>
                                        <input class="checkmark" type="radio" value="2" id="accepted" name="radiobtn" onClick="radioCtr(2,<?= $review->reviewID; ?>);">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="radiobtn">
                                        Accepted
                                    </label>
                                </div>
                                <div class="form-check">
                                    <?php if ($review->status == 3) : ?>
                                        <input class="checkmark" type="radio" value="3" id="completed" name="radiobtn" onClick="radioCtr(3,<?= $review->reviewID; ?>);" checked>
                                    <?php else : ?>
                                        <input class="checkmark" type="radio" value="3" id="completed" name="radiobtn" onClick="radioCtr(3,<?= $review->reviewID; ?>);">
                                    <?php endif; ?>

                                    <label class="form-check-label" for="radiobtn">
                                        Completed
                                    </label>
                                </div>

                            </div>
                        </form>
                        <div><span class="badge  text-bg-info">Attachments</span>
                            <a href="peer/discussion/<?= $review->submissionID; ?>/<?= $review->editor_id; ?>" class="btn btn-secondary btn-sm float-end">
                                Discussion <span class="badge text-bg-warning"><?= $noteCount[$key]; ?></span>
                            </a>
                        </div>

                        <?php if (property_exists($review, 'reviewContents')) : ?>
                            <?php foreach ($review->reviewContents as $content) : ?>
                                <div><a href="<?= base_url(); ?>editor/downloads/<?= $content->content; ?>"><?= $content->content; ?></a></div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                        <!-- form editor_peer_content -->
                        <?php if ($editorPeerContent) : ?>
                            <?php foreach ($editorPeerContent as $peerContent) : ?>


                                <div><a href="<?= base_url(); ?>editor/downloads/<?= $peerContent->upload_content; ?>"><?= $peerContent->upload_content; ?></a></div>

                            <?php endforeach;
                            ?>
                        <?php endif; ?>
                        <!-- eof form editor_peer_content -->
                    <?php elseif ($review->status == 4) : ?>
                        <p></p>
                        <h4><span class="badge text-bg-warning">Latest submission to accept/review</span></h4>
                        <div>
                            <h5 class=" badge text-bg-danger">
                                <?= $review->title; ?> -----> DECLINE
                            </h5>
                        </div>
                    <?php else : ?>
                        <p></p>
                        <h4><span class="badge text-bg-warning">Latest submission to accept/review</span></h4>
                        <div>
                            <h5 class="fw-bold">
                                <a href="<?= base_url(); ?>peer/accept/<?= $review->submissionID; ?>/<?= $review->reviewID; ?>">
                                    <?= $review->title; ?>
                                </a>

                            </h5>
                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/peer.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
<?php $page_session = \Config\Services::session(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Peer Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>



<div class="container" >
    <?php if ($page_session->getTempdata("success")): ?>
        <div class="alert alert-success"><?= $page_session->getTempdata("success"); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata("error")): ?>
        <div class="alert alert-danger"><?= $page_session->getTempdata("error"); ?></div>
    <?php endif; ?>
    <div class="row">   
        <div class="list-group col-6 p-2 mx-auto">
            <h2><span class="badge bg-secondary">Contents to be copy-edit</span></h2>
            <div id="msg"></div>
            <?php if ($contents): ?>
                <?php foreach ($contents as $review): ?>
                    <div ><h5><span class="badge text-bg-secondary  "><?= $review->decision; ?></span></h5></div>
                    <form id="<?= $review->submissionID; ?>" method="POST" action="updateStatus">
                        <div class="d-flex justify-content-start">
                            <div class="form-check">
                                <?php if($review->status ==2):?>
                                <input class="checkmark" type="radio" value="2" id="accepted" name="radiobtn" onClick="radioCtr(2,<?= $review->id; ?>);" checked>
                                <?php else:?>
                                <input class="checkmark" type="radio" value="2" id="accepted" name="radiobtn" onClick="radioCtr(2,<?= $review->id; ?>);">
                                <?php endif;?>
                                <label class="form-check-label" for="radiobtn">
                                    Accepted
                                </label>
                            </div>
                            <div class="form-check">
                                <?php if($review->status ==3):?>
                                <input class="checkmark" type="radio" value="3" id="completed" name="radiobtn" onClick="radioCtr(3,<?= $review->id; ?>);" checked>
                               <?php else:?>
                                <input class="checkmark" type="radio" value="3" id="completed" name="radiobtn" onClick="radioCtr(3,<?= $review->id; ?>);">
                                <?php endif;?>
                                
                                <label class="form-check-label" for="radiobtn">
                                    Completed
                                </label>
                            </div>
                            <div class="form-check">
                                <?php if($review->status ==4):?>
                                <input class="checkmark" type="radio" value="4" id="rejected" name="radiobtn" onClick="radioCtr(4,<?= $review->id; ?>);" checked>
                                <?php else:?>
                                <input class="checkmark" type="radio" value="4" id="rejected" name="radiobtn" onClick="radioCtr(4,<?= $review->id; ?>);">
                                <?php endif;?>
                                <label class="form-check-label" for="radiobtn">
                                    Rejected
                                </label>
                            </div>
                        </div>
                    </form>
                    <div><span class="badge  text-bg-info">Attachments</span>
                        <a href="editcopy/discussion/<?= $review->submissionID; ?>/<?= $review->editorID; ?>" class="btn btn-secondary btn-sm float-end">
                            Discussion <span class="badge text-bg-warning"><?= $count;?></span>
                        </a> 
                    </div>
                  <div><a href="<?= base_url(); ?>editor/downloads/<?= $review->upload_content; ?>"><?= $review->upload_content; ?></a></div>
                            
                    
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/peer.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
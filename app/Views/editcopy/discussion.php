<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Discussion
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<div class="container" >
    <div class="list-group col-6 p-2 mx-auto">
        <h2><span class="badge bg-secondary">Discussion</span></h2>
        <form id="replyForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="submission_id" name="submission_id" value="<?= $submission_id; ?>"/>
            <input type="hidden" id="editor_id" name="editor_id" value="<?= $editor_id; ?>"/>
            <div class="mb-3">
                <label for="title" class="col-form-label">Subject <span class="redstar">*</span></label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="message" class="col-form-label">Message <span class="redstar">*</span></label>
                <textarea class="form-control" id="message" name="message" required></textarea>
            </div>
            <h5><span class="badge text-bg-secondary  ">File attachment</h5>
            <div id="fileUploadFields">
                <div class="p-2">
                    <input type="file" name="revisionFile" id="revisionFile" class="fileToUpload">
                </div>
            </div>
            <div class="d-grid gap-2" >
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>

    </div>
    
    <div class="list-group col-6 p-2 mx-auto">
        
         <h3>Editor discussion</h3>
                <?php
                if ($editorDiscussions):
                    $editorMailRecieved = [];
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    foreach ($editorDiscussions as $discussion):
                                        $editorMailRecieved = $discussion;
                                        ?>
                                        <tr>
                                            <td class="fw-bold" >
                                                <a href="#"   data-bs-toggle="modal"   data-bs-target="#peerModal">
                                                    <?= $discussion->decision; ?>
                                                </a>
                                            </td>
                                            <td><?= $discussion->decision_date; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
    </div>
    
    
    
   <!-- Peer Modal -->
    <div class="modal fade" id="peerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="peerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="replyModalLabel">Discussion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($editorDiscussions): ?>
                    <div>From <span class="fw-bold">Editorial</span> : <?= $editorMailRecieved->sender . '  ' . $editorMailRecieved->sender_email; ?></div>
                        <div class="fw-bold"><?= $editorMailRecieved->decision; ?></div>
                        <div><?= $editorMailRecieved->comments; ?></div>

                        <?php if ($editorMailRecieved->upload_content): ?>
                            <div class="text-secondary fw-bold">Attachment &nbsp;&nbsp; <?= $editorMailRecieved->decision_date; ?></div>
                            <p><a href="../../../editor/downloads/<?= $editorMailRecieved->upload_content; ?>"><?= $editorMailRecieved->upload_content; ?> </a> </p>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>

            </div>
        </div>
    </div> <!-- eof peer modal -->


</div>

<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/attachment.js"></script>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>
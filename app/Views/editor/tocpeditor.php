<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Copy editor
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container">

    <?php
//    print '<pre>';
//    print_r($cpEditor);
//   exit;
    ?>
    <div class="row"> 
        <div class="list-group col-6 p-2 mx-auto">
            <form action="sendCopyEditor"  method="POST" enctype="multipart/form-data">

                <div >
                    <?php if ($cpEditor): ?>
                        <div>
                            <label for="cp-editor" class="form-label fw-bold">Add copy-editor <span class="redstar">*</span></label>
                            <?= form_dropdown('copyeditor', $cpEditor, '', 'class="form-select"'); ?>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="submission_id" value="<?= $submissionid; ?>"/>
                    <div >
                        <label for="title" class="form-label fw-bold ">Title<span class="redstar">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $title; ?>" required/>
                    </div>
                    <div >
                        <label for="message" class="form-label fw-bold">Message <span class="redstar">*</span></label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea> 
                    </div>

                    <div class="mb-3">
                        <label for="cpFile" class="form-label fw-bold">Upload file to send copyediting<span class="redstar">*</span></label>
                        <input class="form-control" type="file" id="cpFile" name="cpFile">
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary" type="submit" submit="button">Send to copy-editor</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- comment -->

<?= $this->endSection(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container-fluid">
    <div class="list-group col-12 p-2 mx-auto">

        <h5 class="p-2 alert-warning text-center">+Add Reviews to Email</h5>

        <?php if ($mails): ?>
            <?php foreach ($mails as $key => $mail): ?>
                <?php
                if ($mail->file) {
                    $fileurl = base_url() . 'editor/downloads/' . $mail->file;
                    $message = <<<EOT
                    <p>
                    <h5>$mail->title</h5>
                    <h6>Recommondation: $mail->recommondation</h6>
                    </p> $mail->message
                    <p><a href='$fileurl'>$mail->file</a></p>
                EOT;
                } else {
                    $message = <<<EOT
                    <p>
                    <h5>$mail->title</h5>
                    <h6>Recommondation: $mail->recommondation</h6>
                    </p> $mail->message
                    EOT;
                }
                ?>
                <div id="v<?= $key; ?>" onclick="requestRevision('v<?= $key; ?>')" value="<?= $message; ?>"
                    class="border border-primary p-2 m-2 rounded" style="cursor:pointer;">
                    <p>
                    <h5><?= $mail->title; ?></h5>
                    <h6>Recommondation: <?= $mail->recommondation; ?></h6>
                    </p><?= $mail->message; ?>
                    <p>
                    <p><a href="<?= base_url(); ?>editor/downloads/<?= $mail->file; ?>"><?= $mail->file; ?></a></p>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <?= form_open_multipart(); ?>

        <h5 class="p-2">Require New Review Round</h5>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="new_revision_round" id="new_revision_round1" value="0"
                checked>
            <label class="form-check-label" for="new_revision_round">
                Revisions will not be subject to a new round of peer reviews.
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="new_revision_round" id="new_revision_round2" value="1">
            <label class="form-check-label" for="new_revision_round">
                Revisions will be subject to a new round of peer reviews.

            </label>
        </div>

        <h5 class="p-2">Send Email</h5>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="send_email" id="send_email1" value="1">
            <label class="form-check-label" for="send_email">
                Send an email notification to the author(s);
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="send_email" id="send_email2" value="0" checked>
            <label class="form-check-label" for="send_email">
                Do not send an email notification.

            </label>
        </div>

        <div class="p-2">
            <input type="hidden" name="authorid" value="<?= $submission->authorID; ?>">
            <label for="message" class="form-label fw-bold">Notification/Message</label>
            <textarea class="form-control" name="message" id="message" rows="6" required></textarea>
        </div>

        <p></p>
        <div class="p-2">
            <button type="submit" value="Submit" class="btn btn-primary btn-lg">Record Editorial Decision</button>
            <button type="button" onclick="history.back()" class="btn btn-secondary btn-lg">Cancel</button>
        </div>
        <!-- <div class="d-grid">
            <button class="btn btn-primary" type="submit" value="Submit">Record Editorial Decision</button>
        </div> -->
        <?= form_close(); ?>
    </div>
</div><!-- comment -->
<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/requestRevision.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
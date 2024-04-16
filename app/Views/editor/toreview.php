<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-10">
            <div class="card">
                <div class="card-body">
                    <form action="sendtopeer" method="POST">
                        <div class="row">
                            <div class="list-group col-12">

                                <?php if ($peer): ?>
                                    <div>
                                        <label for="peer" class="form-label fw-bold">Add reviewer <span
                                                class="redstar">*</span></label>
                                        <?= form_dropdown('peer', $peer, '', 'class="form-select"'); ?>
                                    </div>
                                <?php endif; ?>
                                <input type="hidden" name="submissionid" value="<?= $submissionid; ?>" />
                                <div>
                                    <label for="title" class="form-label fw-bold ">Title<span
                                            class="redstar">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required />
                                </div>
                                <div>
                                    <label for="message" class="form-label fw-bold">Message <span
                                            class="redstar">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3"
                                        required></textarea>
                                </div>
                                <p></p>
                                <div>
                                    <label for="completion_date" class="form-label fw-bold ">FINISH REVIEW BEFORE<span>
                                            *</span></label>
                                    <input type="date" class="form-control" id="completion_date" name="completion_date"
                                        required />
                                </div>

                                <p></p>
                                <!-- <div class="d-grid gap-2">
                                    <button class="btn btn-outline-secondary" submit="button">Send to review</button>
                                </div> -->
                                <!-- </div>


                            <div class="col-6"> -->

                                <h4>SELECT COMPONENT</h4>
                                <?php if ($subContents): ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Select file</th>
                                                <th scope="col">Article component</th>
                                                <th scope="col">Download</th>
                                                <th scope="col">Submission date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($subContents as $k => $content): ?>
                                                <?php $submissionid = $content->submissionID; ?>
                                                <tr>
                                                    <td>
                                                        <div class="square-switch">
                                                            <input type="checkbox" id="contentid<?= $k; ?>" switch="info"
                                                                name="contentid[]" value="<?= $content->id; ?>" />

                                                            <label for="contentid<?= $k; ?>" data-on-label="Yes"
                                                                data-off-label="No"></label>

                                                        </div>

                                                        <!-- <input class="checkmark" type="checkbox" id="contentid" name="contentid[]" value="<? //= $content->id; 
                                                                ?>"> -->
                                                        <? //= $title; 
                                                                ?>
                                                    </td>
                                                    <td>
                                                        <?= $content->article_component; ?>
                                                    </td>
                                                    <td><a href="<?= base_url(); ?>editor/downloads/<?= $content->content; ?>">
                                                            <?= $content->content; ?>
                                                        </a></td>
                                                    <td>
                                                        <?= $content->submission_date; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php if ($editorContent): ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <span class="badge text-bg-warning">Editor's uploaded file</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>

                                                        <input class="checkmark" type="checkbox" id="contentid"
                                                            name="contentid[]" value="<?= $editorContent->decisionID; ?>">
                                                        <?= $title; ?>
                                                    </td>
                                                    <td><a
                                                            href="<?= base_url(); ?>editor/downloads/<?= $editorContent->upload_content; ?>">
                                                            <?= $editorContent->upload_content; ?>
                                                        </a></td>
                                                    <td>
                                                        <?= $editorContent->decision_date; ?>
                                                    </td>
                                                </tr>

                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>


                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" submit="button">Send to review</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div><!-- comment -->

<?= $this->endSection(); ?>
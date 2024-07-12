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
                    <form action="send_to_production" method="POST">
                        <div class="row">
                            <div class="list-group col-12">

                                <?php if ($peer): ?>
                                    <div>
                                        <label for="peer" class="form-label fw-bold">Add Copy-Editor <code>*</code></label>

                                        <? //= form_dropdown('peer', $peer, '', 'class="s-example-basic-single"'); ?>

                                        <select class="js-example-basic-single form-select" name="peer">
                                            <?php foreach ($peer as $key => $value): ?>
                                                <option value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <p></p>
                                <?php endif; ?>
                                <input type="hidden" name="submissionid" value="<?= $submissionid; ?>" />
                                <div>
                                    <label for="title" class="form-label fw-bold ">Title <code>*</code></label>
                                    <input type="text" class="form-control" id="title" name="title" required />
                                </div>
                                <div>
                                    <label for="message" class="form-label fw-bold">Message <code>*</code></label>
                                    <textarea class="form-control" id="message" name="message" rows="3"
                                        required></textarea>
                                </div>
                                <p></p>
                                <div>
                                    <label for="completion_date" class="form-label fw-bold ">FINISH COPY-EDITING BEFORE
                                        <code>*</code></label>
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

                                <!-- copyeditor bof -->



                                <?php if ($final_upload): ?>
                                    <h4>Copy-editor's final files</h4>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Select files</th>
                                                <th scope="col">Article component</th>
                                                <th scope="col">Download</th>
                                                <th scope="col">Submission date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <div class="square-switch">
                                                        <input type="checkbox" id="contentid_rev1<?= $final_upload->id; ?>"
                                                            switch="info" name="final_upload"
                                                            value="<?= $final_upload->id; ?>" />
                                                        <label for="contentid_rev1<?= $final_upload->id; ?>"
                                                            data-on-label="Yes" data-off-label="No"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    Title page
                                                </td>
                                                <td><a
                                                        href="<?= base_url(); ?>editor/downloads/<?= $final_upload->title_page; ?>">
                                                        <?= $final_upload->title_page; ?>
                                                    </a></td>
                                                <td>
                                                    <?= $final_upload->date_created; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    &nbsp;
                                                </td>
                                                <td>
                                                    Article text
                                                </td>
                                                <td><a
                                                        href="<?= base_url(); ?>editor/downloads/<?= $final_upload->article_text; ?>">
                                                        <?= $final_upload->article_text; ?>
                                                    </a></td>
                                                <td>
                                                    <!-- date -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    &nbsp;
                                                </td>
                                                <td>
                                                    <?= $final_upload->article_type; ?>

                                                </td>
                                                <td><a
                                                        href="<?= base_url(); ?>editor/downloads/<?= $final_upload->article_file; ?>">
                                                        <?= $final_upload->article_file; ?>
                                                    </a></td>
                                                <td>
                                                    <!-- date -->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                                <!-- copyeditor eof -->


                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" submit="button">Send to production</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div><!-- comment -->

<?= $this->section('javascript'); ?>
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>
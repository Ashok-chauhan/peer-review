<?php $page_session = \Config\Services::session(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container">

    <p></p>
    <?php if ($page_session->getTempdata("success")) : ?>
        <div class="alert alert-success"><?= $page_session->getTempdata("success"); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata("error")) : ?>
        <div class="alert alert-danger"><?= $page_session->getTempdata("error"); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="list-group col-7">
            <h2><span class="badge bg-secondary"> Submission files </span></h2>

            <?php if (isset($contents)) : ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Download</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contents as $content) : ?>
                            <?php $submissionid = $content->submissionID; ?>
                            <tr>
                                <th scope="row"><?= $content->submissionID; ?></th>
                                <td><?= $title; ?></td>
                                <td><a href="<?= base_url(); ?>editor/downloads/<?= $content->content; ?>"><?= $content->content; ?></a></td>
                                <td><?= $content->submission_date; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <div class="col-7" id="error"></div>

            <div id="editor-file"></div>

            <?php if ($editorialDecision) : ?>
                <div class="badge text-bg-warning">Your Uploaded files</div>
                <table class="table table-bordered border-primary">
                    <tr>
                        <td> <?= $editorialDecision->upload_content; ?></td>
                        <td> <?= $editorialDecision->decision_date; ?> </td>
                        <td><a href="../deleteEditorUpload/<?= $editorialDecision->submissionID; ?>/<?= $editorialDecision->decisionID; ?>">Delete</a></td>
                    </tr>
                </table>

            <?php endif; ?>

            <div class="col-7">

                <h5><span class="badge text-bg-secondary p-1 ">Upload file</h5>
                <div id="fileUploadFields">
                    <form id="editor_upload" method="post">
                        <div class="p-2">
                            <input type="file" name="revisionFile" id="revisionFile" class="fileToUpload">
                            <input type="hidden" id="submission_id" name="submission_id" value="<?= $submissionid; ?>" />
                            <!--                        <span class="float-end p-2">
                                <button id="upload" class="btn btn-primary btn-sm" submit="button" onClick="editorUpload()">Upload</button>   
                             </span>-->
                        </div>
                    </form>
                </div>
            </div>

            <div class="list-group col-7">
                <h3><span class="badge bg-secondary">Author discussion</span></h3>
                <?php
                if ($discussions) :
                    $mailRecieved = [];
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
                            foreach ($discussions as $discussion) :
                                $mailRecieved = $discussion;
                            ?>
                                <tr>
                                    <td class="fw-bold">
                                        <a href="#" onClick="getRevisionFile('<?= $discussion->content_id; ?>')" data-bs-toggle="modal" data-bs-target="#editorModal">
                                            <?= $discussion->title; ?>
                                        </a>
                                    </td>
                                    <td><?= $discussion->date_created; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>



        <div class="col-5">
            <div class="card ">
                <h5 class="card-header">Author</h5>
                <div class="card-body">
                    <h5 class="card-title"><?= $authorName; ?></h5>
                    <?= anchor('editor/notify/' . $userid . '/' . $submissionid . '', 'Notify', 'class="btn btn-outline-secondary"'); ?>
                </div>
            </div>
            <p></p>
            <div class="">
                <form method="POST" action="../toreview">
                    <input type="hidden" name="submissionid" value="<?= $submissionid; ?>" />
                    <input type="hidden" name="title" value="<?= $title; ?>" />
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary" submit="button">Send to review</button>

                    </div>

                </form>
            </div>
            <p></p>
            <div> <!-- bof peer -->
                <div class="card ">

                    <h5 class="card-header">Reviewer/Peer discussion<span class="float-end">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#discussModal" type="button" class="btn btn-secondary btn-sm">Discuss</a>
                        </span></h5>

                    <div class="card-body">
                        <!--                <h3><span class="badge bg-secondary">Peer/Reviewer discussion</span></h3>-->
                        <?php
                        if ($peerDiscussions) :
                            $peerMailRecieved = [];
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
                                    foreach ($peerDiscussions as $discussion) :
                                        $peerMailRecieved = $discussion;
                                    ?>
                                        <tr>
                                            <td class="fw-bold">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#peerModal">
                                                    <?= $discussion->title; ?>
                                                </a>
                                            </td>
                                            <td><?= $discussion->date_created; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div> <!-- eof peer -->

            <p></p>
            <div class="">
                <form method="POST" action="../tocpeditor">
                    <input type="hidden" name="submissionid" value="<?= $submissionid; ?>" />
                    <input type="hidden" name="title" value="<?= $title; ?>" />
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary" submit="button">Send to copyediting</button>

                    </div>

                </form>
            </div>
            <p></p>
            <div> <!-- bof copy editor -->
                <div class="card ">
                    <h5 class="card-header">Copy editor discussion<span class="float-end">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#copyeditorModal" type="button" class="btn btn-secondary btn-sm">Discuss</a>
                        </span></h5>
                    <div class="card-body">

                        <?php
                        if ($editorial_decision) :
                            $cpeditorMailRecieved = [];
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
                                    foreach ($editorial_decision as $discussion) :
                                        $cpeditorMailRecieved = $discussion;


                                    ?>
                                        <tr>
                                            <td class="fw-bold">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#co-editorModal">
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
                </div>
            </div> <!-- eof copy editor -->
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="editorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="replyModalLabel">Discussion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($discussions) : ?>
                        <div>From: <?= $mailRecieved->sender . '  ' . $mailRecieved->sender_email; ?></div>
                        <div class="fw-bold"><?= $mailRecieved->title; ?></div>
                        <div><?= $mailRecieved->message; ?></div>

                        <div id="attachment"></div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>

            </div>
        </div>
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
                    <?php if ($peerDiscussions) : ?>
                        <div>From: <?= $peerMailRecieved->sender . '  ' . $peerMailRecieved->sender_email; ?></div>
                        <div class="fw-bold"><?= $peerMailRecieved->title; ?></div>
                        <div><?= $peerMailRecieved->message; ?></div>

                        <?php if ($peerMailRecieved->content) : ?>
                            <div class="text-secondary fw-bold">Attachment &nbsp;&nbsp; <?= $peerMailRecieved->date_created; ?></div>
                            <p><a href="../downloads/<?= $peerMailRecieved->content; ?>"><?= $peerMailRecieved->content; ?> </a> </p>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>

            </div>
        </div>
    </div> <!-- eof peer modal -->

    <!-- co-editor modal -->

    <div class="modal fade" id="co-editorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="co-editorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="replyModalLabel">Discussion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($editorial_decision) : ?>
                        <div>From: <?= $cpeditorMailRecieved->sender . '  ' . $cpeditorMailRecieved->sender_email; ?></div>
                        <div class="fw-bold"><?= $cpeditorMailRecieved->decision; ?></div>
                        <div><?= $cpeditorMailRecieved->comments; ?></div>

                        <?php if ($cpeditorMailRecieved->upload_content) : ?>
                            <div class="text-secondary fw-bold">Attachment &nbsp;&nbsp; <?= $cpeditorMailRecieved->decision_date; ?></div>
                            <p><a href="../downloads/<?= $cpeditorMailRecieved->upload_content; ?>"><?= $cpeditorMailRecieved->upload_content; ?> </a> </p>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>

            </div>
        </div>
    </div>
    <!-- eof co-editor modal -->

    <!-- bof peer discuss Modal -->
    <div class="modal fade" id="discussModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="discussModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="discussModalLabel">Discussion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="discussForm" action="../peerDiscussion" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Title <span class="redstar">*</span></label>
                            <input type="text" class="form-control" id="title" name="title">
                            <input type="hidden" id="subId" name="subId" value="<?= $submission_id; ?>" </div>
                            <div class="mb-3">
                                <label for="message" class="col-form-label">Message <span class="redstar">*</span></label>
                                <textarea class="form-control" id="message" name="message"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editorfile" class="col-form-label">Upload </label>
                                <input type="file" class="form-control" id="editorfile" name="editorfile">
                            </div>

                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Send</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- eof peer discuss modal -->



    <!-- bof copy editor modal -->
    <div class="modal fade" id="copyeditorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="copyeditorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="copyeditorModalLabel">Discussion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="copyeditorForm" action="../copyeditorDiscussion" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Title <span class="redstar">*</span></label>
                            <input type="text" class="form-control" id="title" name="title">
                            <input type="hidden" id="subId" name="subId" value="<?= $submission_id; ?>" </div>
                            <div class="mb-3">
                                <label for="message" class="col-form-label">Message <span class="redstar">*</span></label>
                                <textarea class="form-control" id="message" name="message"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editorfile" class="col-form-label">Upload </label>
                                <input type="file" class="form-control" id="editorfile" name="editorfile">
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Send</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- eof copy editor modal -->

</div><!-- content -->


<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/attachment.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/copyEditorDiscussion.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
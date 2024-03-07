<?php $page_session = \Config\Services::session(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<?php
$STATUS = [
    0 => 'Submitted',
    1 => 'Sent to Review',
    2 => 'In Review',
    3 => 'Review Completed',
    4 => 'Rejected'
];


?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-24" style="text-transform: capitalize;"><?= $submission->title; ?></h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">



                    <h4 class="card-title font-size-14"><b>Prefix</b></h4>
                    <p><?= $submission->prefix; ?></p>


                    <h4 class="card-title font-size-14"><b>Subtitle</b></h4>
                    <p><?= $submission->subtitle; ?></p>

                    <h4 class="card-title font-size-14"><b>Abstract</b></h4>
                    <p><?= $submission->abstract; ?></p>

                    <h4 class="card-title font-size-14"><b>List of Contributors</b></h4>
                    <div class="col-lg-12">
                        <table id="datatable" class="table table-registration font-size-13 table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Primary Contact</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if ($submission->contributor) : ?>
                                    <?php foreach ($submission->contributor as $contributor) : ?>
                                        <tr>
                                            <td data-label="Name"><?= $contributor->title . ' ' . $contributor->name . ' ' . $contributor->m_name . ' ' . $contributor->l_name; ?></td>
                                            <td data-label="Email"><?= $contributor->email; ?></td>
                                            <?php if ($contributor->role == 3) : ?>
                                                <td data-label="Role">Author</td>
                                            <?php else : ?>
                                                <td data-label="Role">Translator</td>
                                            <?php endif; ?>
                                            <?php if ($contributor->primary_contact) : ?>
                                                <td data-label="Primary Contact"><i class="fa fa-check-square-o"></i></td>
                                            <?php else : ?>
                                                <td data-label="Primary Contact"></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>


                    <h4 class="card-title font-size-14"><b>Language</b></h4>
                    <p><?= $submission->language; ?> </p>

                    <h4 class="card-title font-size-14"><b>Keyword</b></h4>
                    <p><?= $submission->keyword; ?></p>

                    <h4 class="card-title font-size-14"><b>References</b></h4>
                    <p><?= $submission->reference; ?></p>

                    <h4 class="card-title font-size-14"><b>Comments for editor</b></h4>
                    <p><?= $submission->content; ?> </p>

                    <h4 class="card-title font-size-14"><b>Article Component</b></h4>
                    <div class="col-lg-12">
                        <table id="datatable" class="table table-registration font-size-13 table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Component</th>
                                    <th>Filename</th>
                                    <th>Download</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if ($contents) : ?>
                                    <?php foreach ($contents as $content) : ?>
                                        <tr>
                                            <td data-label="Component"><?= $content->article_component; ?></td>
                                            <td data-label="Filename"><?= $content->content; ?></td>
                                            <td data-label="Filename"> <?= anchor('author/downloads/' . $content->content, '<span class="btn1 btn-success">download</span>'); ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <div class="mb-0" style="float: right;">
                        <div>

                            <?= anchor('editor/downloadZip/' . $submission->submissionID, '<span class="btn btn-primary waves-effect waves-light me-1">Downloads</span>'); ?>

                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body ">

                    <div class="">
                        <h4 class="card-title">CURRENT STATUS</h4>


                        <?php if ($submission->status_id == 0 && !$sentMessages) : ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-primary " style="padding: 0.6rem 58px;border-radius: 5px;">
                                    <i class="fa fa-send-o"></i>
                                    Submitted
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ($sentMessages) : ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-warning  waves-light" style="padding: 0.6rem 13px;border-radius: 5px;">
                                    <i class="fa fa-search"></i>&nbsp; Pre-Review Discussions
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($submission->status_id <= 1) : ?>
                            <div class="list-group-item" role="alert">
                                <form method="POST" action="../toreview">
                                    <input type="hidden" name="submissionid" value="<?= $submission->submissionID; ?>" />
                                    <input type="hidden" name="title" value="<?= $submission->title; ?>" />

                                    <button class="btn btn-warning waves-effect waves-light" submit="button" style="padding: 0.47rem 43px;">
                                        <i class="fa fa-search"></i>&nbsp;Send to review
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>

                        <?php if ($submission->status_id > 1 && $submission->status_id <= 3) : ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-danger waves-light" style="padding: 0.47rem 56px; border-radius: 5px;">
                                    <i class="fa fa-comments"></i>&nbsp; In Review

                                </span>
                            </div>


                        <?php endif; ?>



                        <?php if ($submission->status_id == 4) : ?>
                            <div class="list-group-item" role="alert">
                                <button type="button" class="btn btn-danger waves-effect waves-light" style="padding: 0.47rem 56px;">
                                    <i class="fa fa-comments"></i>&nbsp; Rejected
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if ($editorialDecision) : ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-dark waves-light" style="padding: 0.47rem 46px; border-radius: 5px;">
                                    <i class="fas fa-edit"></i>&nbsp; Copy Editing
                                </span>
                            </div>

                            <div class="list-group-item" role="alert">
                                <button type="button" class="btn btn-success waves-effect waves-light" style="padding: 0.47rem 54px;">
                                    <i class="fa fa-area-chart"></i>&nbsp; Production
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-24" style="text-transform: capitalize;">Pre-Review Discussions</h4>

            </div>
        </div>
    </div>

    <div class="row">
        <div id="msg"></div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <?php if (!$sentMessages) : ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#revisionModal">
                            Start Discussion
                        </button>
                    <?php endif; ?>


                    <?php if ($discussions) : ?>
                        <?php foreach ($discussions as $key => $discussion) : ?>


                            <div class="card-body">
                                <div class="d-flex mb-4">
                                    <img class="me-3 rounded-circle avatar-sm" src="<?= base_url(); ?>assets/images/users/avatar-1.jpg" alt="Generic placeholder image">
                                    <div class="flex-1">
                                        <h5 class="font-size-14 my-1"><?= $discussion->sender; ?></h5>
                                        <small class="text-muted">
                                            <?php //if (array_key_exists($role, roles())) : 
                                            ?>
                                            <? //= roles()[$role]; 
                                            ?>
                                            <?php //endif; 
                                            ?>
                                            <!-- Editorial Co-ordinator -->

                                            <?= date("l jS \of F Y h:i:s A", strtotime($discussion->date_created)); ?>
                                        </small>

                                    </div>
                                </div>

                                <h4 class="font-size-16"><?= $discussion->title; ?></h4>

                                <p><?= $discussion->message; ?></p>
                                <?php if ($discussion->file) : ?>
                                    <h6>Attachment</h6>
                                    Article component: <?= $discussion->article_component; ?>
                                    <p><?= anchor('editor/downloads/' . $discussion->file,  $discussion->file); ?></p>
                                <?php endif; ?>

                                <hr />



                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#revisionModal">
                                    <i class="mdi mdi-reply"></i>Reply
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>


                    <!-- revison/ reply Modal bof-->
                    <div class="modal fade" id="revisionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="revisionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="revisionModalLabel">Discussion</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Add revision</h5>

                                    <div id="editor"></div>
                                    <form id="revisionForm" action="../notify" method="POST" enctype="multipart/form-data">



                                        <div class="mb-3">
                                            <label for="subject-title" class="col-form-label">Subject:*</label>
                                            <input type="text" class="form-control" id="subject-title" name="subject-title" required>
                                            <input type="hidden" name="submissionID" value="<?= $submission_id; ?>" />
                                            <input type="hidden" name="recipient" value="<?= $authorEmail; ?>" />
                                            <input type="hidden" name="recipient_id" value="<?= $userid; ?>" />
                                            <input type="hidden" name="authorName" value="<?= $authorName; ?>" />
                                            <input type="hidden" name="role" value="<?= $role; ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Message:</label>
                                            <textarea class="form-control" id="message-text" name="message-text" required></textarea>
                                        </div>
                                        <h3>File attachment</h3>
                                        <div class="fw-bold">Revision file? *</div>
                                        <select class="form-select" name="updateFileId" id="updateFileId">
                                            <option value="0">This is not a revision of an existing file</option>

                                            <?php if ($contents) : ?>
                                                <?php foreach ($contents as $content) : ?>
                                                    <option value="<?= $content->id; ?>">Revision of <?= $content->article_component; ?> - (<?= $content->content; ?>) </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </select>

                                        <div class="fw-bold">Article Component *</div>

                                        <select class="form-select" name="article_type" id="article_type">
                                            <option value="" disabled selected>Select article component</option>
                                            <option value="Article Text">Article Text</option>
                                            <option value="Title Page">Title Page</option>
                                            <option value="Reasearch Instrument">Research Instrument</option>
                                            <option value="Research Materials">Research Materials</option>
                                            <option value="Research Results">Research Results</option>
                                            <option value="Transcripts">Transcripts</option>
                                            <option value="Data Analysis">Data Analysis</option>
                                            <option value="Data Set">Data set</option>
                                            <option value="Source Texts">Source Texts</option>
                                            <option value="Other">Other</option>

                                        </select>


                                        <div id="fileUploadFields">
                                            <div class="p-2">
                                                <input type="file" name="revisionFile" id="revisionFile" class="fileToUpload">
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- eof revision/reply modal -->
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

                </div>

            </div>
            <!-- end col -->

            <!-- end col -->

        </div>



    </div>


    <?= $this->section('javascript'); ?>
    <script type="text/javascript" src="<?= base_url(); ?>js/attachment.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>js/addEditorRevision.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>js/copyEditorDiscussion.js"></script>

    <?= $this->endSection(); ?>
    <?= $this->endSection(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-24" style="text-transform: capitalize;">
                    <?= $submission->title; ?>
                </h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">



                    <h4 class="card-title font-size-14"><b>Prefix</b></h4>
                    <p>
                        <?= $submission->prefix; ?>
                    </p>


                    <h4 class="card-title font-size-14"><b>Subtitle</b></h4>
                    <p>
                        <?= $submission->subtitle; ?>
                    </p>

                    <h4 class="card-title font-size-14"><b>Abstract</b></h4>
                    <p>
                        <?= $submission->abstract; ?>
                    </p>

                    <h4 class="card-title font-size-14"><b>List of Contributors</b></h4>
                    <div class="col-lg-12">
                        <table id="datatable"
                            class="table table-registration font-size-13 table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Primary Contact</th>
                                </tr>
                            </thead>


                            <tbody>
                                <!-- <tr>
                                    <td data-label="Name"><? //= $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->last_name; 
                                    ?></td>
                                    <td data-label="Email"><? //= $user->email; 
                                    ?></td>
                                    <td data-label="Role">Author</td>
                                    <td data-label="Primary Contact"><input type="checkbox" disabled checked></td>
                                   
                                </tr> -->

                                <?php if ($coauthor): ?>
                                    <?php foreach ($coauthor as $contributor): ?>

                                        <tr>
                                            <td data-label="Name">
                                                <?= $contributor->title . ' ' . $contributor->name . ' ' . $contributor->m_name . ' ' . $contributor->l_name; ?>
                                            </td>
                                            <td data-label="Email">
                                                <?= $contributor->email; ?>
                                            </td>
                                            <?php if ($contributor->role == 3): ?>
                                                <td data-label="Role">Author</td>
                                            <?php else: ?>
                                                <td data-label="Role">Translator</td>
                                            <?php endif; ?>
                                            <?php if ($contributor->primary_contact): ?>
                                                <td data-label="Primary Contact"><i class="fa fa-check-square-o"></i></td>
                                            <?php else: ?>
                                                <td data-label="Primary Contact"></td>
                                            <?php endif; ?>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>


                    <h4 class="card-title font-size-14"><b>Language</b></h4>
                    <p>
                        <?= $submission->language; ?>
                    </p>

                    <h4 class="card-title font-size-14"><b>Keyword</b></h4>
                    <p>
                        <?= $submission->keyword; ?>
                    </p>

                    <h4 class="card-title font-size-14"><b>References</b></h4>
                    <p>
                        <?= $submission->reference; ?>
                    </p>

                    <h4 class="card-title font-size-14"><b>Comments for editor</b></h4>
                    <p>
                        <?= $submission->content; ?>
                    </p>

                    <h4 class="card-title font-size-14"><b>Article Component</b></h4>
                    <div class="col-lg-12">
                        <table id="datatable"
                            class="table table-registration font-size-13 table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Component</th>
                                    <th>Filename</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if ($submission_content): ?>
                                    <?php foreach ($submission_content as $content): ?>
                                        <tr>
                                            <td data-label="Component">
                                                <?= $content->article_component; ?>
                                            </td>
                                            <td data-label="Filename">
                                                <?= $content->content; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>

                    <br>
                    <div id="msg"></div>
                    <div class="mb-0" style="float: right;">
                        <div>
                            <!-- <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                Add Revision
                            </button> -->
                            <?= anchor('#', 'Add revision', [
                                'class' => 'btn btn-primary',
                                'data-bs-toggle' => 'modal',
                                'data-bs-target' => '#revisionModal',
                                'onClick' => 'subId(' . $submission->submissionID . ')'
                            ]); ?>
                        </div>
                    </div>

                </div>




            </div>

        </div>

        <!-- right  col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body ">

                    <div class="">
                        <h4 class="card-title">CURRENT STATUS</h4>


                        <?php if ($submission->status_id == 0 && !$discussions):
                            ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-primary " style="padding: 0.6rem 58px;border-radius: 5px;">
                                    <i class="fa fa-send-o"></i>
                                    Submitted
                                </span>
                            </div>
                        <?php endif;
                        ?>
                        <?php if ($discussions): ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-warning  waves-light" style="padding: 0.6rem 13px;border-radius: 5px;">
                                    <i class="fa fa-search"></i>&nbsp; Pre-Review Discussions
                                </span>
                            </div>
                        <?php endif; ?>


                        <?php if ($submission->status_id > 1 && $submission->status_id < 3): ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-danger waves-light" style="padding: 0.47rem 60px; border-radius: 5px;">
                                    <i class="fa fa-comments"></i>&nbsp; In Review

                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($submission->status_id == 3): ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-success waves-light" style="padding: 0.47rem 31px; border-radius: 5px;">
                                    <i class="fa fa-comments"></i>&nbsp; Review completed

                                </span>
                            </div>
                        <?php endif; ?>



                        <?php if ($submission->status_id == 7): ?>
                            <div class="list-group-item" role="alert">
                                <button type="button" class="btn btn-danger waves-effect waves-light"
                                    style="padding: 0.47rem 56px;">
                                    <i class="fa fa-comments"></i>&nbsp; Rejected
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if ($submission->status_id == 4): ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-dark waves-light" style="padding: 0.47rem 18px; border-radius: 5px;">
                                    <i class="fas fa-edit"></i>&nbsp; Ready to Copy Editing
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ($submission->status_id == 5): ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-danger waves-light" style="padding: 0.47rem 27px; border-radius: 5px;">
                                    <i class="fas fa-edit"></i>&nbsp; Under Copy Editing
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ($submission->status_id == 6): ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-success waves-light" style="padding: 0.47rem 12px; border-radius: 5px;">
                                    <i class="fas fa-edit"></i>&nbsp; Copy Editing completed
                                </span>
                            </div>
                        <?php endif; ?>


                    </div>

                </div>
            </div>
        </div>
        <!-- righ end col -->

        <!-- notifiations bof-->

        <div class="row">
            <div id="msg"></div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">


                        <?php if ($discussions): ?>
                            <?php foreach ($discussions as $key => $discussion): ?>

                                <?php
                                //  print '<pre>';
                                // print_r($discussion);
                                ?>
                                <div class="card-body">
                                    <div class="d-flex mb-4">
                                        <img class="me-3 rounded-circle avatar-sm"
                                            src="<?= base_url(); ?>assets/images/users/avatar-1.jpg"
                                            alt="Generic placeholder image">
                                        <div class="flex-1">
                                            <h5 class="font-size-14 my-1">
                                                <?php
                                                if (array_key_exists($discussion->sender_role, roles())): ?>
                                                    <?= roles()[$discussion->sender_role];
                                                    ?>
                                                <?php endif; ?>
                                            </h5>
                                            <small class="text-muted">(<b>
                                                    <?= date("l jS \of F Y h:i:s A", strtotime($discussion->date_created)); ?>

                                                </b> )</small>
                                        </div>
                                    </div>

                                    <h4 class="font-size-16">
                                        <?= $discussion->title; ?>
                                    </h4>

                                    <p>
                                        <?= $discussion->message; ?>
                                    </p>
                                    <?php if ($discussion->file): ?>
                                        <h6>Attachment</h6>
                                        Article component:
                                        <?= $discussion->article_component; ?>
                                        <p>
                                            <?= anchor('author/downloads/' . $discussion->file, $discussion->file); ?>
                                        </p>
                                    <?php endif; ?>

                                    <hr />

                                    <!-- firstmodal -->
                                    <!-- <a href="javascript: void(0);" class="btn btn-primary waves-effect mt-4" data-bs-toggle="modal" data-bs-target="#replyModal"> <i class="mdi mdi-reply"></i> Reply</a> -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#replyModal"
                                        data-arridx="<?= $discussion->sender_id . '/' . $discussion->sender_email . '/' . $discussion->submissionID . '/' . $discussion->title; ?>">
                                        <i class="mdi mdi-reply"></i> Reply
                                    </button>
                                </div>

                                <!-- author reply modal bof -->
                                <div class="modal fade" id="replyModal" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="replyModalLabel">Discussion</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div id="editor"></div>

                                                <form id="replyForm" action="../reply" method="POST"
                                                    enctype="multipart/form-data">

                                                    <input type="hidden" name="recipient" id="recipient" value="" />
                                                    <input type="hidden" name="submission" id="submission" value="" />
                                                    <input type="hidden" name="recipient_id" id="recipient_id" value="" />



                                                    <div class="mb-3">
                                                        <label for="subject-title" class="col-form-label">Subject:*</label>
                                                        <input type="text" class="form-control" id="subject-title"
                                                            name="subject-title" value="" required>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" id="message-text" name="message-text"
                                                            required></textarea>
                                                    </div>


                                                    <h3>File attachment</h3>
                                                    <div class="fw-bold">Revision file? *</div>
                                                    <select class="form-select" name="updateFileId" id="updateFileId">
                                                        <option value="0">This is not a revision of an existing file</option>

                                                        <?php if ($submission_content): ?>
                                                            <?php foreach ($submission_content as $content): ?>
                                                                <option value="<?= $content->id; ?>">Revision of
                                                                    <?= $content->article_component; ?> - (
                                                                    <?= $content->content; ?>)
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>

                                                    </select>


                                                    <div class="fw-bold">Article Component *</div>
                                                    <select class="form-select" name="article_type" id="article_type">
                                                        <option value="" disabled selected>Select article component</option>
                                                        <option value="Title Page">Title Page</option>
                                                        <option value="Article Text">Article Text</option>
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
                                                            <input type="file" name="revisionFile" id="revisionFile"
                                                                class="fileToUpload">
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- reply modal eof -->
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- notification eof -->
    </div>


    <!-- revison Modal bof-->
    <div class="modal fade" id="revisionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="revisionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="revisionModalLabel">Discussion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Add revision</h5>

                    <div id="editor"></div>
                    <form id="revisionForm" action="../revision" method="POST" enctype="multipart/form-data">



                        <div class="mb-3">
                            <label for="subject-title" class="col-form-label">Subject:*</label>
                            <input type="text" class="form-control" id="subject-title" name="subject-title" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text" name="message-text"></textarea>
                        </div>
                        <h3>File attachment</h3>
                        <div class="fw-bold">Revision file? *</div>
                        <select class="form-select" name="updateFileId" id="updateFileId">
                            <option value="0">This is not a revision of an existing file</option>

                            <?php if ($submission_content): ?>
                                <?php foreach ($submission_content as $content): ?>
                                    <option value="<?= $content->id; ?>">Revision of
                                        <?= $content->article_component; ?> - (
                                        <?= $content->content; ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>

                        <div class="fw-bold">Article Component *</div>

                        <select class="form-select" name="article_type" id="articleType">
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
    <!-- eof revision modal -->


</div>

<?= $this->section('javascript'); ?>
<!-- <script type="text/javascript" src="<? //= base_url(); 
?>js/submission.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>js/addRevision.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/authorReply.js"></script>

<?= $this->endSection(); ?>

<?= $this->endSection(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Reviewer Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<div class="container-fluid">

    <!-- check consent status -->
    <?php if (!$status): ?>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#peerConsent").modal("show");
            });
        </script>

        <!-- error modal bof -->
        <!-- <div class="modal" tabindex="-1" id="peerConsent" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ">Request to Review</h5>

                    </div>
                    <div class="modal-body">
                        <h6 class="modal-title p-2"><?//= $peerTerms->title; ?></h6>
                        <div class="p-2">
                            <?//= $peerTerms->message; ?>

                        </div>
                        <form id="peerConsentForm" action="../../accept" method="POST" enctype="multipart/form-data">

                            <div class="alert alert-warning">

                                <b>Completion date: </b>
                                <?//= date("l jS \of F Y ", strtotime($completion_date)); ?>

                            </div>
                            <div class="form-check">
                                <input type="hidden" name="reviewTableId" value="<?//= $reviewTableId ?>" />
                                <input type="hidden" name="submission_id" value="<?//= $submission_id ?>" />
                                <input type="radio" value="2" id="accept" name="consent">
                                <label class="form-check-label fw-bold" for="accept">
                                    Accept
                                </label>
                            </div>
                            </br>
                            <div class="form-check">
                                <input type="radio" value="7" id="decline" name="consent">
                                <label class="form-check-label fw-bold" for="decline">
                                    Decline
                                </label>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div> -->
        <!-- error modal eof -->
    <?php endif; ?>

    <!-- check consent status eof -->

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-24" style="text-transform: capitalize;">
                    <?= $details->title; ?>
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
                        <?= $details->prefix; ?>
                    </p>


                    <h4 class="card-title font-size-14"><b>Subtitle</b></h4>
                    <p>
                        <?= $details->subtitle; ?>
                    </p>

                    <h4 class="card-title font-size-14"><b>Abstract</b></h4>
                    <p>
                        <?= $details->abstract; ?>
                    </p>
                    <?php if (isset($details->showIdentity)): ?>
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
                                    <?php if ($submission->contributor): ?>
                                        <?php foreach ($submission->contributor as $contributor): ?>
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

                    <?php endif; ?>
                    <h4 class="card-title font-size-14"><b>Language</b></h4>
                    <p>
                        <?= $details->language; ?>
                    </p>

                    <h4 class="card-title font-size-14"><b>Keyword</b></h4>
                    <p>
                        <?= $details->keyword; ?>
                    </p>

                    <h4 class="card-title font-size-14"><b>References</b></h4>
                    <p>
                        <?= $details->reference; ?>
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
                                    <th>Download</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if ($details->reviewContents): ?>
                                    <?php foreach ($details->reviewContents as $content): ?>
                                        <tr>
                                            <td data-label="Component">
                                                <?= $content->article_component; ?>
                                            </td>
                                            <td data-label="Filename">
                                                <?= $content->content; ?>
                                            </td>
                                            <td data-label="Filename">
                                                <?= anchor('author/downloads/' . $content->content, '<span class="btn1 btn-success">download</span>'); ?>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <div class="mb-0" style="float: right;">
                        <div>

                            <?= anchor('peer/downloadZip/' . $details->submissionID, '<span class="btn btn-primary waves-effect waves-light me-1">Downloads</span>'); ?>

                        </div>
                    </div>

                </div>

            </div>



        </div>

        <div class="col-xl-4">
            <div class="card">
                <h5 class="card-title p-2 text-center">Update review status</h5>
                <div class="card-body">
                    <div id="msg"></div>
                    <form id="<?= $details->submissionID; ?>" method="POST" action="updateStatus">
                        <input type="hidden" name="submissionid" value="<?= $details->submissionID; ?>">
                        <!-- <div class="d-flex justify-content-start"> -->
                        <div class="form-check">
                            <?php if ($details->status == 2 || $details->status == 3): ?>


                                <?= anchor('peer/finalupload/' . $details->submissionID . '/' . $reviewTableId, 'Upload final file & submit to complete', 'class="btn btn-primary"'); ?>

                            <?php endif; ?>

                        </div>


                        <!-- </div> -->
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- discussion bof -->
    <div class="row">
        <div id="msg"></div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <?php if (!$discussions): ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#peerModal"
                            data-arridx="<?= $editor->userID . '/' . $editor->email . '/' . $submission_id . '/start discussion'; ?>">
                            Start Discussion
                        </button>
                    <?php endif; ?>


                    <?php if ($discussions): ?>
                        <?php foreach ($discussions as $key => $discussion): ?>


                            <div class="card-body">
                                <div class="d-flex mb-4">
                                    <img class="me-3 rounded-circle avatar-sm"
                                        src="<?= base_url(); ?>assets/images/users/avatar-1.jpg"
                                        alt="Generic placeholder image">
                                    <div class="flex-1">
                                        <h5 class="font-size-14 my-1">
                                            <?= $discussion->sender; ?>
                                        </h5>
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

                                <h4 class="font-size-16">
                                    <?= $discussion->title; ?>
                                </h4>
                                <?php if ($discussion->recommondation): ?>
                                    <h6>
                                        Recommendation: <?= $discussion->recommondation; ?>
                                    </h6>
                                <?php endif; ?>
                                <p>
                                    <?= $discussion->message; ?>
                                </p>
                                <?php if ($discussion->file): ?>
                                    <h6>Attachment</h6>
                                    Article component:
                                    <?= $discussion->article_component; ?>
                                    <p>
                                        <?= anchor('editor/downloads/' . $discussion->file, $discussion->file); ?>
                                    </p>
                                <?php endif; ?>

                                <hr />



                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-arridx="<?= $editor->userID . '/' . $editor->email . '/' . $discussion->submissionID . '/' . $discussion->title; ?>"
                                    data-role="3" data-bs-target="#peerModal">
                                    <i class="mdi mdi-reply"></i>Reply
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- discussion eof -->

    <!-- PEER/ reply Modal bof inserting in to notifications table-->
    <div class="modal fade" id="peerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="peerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="revisionModalLabel">Discussion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div id="editor"></div>
                    <form id="peerReplyForm" action="../../notify" method="POST" enctype="multipart/form-data">
                        <div>
                            <div class="fw-bold">Recommendation *</div>

                            <select class="form-select" name="recommondation" id="recommondation">
                                <option selected="true" disabled="disabled">Choose One</option>
                                <option value="Accept Submission">Accept Submission</option>
                                <option value="Revisions Required">Revisions Required</option>
                                <option value="Resubmit for Review">Resubmit for Review</option>
                                <option value="Resubmit Elsewhere">Resubmit Elsewhere</option>
                                <option value="Decline Submission">Decline Submission</option>
                                <option value="See Comments">See Comments</option>
                            </select>
                        </div>
                        <input type="hidden" name="role" id="role" value="4" />

                        <div class="mb-3">
                            <label for="subject-title" class="col-form-label">Subject:*</label>
                            <input type="text" class="form-control" id="subject-title" name="subject-title" required>
                            <input type="hidden" name="submissionID" id="submission" value="">
                            <input type="hidden" name="recipient" id="recipient" value="">
                            <input type="hidden" name="recipient_id" id="recipient_id" value="">
                            <!-- <input type="hidden" name="authorName" id="authorName" value=""> -->
                            <!-- <input type="hidden" name="role" value="<? //= $role; 
                            ?>" /> -->
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text" name="message-text" required></textarea>
                        </div>
                        <!-- <h3>File attachment</h3>
                        <div class="fw-bold">Revision file? *</div>
                        <select class="form-select" name="updateFileId" id="updateFileId">
                            <option value="0">This is not a revision of an existing file</option>

                            <?php //if ($contents) : 
                            ?>
                                <?php //foreach ($contents as $content) : 
                                ?>
                                    <option value="<? //= $content->id; 
                                    ?>">Revision of <? //= $content->article_component; 
                                    ?> - (<? //= $content->content; 
                                     ?>) </option>
                                <?php //endforeach; 
                                ?>
                            <?php //endif; 
                            ?>

                        </select> -->

                        <div class="fw-bold">Article Component ( Optional )</div>

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
    <!-- eof PEER/REPLY modal -->

</div>
<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/peer.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
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

            <!-- validation bof -->
            <?php if (isset($validation)): ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors(); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getTempdata('error')): ?>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $("#peerError").modal("show");
                    });
                </script>

                <!-- error modal bof -->
                <div class="modal" tabindex="-1" id="peerError">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title ">Sent response</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body alert alert-danger">
                                <p>
                                    <?= session()->getTempdata('error'); ?>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- error modal eof -->
            <?php endif; ?>
            <?php if (session()->getTempdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getTempdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- validation eof -->
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
                                    <th>Download</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if ($contents): ?>
                                    <?php foreach ($contents as $content): ?>
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

                    <div style="float: left;">

                        <?= anchor('editor/editor_upload/' . $submission->submissionID, '<span class="btn btn-primary waves-effect waves-light me-1">Upload files</span>'); ?>

                    </div>
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


                        <?php if ($submission->status_id == 0 && !$sentMessages): ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-primary " style="padding: 0.6rem 58px;border-radius: 5px;">
                                    <i class="fa fa-send-o"></i>
                                    Submitted
                                </span>
                            </div>
                        <?php endif; ?>
                        <!-- $submission->status_id == 0 -->
                        <?php if ($sentMessages && $peerStatus < 3): ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-warning  waves-light" style="padding: 0.6rem 13px;border-radius: 5px;">
                                    <i class="fa fa-search"></i>&nbsp; Pre-Review Discussions
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($submission->status_id < 1): ?>
                            <div class="list-group-item" role="alert">
                                <form method="POST" action="../toreview">
                                    <input type="hidden" name="submissionid" value="<?= $submission->submissionID; ?>" />
                                    <input type="hidden" name="title" value="<?= $submission->title; ?>" />

                                    <button class="btn btn-warning waves-effect waves-light" submit="button"
                                        style="padding: 0.47rem 43px;">
                                        <i class="fa fa-search"></i>&nbsp;Send to review
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php if ($peerStatus == 1): ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-secondary  waves-light" style="padding: 0.6rem 36px;border-radius: 5px;">
                                    <i class="fa fa-search"></i>&nbsp; Sent to Reviewer
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($peerStatus > 1 && $peerStatus < 4): ?>
                            <div class="list-group-item" role="alert">
                                <?= anchor('editor/requestrevision/' . $submission->submissionID, '<span class="btn-dark waves-light" style="padding: 0.47rem 36px; border-radius: 5px;"><i class="fa fa-send-o"></i>&nbsp;Request revision</span>'); ?>
                            </div>
                        <?php endif; ?>


                        <?php if ($peerStatus > 1 && $peerStatus < 3): ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-danger waves-light" style="padding: 0.47rem 56px; border-radius: 5px;">
                                    <i class="fa fa-comments"></i>&nbsp; In Review

                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($peerStatus == 3): ?>
                            <div class="list-group-item" role="alert">
                                <span class="btn-success waves-light" style="padding: 0.47rem 31px; border-radius: 5px;">
                                    <i class="fa fa-comments"></i>&nbsp; Review completed

                                </span>
                            </div>

                        <?php endif; ?>



                        <?php if ($submission->status_id == 20): ?>
                            <div class="list-group-item" role="alert">
                                <button type="button" class="btn btn-danger waves-effect waves-light"
                                    style="padding: 0.47rem 56px;">
                                    <i class="fa fa-comments"></i>&nbsp; Rejected
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if ($submission->status_id == 4): ?>

                            <div class="list-group-item" role="alert">
                                <form method="POST" action="../tocopyedit">
                                    <!-- <form method="POST" action="../tocpeditor"> -->

                                    <input type="hidden" name="submissionid" value="<?= $submission->submissionID; ?>" />
                                    <input type="hidden" name="title" value="<?= $submission->title; ?>" />

                                    <button class="btn btn-dark waves-effect waves-light" submit="button"
                                        style="padding: 0.47rem 23px;">
                                        <i class="fa fa-search"></i>&nbsp;Send To Copy Editing
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php if ($submission->status_id == 5): ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-secondary waves-light" style="padding: 0.47rem 27px; border-radius: 5px;">
                                    <i class="fas fa-edit"></i>&nbsp; Sent To Copy Editing
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ($submission->status_id == 6): ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-danger waves-light" style="padding: 0.47rem 27px; border-radius: 5px;">
                                    <i class="fas fa-edit"></i>&nbsp; Under Copy Editing
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ($submission->status_id == 7): ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-success waves-light" style="padding: 0.47rem 12px; border-radius: 5px;">
                                    <i class="fas fa-edit"></i>&nbsp; Copy Editing completed
                                </span>

                            </div>
                            <?php if (!is_array($editorialDecision) && !isset($editorialDecision->status)): ?>

                                <div class="list-group-item" role="alert">
                                    <?= anchor('editor/accepted_copyediting/' . $submission->submissionID . '/' . 8, '<span class="btn-dark waves-light" style="padding: 0.47rem 34px; border-radius: 5px;"><i class="fa fa-comments"></i>&nbsp; Accept & proceed</span>'); ?>
                                </div>
                            <?php endif; ?>

                        <?php endif; ?>


                        <?php if (isset($editorialDecision->status)): ?>
                            <?php if ($editorialDecision->status == 8 && $submission->status_id == 8): ?>

                                <form method="POST" action="../toproduction">
                                    <input type="hidden" name="submissionid" value="<?= $submission->submissionID; ?>" />
                                    <input type="hidden" name="title" value="<?= $submission->title; ?>" />

                                    <button type="submit" class="btn btn-dark waves-effect waves-light"
                                        style="padding: 0.47rem 54px;">
                                        <i class="fa fa-area-chart"></i>&nbsp;Send to Production
                                    </button>
                                </form>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if ($submission->status_id == 9): ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-secondary waves-light" style="padding: 0.47rem 54px;">
                                    <i class="fa fa-area-chart"></i>&nbsp; Sent to Production
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ($submission->status_id == 10): ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-danger waves-light" style="padding: 0.47rem 54px;">
                                    <i class="fa fa-area-chart"></i>&nbsp; Under Production
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($submission->status_id == 11): ?>
                            <div class="list-group-item" role="alert">
                                <span class=" btn-success waves-light" style="padding: 0.47rem 54px;">
                                    <i class="fa fa-area-chart"></i>&nbsp; Production complted
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($submission->status_id == 11): ?>

                            <div class="list-group-item" role="alert">
                                <?= anchor('editor/accepted_production/' . $submission->submissionID . '/' . 12, '<span class="btn-dark waves-light" style="padding: 0.50rem 65px; border-radius: 5px;"><i class="fa fa-comments"></i>&nbsp; Accept & proceed</span>'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- Assigned peers bof -->

                <div class="card">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="card-title"> Sent/Assigned to Reviewers</h4>

                            <?php if ($peerAssigned): ?>
                                <?php foreach ($peerAssigned as $peers): ?>

                                    <div>
                                        <?php if ($peers->status == 1): ?>
                                            <?= anchor('editor/getAssignedPeer/' . $peers->reviewID, $peers->title . ' ' . $peers->username . ' ' . $peers->middle_name . ' ' . $peers->last_name); ?>
                                            <span class="bg-secondary text-white"> -> sent to reviewer -</span>
                                        <?php elseif ($peers->status == 2): ?>
                                            <?= anchor('editor/getAssignedPeer/' . $peers->reviewID, $peers->title . ' ' . $peers->username . ' ' . $peers->middle_name . ' ' . $peers->last_name); ?>
                                            <span class="bg-danger text-white "> -> in review -</span>

                                        <?php elseif ($peers->status >= 3 && $peers->status < 20): ?>
                                            <?= anchor('editor/getAssignedPeer/' . $peers->reviewID, $peers->title . ' ' . $peers->username . ' ' . $peers->middle_name . ' ' . $peers->last_name); ?>
                                            <span class="bg-success text-white"> -> completed - </span>
                                        <?php elseif ($peers->status == 20): ?>
                                            <?= anchor('editor/getAssignedPeer/' . $peers->reviewID, $peers->title . ' ' . $peers->username . ' ' . $peers->middle_name . ' ' . $peers->last_name); ?>
                                            <span class="bg-danger text-white"> -> rejected - </span>
                                        <?php endif; ?>


                                    </div>

                                <?php endforeach; ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Assigned peers eof  -->

                <!-- bof copyeditor files -->
                <div class="card">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="card-title">Copy-editor disscusion files</h4>

                            <?php if ($cpEditorDiscussions): ?>
                                <?php foreach ($cpEditorDiscussions as $copyfile): ?>
                                    <?php if ($copyfile->file): ?>
                                        <div>
                                            <?= anchor('editor/downloads/' . $copyfile->file, $copyfile->file); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?= anchor('editor/downloadpeerZip/' . $cpEditorDiscussions[0]->submissionID, '<span class="btn1 btn-success">downloads</span>'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- eof copyeditor files -->


                <!-- bof copyeditor final files -->
                <div class="card">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="card-title">Copy-editor final uploads</h4>
                            <?php if ($copyEditorUploads): ?>
                                <?= anchor('editor/downloadcopyEditorZip/' . $submission->submissionID, '<span class="btn1 btn-success">downloads</span>'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- eof copyeditor final files -->

                <!-- bof Production final files -->
                <div class="card">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="card-title">Production final uploads</h4>
                            <?php if ($productionUploads): ?>
                                <?= anchor('editor/downloadproductionZip/' . $submission->submissionID, '<span class="btn1 btn-success">downloads</span>'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- eof production final files -->
                <!-- bof editorieal history  -->
                <div class="card">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="card-title">Editorial history</h4>
                            <?php if ($editorialHistory['notifications']): ?>
                                <?php foreach ($editorialHistory as $history): ?>
                                    <?php foreach ($history as $notifications): ?>
                                        <ul>
                                            <li>From : <?= $notifications['sender']; ?> To <?= $notifications['recipient']; ?>
                                            </li>
                                            <span><?= $notifications['title']; ?></span>
                                        </ul>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                                <?= anchor('editor/editorialhistory/' . $editorialHistory['notifications'][0]['submissionID'], '<span class="btn1 btn-success">More</span>'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- eof editorial history  -->
            </div>
        </div>
        <!-- end col -->

    </div>

    <!-- end row -->

    <div class="row">
        <div id="msg"></div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <!-- accordion -->
                    <div class="accordion" id="accordionEditor">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingAuthor">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Pre-Review Discussion
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingAuthor" data-bs-parent="#accordionEditor">
                                <div class="accordion-body">

                                    <?php //if (!$sentMessages): ?>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#revisionModal">
                                        Start Discussion
                                    </button>
                                    <?php //endif; ?>

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

                                                            <!-- Editorial Co-ordinator -->

                                                            <?= date("l jS \of F Y h:i:s A", strtotime($discussion->date_created)); ?>
                                                        </small>

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
                                                        <?= anchor('editor/downloads/' . $discussion->file, $discussion->file); ?>
                                                    </p>
                                                <?php endif; ?>

                                                <hr />



                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-role="3" data-bs-target="#revisionModal">
                                                    <i class="mdi mdi-reply"></i>Reply
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <!-- copy-editor disscusson bof -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingCopyeditor">
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Copy-editor Discussion
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingCopyeditor" data-bs-parent="#accordionEditor">
                                <div class="accordion-body">


                                    <?php if (!$cpEditorDiscussions): ?>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#copyeditorModal">
                                            Start Discussion
                                        </button>
                                    <?php endif; ?>


                                    <?php if ($cpEditorDiscussions): ?>
                                        <?php foreach ($cpEditorDiscussions as $key => $discussion): ?>


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
                                                    data-bs-target="#copyeditorModal">
                                                    <i class="mdi mdi-reply"></i>Reply
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>


                            </div>
                        </div>
                        <!-- copy-editor disscusson eof -->
                        <!-- publisher disscusion bof -->

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPublisher">
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Publisher Discussion
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="headingPublisher" data-bs-parent="#accordionEditor">
                                <div class="accordion-body">


                                    <?php if (!$publisherDiscussions): ?>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#copyeditorModal">
                                            Start Discussion
                                        </button>
                                    <?php endif; ?>


                                    <?php if ($publisherDiscussions): ?>
                                        <?php foreach ($publisherDiscussions as $key => $discussion): ?>


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
                                                    data-bs-target="#publisherModal">
                                                    <i class="mdi mdi-reply"></i>Reply
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>


                            </div>
                        </div>

                        <!-- publisher discussion eof -->

                    </div><!-- accordion eof -->


                    <!-- publisher reply modal bof inserting into notifications table -->

                    <div class="modal fade" id="publisherModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="publisherModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="publisherModalLabel">Discussion</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Add revision copy-editor</h5>

                                    <div id="editor"></div>
                                    <form id="publisherReplyForm" action="../notify" method="POST"
                                        enctype="multipart/form-data">


                                        <input type="hidden" name="role" id="role" value="6" />

                                        <div class="mb-3">
                                            <label for="subject-title" class="col-form-label">Subject:*</label>
                                            <input type="text" class="form-control" id="subject-title"
                                                name="subject-title" required>
                                            <?php if ($publisher): ?>
                                                <input type="hidden" name="submissionID" value="<?= $submission_id; ?>" />
                                                <input type="hidden" name="recipient" value="<?= $publisher->email; ?>" />
                                                <input type="hidden" name="recipient_id"
                                                    value="<?= $publisher->userID; ?>" />
                                                <input type="hidden" name="authorName"
                                                    value="<?= $publisher->title . ' ' . $publisher->middle_name . ' ' . $publisher->last_name; ?>" />
                                                <!-- <input type="hidden" name="role" value="<? //= $role; 
                                                    ?>" /> -->
                                            <?php endif; ?>
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

                                            <?php if ($contents): ?>
                                                <?php foreach ($contents as $content): ?>
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
                    <!-- publisher ready modal eof inserting into notifications table -->
                    <!-- COPY-EDITOR/ reply Modal bof inserting in to notifications table-->
                    <div class="modal fade" id="copyeditorModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="copyeditorModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="copyeditorModalLabel">Discussion</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Add revision copy-editor</h5>

                                    <div id="editor"></div>
                                    <form id="copyEditorReplyForm" action="../notify" method="POST"
                                        enctype="multipart/form-data">


                                        <input type="hidden" name="role" id="role" value="5" />

                                        <div class="mb-3">
                                            <label for="subject-title" class="col-form-label">Subject:*</label>
                                            <input type="text" class="form-control" id="subject-title"
                                                name="subject-title" required>
                                            <?php if ($copyeditor): ?>
                                                <input type="hidden" name="submissionID" value="<?= $submission_id; ?>" />
                                                <input type="hidden" name="recipient" value="<?= $copyeditor->email; ?>" />
                                                <input type="hidden" name="recipient_id"
                                                    value="<?= $copyeditor->userID; ?>" />
                                                <input type="hidden" name="authorName"
                                                    value="<?= $copyeditor->title . ' ' . $copyeditor->middle_name . ' ' . $copyeditor->last_name; ?>" />
                                                <!-- <input type="hidden" name="role" value="<? //= $role; 
                                                    ?>" /> -->
                                            <?php endif; ?>
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

                                            <?php if ($contents): ?>
                                                <?php foreach ($contents as $content): ?>
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
                    <!-- eof COPY- EDITOR /REPLY modal -->



                    <!-- revison/ reply Modal bof-->
                    <div class="modal fade" id="revisionModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="revisionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="revisionModalLabel">Discussion</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Add revision</h5>

                                    <div id="editor"></div>
                                    <form id="revisionForm" action="../notify" method="POST"
                                        enctype="multipart/form-data">


                                        <input type="hidden" name="role" id="role" value="" />

                                        <div class="mb-3">
                                            <label for="subject-title" class="col-form-label">Subject:*</label>
                                            <input type="text" class="form-control" id="subject-title"
                                                name="subject-title" required>
                                            <input type="hidden" name="submissionID" value="<?= $submission_id; ?>" />
                                            <input type="hidden" name="recipient" value="<?= $authorEmail; ?>" />
                                            <input type="hidden" name="recipient_id" value="<?= $userid; ?>" />
                                            <input type="hidden" name="authorName" value="<?= $authorName; ?>" />
                                            <input type="hidden" name="role" value="<?= $role; ?>" />
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

                                            <?php if ($contents): ?>
                                                <?php foreach ($contents as $content): ?>
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
                    <!-- eof revision/reply modal -->
                    <!-- bof peer discuss Modal -->
                    <div class="modal fade" id="discussModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="discussModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="discussModalLabel">Discussion</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form id="discussForm" action="../peerDiscussion" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="title" class="col-form-label">Title <span
                                                    class="redstar">*</span></label>
                                            <input type="text" class="form-control" id="title" name="title">
                                            <input type="hidden" id="subId" name="subId" value="<?= $submission_id; ?>"
                                                </div>
                                            <div class="mb-3">
                                                <label for="message" class="col-form-label">Message <span
                                                        class="redstar">*</span></label>
                                                <textarea class="form-control" id="message" name="message"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editorfile" class="col-form-label">Upload </label>
                                                <input type="file" class="form-control" id="editorfile"
                                                    name="editorfile">
                                            </div>


                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Send</button>

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
    <script type="text/javascript" src="<?= base_url(); ?>js/publisherDiscussion.js"></script>


    <?= $this->endSection(); ?>
    <?= $this->endSection(); ?>
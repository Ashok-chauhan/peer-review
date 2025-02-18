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
                <h4 class="mb-sm-0 font-size-24">Submission</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                <span class="d-block d-sm-none">My Queue</span>
                                <span class="d-none d-sm-block">My Queue</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                <span class="d-block d-sm-none">Archive</span>
                                <span class="d-none d-sm-block">Archive</span>
                            </a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <?php if (isset($list)): ?>

                            <div class="tab-pane active" id="home1" role="tabpanel">

                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-editable table-nowrap align-middle table-edits">
                                            <tbody>
                                                <?php foreach ($list as $key => $row): ?>

                                                    <?php $revId = $row->submissionID; ?>


                                                    <tr>
                                                        <td width="10%">
                                                            <?= $row->submissionID; ?>
                                                        </td>

                                                        <td width="70%">

                                                            <!-- style="font-size:12px;color:red" -->
                                                            <h4 class="card-title font-size-20 mb-2">
                                                                <?= $row->title; ?> <sup style="font-size:12px;"><i
                                                                        class="fa fa-bell" aria-hidden="true"></i></sup>
                                                            </h4>
                                                            <div>
                                                                <p class="card-title1 font-size-14 mb-2">Submitted by:
                                                                    <?= $row->author; ?>
                                                                </p>

                                                                <?php if ($row->coauthor): ?>
                                                                    <?php $number = count($row->coauthor); ?>
                                                                    <?php foreach ($row->coauthor as $key => $coauthor): ?>
                                                                        <?php if ($coauthor->primary_contact): ?>
                                                                            <span class="font-size-14 fw-bolder mb-2">
                                                                                <?php $pname = $coauthor->title . ' ' . $coauthor->name . ' ' . $coauthor->m_name . ' ' . $coauthor->l_name;
                                                                                if ($key == $number - 1) {
                                                                                    echo $pname;
                                                                                } else {
                                                                                    echo $pname . ', ';
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                        <?php else: ?>
                                                                            <?php $name = $coauthor->title . ' ' . $coauthor->name . ' ' . $coauthor->m_name . ' ' . $coauthor->l_name;
                                                                            if ($key == $number - 1) {
                                                                                echo $name;
                                                                            } else {
                                                                                echo $name . ', ';
                                                                            }
                                                                            ?>

                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>

                                                            </div>
                                                            <button type="button"
                                                                class="btn2 btn-outline-primary waves-effect waves-light mb-2">Submitted
                                                                on:
                                                                <?= $row->submission_date; ?>

                                                            </button>
                                                        </td>

                                                        <td width="15%">
                                                            <!-- <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mb-2"> -->
                                                            <?php if ($row->revision_round): ?>
                                                                <span class="btn-dark waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-send-o"></i>&nbsp;Revision
                                                                    <?= $row->revision_round; ?> submitted </span>
                                                            <?php endif; ?>
                                                            <?php if ($row->status_id == 0 && $row->preReview == ''): ?>
                                                                <span class="btn-primary "
                                                                    style="padding: 0.6rem 58px;border-radius: 50px;">
                                                                    <i class="fa fa-send-o"></i>
                                                                    Submitted
                                                                </span>
                                                            <?php elseif ($row->preReview && $row->peerStatus == ''): ?>

                                                                <span class="btn-warning  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-search"></i>&nbsp; Pre-Review Discussions
                                                                </span>
                                                            <?php elseif ($row->peerStatus == 1): ?>

                                                                <span class="btn-secondary  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp; Sent to reviewer
                                                                </span>
                                                            <?php elseif ($row->peerStatus == 2): ?>

                                                                <span class="btn-danger  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp; In Review
                                                                </span>
                                                            <?php elseif ($row->peerStatus == 3): ?>
                                                                <span class="btn-success waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <!-- <i class="fa fa-area-chart"></i>&nbsp; Completed -->
                                                                    <i class="fa fa-comments"></i>&nbsp; Review submitted
                                                                </span>

                                                            <?php elseif ($row->peerStatus == 4): ?>
                                                                <span class="btn-dark  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp;Send Copy Editor
                                                                    <!-- Accept & proceed -->
                                                                </span>
                                                            <?php elseif ($row->peerStatus == 5): ?>
                                                                <span class="btn-secondary  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fas fa-edit"></i>&nbsp;Sent to Copy Editor
                                                                </span>
                                                            <?php elseif ($row->status_id == 6): ?>
                                                                <span class="btn-danger  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fas fa-edit"></i>&nbsp;Under copy editing
                                                                </span>
                                                            <?php elseif ($row->status_id == 7): ?>
                                                                <span class="btn-success  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fas fa-edit"></i>&nbsp; Copy Editing completed
                                                                </span>
                                                            <?php elseif ($row->status_id == 8): ?>
                                                                <span class="btn-dark  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp; Accept & proceed
                                                                </span>
                                                            <?php elseif ($row->status_id == 9): ?>
                                                                <span class="btn-secondary  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp; Sent to production
                                                                </span>
                                                            <?php elseif ($row->status_id == 10): ?>
                                                                <span class="btn-danger  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp; Under production
                                                                </span>
                                                            <?php elseif ($row->status_id == 11): ?>
                                                                <span class="btn-success  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp; Production completed
                                                                </span>
                                                            <?php elseif ($row->status_id == 12): ?>
                                                                <span class="btn-secondary  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp;Accept Production
                                                                </span>


                                                            <?php elseif ($row->peerStatus == 20): ?>
                                                                <span class="btn-danger  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp;Rejected
                                                                </span>
                                                            <?php endif; ?>
                                                            <!-- </button> -->
                                                            <p></p>
                                                            <?php if (isset($row->notification)): ?>
                                                                <p><i class='far fa-comment'></i>
                                                                    <?= $row->notification; ?>
                                                                </p>
                                                            <?php else: ?>
                                                                <p><i class='far fa-comment'></i>0</p>
                                                            <?php endif; ?>
                                                        </td>

                                                        <!-- <td width="5%"><button class="btn1 btn-success" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg<? //= $key; 
                                                                ?>"> <i class="fa fa-eye"></i> <? //= $row->submissionID; 
                                                                        ?></button></td> -->
                                                        <td width="5%">
                                                            <?= anchor('editor/byauthor/' . $row->submissionID, '<span class="btn1 btn-success"><i class="fa fa-eye"></i></span>'); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>

                                        </table>
                                    </div>

                                </div>

                            </div>
                        <?php endif; ?>
                        <div class="tab-pane" id="profile1" role="tabpanel">
                            <?php if ($completed): ?>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-editable table-nowrap align-middle table-edits">

                                            <tbody>
                                                <?php foreach ($completed as $key => $row): ?>
                                                    <?php $revId = $row->submissionID; ?>

                                                    <tr>
                                                        <td width="10%">
                                                            <?= $row->submissionID; ?>
                                                        </td>

                                                        <td width="70%">
                                                            <h4 class="card-title font-size-20 mb-2">
                                                                <?= $row->title; ?> <sup style="font-size:12px;"><i
                                                                        class="fa fa-bell" aria-hidden="true"></i></sup>
                                                            </h4>
                                                            <div>
                                                                <h4 class="card-title1 font-size-14 mb-2">
                                                                    <?= $row->author; ?>
                                                                </h4>
                                                                <?php if ($row->coauthor): ?>
                                                                    <?php foreach ($row->coauthor as $coauthor): ?>
                                                                        <?= $coauthor->title . ' ' . $coauthor->name . ' ' . $coauthor->m_name . ' ' . $coauthor->l_name . ', '; ?>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <!-- </h4> -->
                                                            <button type="button"
                                                                class="btn2 btn-outline-primary waves-effect waves-light mb-2">Submitted
                                                                on:
                                                                <?= $row->submission_date; ?>
                                                            </button>
                                                        </td>

                                                        <td width="15%">

                                                            <?php if ($row->status_id == 20): ?>
                                                                Rejectd
                                                            <?php endif; ?>

                                                        </td>

                                                        <td width="5%">
                                                            <?= anchor('editor/production/' . $row->submissionID, '<span class="btn1 btn-success"><i class="fa fa-eye"></i></span>'); ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            <?php endif; ?>
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
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
                <form id="revisionForm" action="revision" method="POST" enctype="multipart/form-data">



                    <div class="mb-3">
                        <label for="subject-title" class="col-form-label">Subject:*</label>
                        <input type="text" class="form-control" id="subject-title" name="subject-title">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text" name="message-text"></textarea>
                    </div>
                    <h3>File attachment</h3>

                    <div class="fw-bold">Article Component *</div>
                    <select class="form-select" name="article_type" id="article_type">
                        <option>Select article component</option>
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
<script type="text/javascript" src="<?= base_url(); ?>js/addRevision.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
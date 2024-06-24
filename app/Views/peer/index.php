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
                        <?php if (is_array($list) && count($list) > 0): ?>

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

                                                            <button type="button"
                                                                class="btn2 btn-outline-primary waves-effect waves-light mb-2">Submitted
                                                                on:
                                                                <?= $row->submission_date; ?>
                                                            </button>
                                                        </td>

                                                        <td>
                                                            <!-- <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mb-2"> -->
                                                            <?php if ($row->status == 1 && isset($row->notification) < 1): ?>
                                                                <span class="btn-primary "
                                                                    style="padding: 0.6rem 58px;border-radius: 50px;">
                                                                    <i class="fa fa-send-o"></i>
                                                                    Submitted
                                                                </span>
                                                            <?php elseif (isset($row->notification) && $row->status_id == 0): ?>
                                                                <span class="btn-warning  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-search"></i>&nbsp; Pre-Review Discussions
                                                                </span>
                                                            <?php elseif ($row->status >= 1 && $row->status < 3): ?>
                                                                <span class="btn-danger  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp; In Review
                                                                </span>
                                                            <?php elseif ($row->status == 3): ?>
                                                                <span class="btn-success waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-area-chart"></i>&nbsp; Completed
                                                                </span>
                                                            <?php elseif ($row->status == 20): ?>
                                                                <span class="btn-danger  waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-comments"></i>&nbsp; You Declined
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

                                                        <td width="5%">
                                                            <?= anchor('peer/detailview/' . $row->submissionID . '/' . $row->reviewID, '<span class="btn1 btn-success"><i class="fa fa-eye"></i></span>'); ?>

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

                                                            <!-- </h4> -->
                                                            <button type="button"
                                                                class="btn2 btn-outline-primary waves-effect waves-light mb-2">Submitted
                                                                on:
                                                                <?= $row->submission_date; ?>
                                                            </button>
                                                        </td>

                                                        <td width="15%">
                                                            <!-- <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mb-2"> -->

                                                            <?php if ($row->status == 4): ?>
                                                                <span class="btn-success waves-light"
                                                                    style="padding: 0.6rem 13px;border-radius: 50px;">
                                                                    <i class="fa fa-area-chart"></i>&nbsp; Completed & accepted
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




</div>

<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/peer.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
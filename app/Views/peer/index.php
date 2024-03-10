<?php $page_session = \Config\Services::session(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Peer Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>



<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <?php if ($page_session->getTempdata("success")) : ?>
                        <div class="alert alert-success"><?= $page_session->getTempdata("success"); ?></div>
                    <?php endif; ?>

                    <?php if ($page_session->getTempdata("error")) : ?>
                        <div class="alert alert-danger"><?= $page_session->getTempdata("error"); ?></div>
                    <?php endif; ?>
                    <!-- <div class="row"> -->

                    <h2><span class="badge bg-secondary">Contents to be reviewed</span></h2>


                    <!-- design -->
                    <!-- <div class="col-lg-12"> -->
                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <tbody>
                                <?php foreach ($reviews as $key => $row) : ?>

                                    <?php $revId = $row->submissionID; ?>

                                    <tr>


                                        <!-- <td width="70%"> -->
                                        <td>

                                            <!-- style="font-size:12px;color:red" -->
                                            <h4 class="card-title font-size-20 mb-2"><?= $row->title; ?> </h4>



                                            <button type="button" class="btn2 btn-outline-primary waves-effect waves-light mb-2">Submitted on: <?= $row->submission_date; ?></button>
                                        </td>

                                        <!-- <td width="15%"> -->
                                        <td>
                                            <!-- <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mb-2"> -->
                                            <?php if ($row->status_id == 0 && isset($row->notification) < 1) : ?>
                                                <span class="btn-primary " style="padding: 0.6rem 58px;border-radius: 50px;">
                                                    <i class="fa fa-send-o"></i>
                                                    Submitted
                                                </span>
                                            <?php elseif (isset($row->notification) && $row->status_id == 0) : ?>
                                                <span class="btn-warning  waves-light" style="padding: 0.6rem 13px;border-radius: 50px;">
                                                    <i class="fa fa-search"></i>&nbsp; Pre-Review Discussions
                                                </span>
                                            <?php elseif ($row->status_id >= 1 && $row->status_id < 3) : ?>
                                                <span class="btn-danger  waves-light" style="padding: 0.6rem 13px;border-radius: 50px;">
                                                    <i class="fa fa-comments"></i>&nbsp; In Review
                                                </span>
                                            <?php elseif ($row->status_id == 3) : ?>
                                                <span class="btn-success waves-light" style="padding: 0.6rem 13px;border-radius: 50px;">
                                                    <i class="fa fa-area-chart"></i>&nbsp; Completed
                                                </span>
                                            <?php elseif ($row->status_id == 4) : ?>
                                                <span class="btn-danger  waves-light" style="padding: 0.6rem 13px;border-radius: 50px;">
                                                    <i class="fa fa-comments"></i>&nbsp; Rejectd
                                                </span>
                                            <?php endif; ?>


                                            <!-- </button> -->
                                            <p></p>
                                            <?php if (isset($row->notification)) : ?>
                                                <p><i class='far fa-comment'></i><?= $row->notification; ?></p>
                                            <?php else : ?>
                                                <p><i class='far fa-comment'></i>0</p>
                                            <?php endif; ?>
                                        </td>



                                        <!-- <td width="5%"> -->
                                        <td>
                                            <?= anchor('peer/accept/' . $row->submissionID . '/' . $row->reviewID, '<span class="btn1 btn-success"><i class="fa fa-eye"></i></span>'); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>

                    <!-- </div> -->
                    <!-- desing -->


                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/peer.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
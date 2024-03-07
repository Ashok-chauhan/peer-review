<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container">
    <div class=" col-8 p-2 mx-auto">
        <p></p>

        <div class="list-group">

            <?php if (!$submissions): ?>
                <h3> No Submission files </h3>
            <?php endif; ?>
            <?php if ($submissions): ?>

                <h2><span class="badge bg-secondary"> All active </span></h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Date</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($submissions as $key => $submission): ?>

                            <?php if (isset($reviewStatus) && isset($reviewStatus[$key][0]->submissionID) == $submission->submissionID): ?>
                                <tr>

                                    <th scope="row"><?= $submission->submissionID; ?></th>
                                    <td class="fw-bold"><a href="<?= base_url(); ?>editor/byauthor/<?= $submission->submissionID; ?>"><?= $submission->title; ?></a> 

                                        <?php if ($reviewStatus[$key][0]->status == 1): ?>
                                            <span class="badge rounded-pill text-bg-warning">Sent to peer</span>
                                        <?php elseif ($reviewStatus[$key][0]->status == 2): ?>
                                            <span class="badge rounded-pill text-bg-info">Accepted, under review</span>
                                        <?php elseif ($reviewStatus[$key][0]->status == 3): ?>
                                            <span class="badge rounded-pill text-bg-success">Review completed</span>
                                        <?php elseif ($reviewStatus[$key][0]->status == 4): ?>
                                            <span class="badge rounded-pill text-bg-danger">Rejected</span>
                                        <?php endif; ?>
                                        <!--                                    copy-editor status-->
                                        <?php if (isset($editorialDecision[$key][0]->submissionID)): ?>
                                            <?php if ($editorialDecision[$key][0]->status == 1): ?>
                                                <span class="badge rounded-pill text-bg-warning">Sent to copy-editor</span>
                                            <?php elseif ($editorialDecision[$key][0]->status == 2): ?>
                                                <span class="badge rounded-pill text-bg-info">Accepted, under copy-edit</span>
                                            <?php endif; ?>
                                        <?php endif; ?>



                                    </td>
                                    <td><?= $submission->submission_date; ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <th scope="row"><?= $submission->submissionID; ?></th>
                                    <td class="fw-bold"><a href="<?= base_url(); ?>editor/byauthor/<?= $submission->submissionID; ?>"><?= $submission->title; ?></a></td>
                                    <td><?= $submission->submission_date; ?></td>
                                </tr>

                            <?php endif; ?>


                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </div>   
    </div>
</div><!-- comment -->

<?= $this->endSection(); ?>
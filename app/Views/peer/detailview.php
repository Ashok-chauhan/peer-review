<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Reviewer Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-24" style="text-transform: capitalize;"><?= $details->title; ?></h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">



                    <h4 class="card-title font-size-14"><b>Prefix</b></h4>
                    <p><?= $details->prefix; ?></p>


                    <h4 class="card-title font-size-14"><b>Subtitle</b></h4>
                    <p><?= $details->subtitle; ?></p>

                    <h4 class="card-title font-size-14"><b>Abstract</b></h4>
                    <p><?= $details->abstract; ?></p>
                    <?php if (isset($details->showIdentity)) : ?>
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

                    <?php endif; ?>
                    <h4 class="card-title font-size-14"><b>Language</b></h4>
                    <p><?= $details->language; ?> </p>

                    <h4 class="card-title font-size-14"><b>Keyword</b></h4>
                    <p><?= $details->keyword; ?></p>

                    <h4 class="card-title font-size-14"><b>References</b></h4>
                    <p><?= $details->reference; ?></p>



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
                                <?php if ($details->reviewContents) : ?>
                                    <?php foreach ($details->reviewContents as $content) : ?>
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

                            <?= anchor('editor/downloadZip/' . $details->submissionID, '<span class="btn btn-primary waves-effect waves-light me-1">Downloads</span>'); ?>

                        </div>
                    </div>

                </div>

            </div>



        </div>

        <div class="col-xl-4">
            <div class="card">
                <h5 class="card-title p-2">Update review status</h5>
                <div class="card-body">
                    <div id="msg"></div>
                    <form id="<?= $details->submissionID; ?>" method="POST" action="updateStatus">
                        <!-- <div class="d-flex justify-content-start"> -->
                        <div class="form-check">
                            <?php if ($details->status == 2) : ?>
                                <input class="checkmark" type="radio" value="2" id="accepted" name="radiobtn" onClick="radioCtr(2,<?= $details->reviewID; ?>);" checked>
                            <?php else : ?>
                                <input class="checkmark" type="radio" value="2" id="accepted" name="radiobtn" onClick="radioCtr(2,<?= $details->reviewID; ?>);">
                            <?php endif; ?>
                            <label class="form-check-label" for="radiobtn">
                                Accepted
                            </label>
                        </div>
                        <div class="form-check">
                            <?php if ($details->status == 3) : ?>
                                <input class="checkmark" type="radio" value="3" id="completed" name="radiobtn" onClick="radioCtr(3,<?= $details->reviewID; ?>);" checked>
                            <?php else : ?>
                                <input class="checkmark" type="radio" value="3" id="completed" name="radiobtn" onClick="radioCtr(3,<?= $details->reviewID; ?>);">
                            <?php endif; ?>

                            <label class="form-check-label" for="radiobtn">
                                Completed
                            </label>
                        </div>

                        <!-- </div> -->
                    </form>
                </div>
            </div>
        </div>


    </div>


</div>
<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/peer.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
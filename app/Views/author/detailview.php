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
                <h4 class="mb-sm-0 font-size-24" style="text-transform: capitalize;"><?= $submission->title; ?></h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">



                    <h4 class="card-title font-size-14"><b>Prefix</b></h4>
                    <p><?= $submission->prefix; ?> </p>


                    <h4 class="card-title font-size-14"><b>Subtitle</b></h4>
                    <p><?= $submission->subtitle; ?> </p>

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
                                <!-- <tr>
                                    <td data-label="Name"><? //= $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->last_name; 
                                                            ?></td>
                                    <td data-label="Email"><? //= $user->email; 
                                                            ?></td>
                                    <td data-label="Role">Author</td>
                                    <td data-label="Primary Contact"><input type="checkbox" disabled checked></td>
                                   
                                </tr> -->

                                <?php if ($coauthor) : ?>
                                    <?php foreach ($coauthor as $contributor) : ?>
                                        <tr>
                                            <td data-label="Name"><?= $contributor->title . ' ' . $contributor->name . ' ' . $contributor->m_name . ' ' . $contributor->l_name; ?></td>
                                            <td data-label="Email"><?= $contributor->email; ?></td>
                                            <?php if ($contributor->role == 3) : ?>
                                                <td data-label="Role">Author</td>
                                            <?php else : ?>
                                                <td data-label="Role">Translator</td>
                                            <?php endif; ?>
                                            <?php if ($contributor->primary_contact) : ?>
                                                <td data-label="Primary Contact"><input type="checkbox" disabled checked></td>
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
                    <p><?= $submission->language; ?></p>

                    <h4 class="card-title font-size-14"><b>Keyword</b></h4>
                    <p><?= $submission->keyword; ?> </p>

                    <h4 class="card-title font-size-14"><b>References</b></h4>
                    <p><?= $submission->reference; ?></p>

                    <h4 class="card-title font-size-14"><b>Comments for editor</b></h4>
                    <p><?= $submission->content; ?></p>

                    <h4 class="card-title font-size-14"><b>Article Component</b></h4>
                    <div class="col-lg-12">
                        <table id="datatable" class="table table-registration font-size-13 table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Component</th>
                                    <th>Filename</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if ($submission_content) : ?>
                                    <?php foreach ($submission_content as $content) : ?>
                                        <tr>
                                            <td data-label="Component"><?= $content->article_component; ?></td>
                                            <td data-label="Filename"><?= $content->content; ?></td>
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
                                'class' => 'btn btn-primary', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#revisionModal', 'onClick' => 'subId(' . $submission->submissionID . ')'
                            ]); ?>
                        </div>
                    </div>

                </div>




            </div>

        </div>
    </div>

    <!-- Modal -->
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
                    <form id="revisionForm" action="../revision" method="POST" enctype="multipart/form-data">



                        <div class="mb-3">
                            <label for="subject-title" class="col-form-label">Subject:*</label>
                            <input type="text" class="form-control" id="subject-title" name="subject-title">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text" name="message-text"></textarea>
                        </div>
                        <h3>File attachment</h3>
                        <div class="fw-bold">Revision file? *</div>
                        <select class="form-select" name="updateFileId" id="updateFileId">
                            <option value="0">This is not a revision of an existing file</option>

                            <?php if ($submission_content) : ?>
                                <?php foreach ($submission_content as $content) : ?>
                                    <option value="<?= $content->id; ?>"><?= $content->article_component; ?> - (<?= $content->content; ?>) </option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>

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
<!-- <script type="text/javascript" src="<? //= base_url(); 
                                            ?>js/submission.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>js/addRevision.js"></script>

<?= $this->endSection(); ?>

<?= $this->endSection(); ?>
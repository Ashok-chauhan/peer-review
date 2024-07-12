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
                    <div class="mb-0" style="float: right;">
                        <div>

                            <?= anchor('editor/downloadZip/' . $submission->submissionID, '<span class="btn btn-info waves-effect waves-light me-1">Downloads</span>'); ?>

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
                        <?php if ($submission->status_id > 1 && $submission->status_id < 3): ?>
                            <div class="list-group-item" role="alert">
                                <?= anchor('editor/requestrevision/' . $submission->submissionID, '<span class="btn-dark waves-light" style="padding: 0.47rem 36px; border-radius: 5px;"><i class="fa fa-send-o"></i>&nbsp;Request revision</span>'); ?>
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
                    </div>
                </div>
                <!-- reset all bof -->
                <div class="card">

                    <div class="card-body ">

                        <div class="">
                            <h4 class="card-title">Reset all </h4>

                            <code>This action will remove reviews files, copy-editing files and production files , so you can reinitiate from begining</code>
                            <form method="post" action="../reset_all">
                                <input type="hidden" name="submission_id" value="<?= $submission->submissionID; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return resetAll()">Reset
                                    all</button>


                            </form>

                        </div>
                    </div>
                </div>
                <!-- reset all eof-->

                <!-- bof publisher files -->
                <div class="card">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="card-title">Publisher's final file</h4>

                            <?php if ($publisher_final_file): ?>
                                <?php if (isset($publisher_final_file->title_page)): ?>
                                    <?php $f = $publisher_final_file->title_page; ?>
                                    <div>Title page
                                        <?= anchor('editor/downloads/' . $publisher_final_file->title_page, '<span class="btn1 btn-success">' . $publisher_final_file->title_page . '</span>'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($publisher_final_file->article_text)): ?>
                                    <?php $art = $publisher_final_file->article_text; ?>
                                    <div>Article text
                                        <?= anchor('editor/downloads/' . $publisher_final_file->article_text, '<span class="btn1 btn-success">' . $publisher_final_file->article_text . '</span>'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($publisher_final_file->article_file)): ?>

                                    <div><?= $publisher_final_file->article_type; ?>
                                        <?= anchor('editor/downloads/' . $publisher_final_file->article_file, '<span class="btn1 btn-success">' . $publisher_final_file->article_file . '</span>'); ?>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>

                        </div>
                        <div class="mt-3">
                            <div id="msg"></div>
                            <!-- <form> -->
                            <?php if ($submission->production_copy_send): ?>
                                <button type="button" class="btn btn-warning  btn-sm">Email sent to Authors</button>
                            <?php else: ?>
                                <button type="button" onclick="sendEmail(<?= $publisher_final_file->submission_id; ?>)"
                                    class="btn btn-info  btn-sm">Send email to
                                    Authors</button>
                            <?php endif; ?>

                            <!-- </form> -->
                        </div>
                    </div>
                </div>
                <!-- eof publisher files -->
                <!-- peer files -->
                <div class="card">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="card-title">Reviewer final files</h4>

                            <?php if ($peer_final_file): ?>
                                <?php if (isset($peer_final_file->title_page)): ?>
                                    <?php $f = $peer_final_file->title_page; ?>
                                    <div>Title page
                                        <?= anchor('editor/downloads/' . $peer_final_file->title_page, '<span class="btn1 btn-success">' . $peer_final_file->title_page . '</span>'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($peer_final_file->article_text)): ?>
                                    <?php $art = $peer_final_file->article_text; ?>
                                    <div>Article text
                                        <?= anchor('editor/downloads/' . $peer_final_file->article_text, '<span class="btn1 btn-success">' . $peer_final_file->article_text . '</span>'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($peer_final_file->article_file)): ?>

                                    <div><?= $peer_final_file->article_type; ?>
                                        <?= anchor('editor/downloads/' . $peer_final_file->article_file, '<span class="btn1 btn-success">' . $peer_final_file->article_file . '</span>'); ?>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- eof peer files -->

                <!-- bof copyeditor files -->
                <div class="card">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="card-title">Copy-editor final files</h4>

                            <?php if ($copyeditor_final_file): ?>
                                <?php if (isset($copyeditor_final_file->title_page)): ?>
                                    <?php $f = $copyeditor_final_file->title_page; ?>
                                    <div>Title page
                                        <?= anchor('editor/downloads/' . $copyeditor_final_file->title_page, '<span class="btn1 btn-success">' . $copyeditor_final_file->title_page . '</span>'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($copyeditor_final_file->article_text)): ?>
                                    <?php $art = $copyeditor_final_file->article_text; ?>
                                    <div>Article text
                                        <?= anchor('editor/downloads/' . $copyeditor_final_file->article_text, '<span class="btn1 btn-success">' . $copyeditor_final_file->article_text . '</span>'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($copyeditor_final_file->article_file)): ?>

                                    <div><?= $copyeditor_final_file->article_type; ?>
                                        <?= anchor('editor/downloads/' . $copyeditor_final_file->article_file, '<span class="btn1 btn-success">' . $copyeditor_final_file->article_file . '</span>'); ?>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
                <!-- eof copyeditor files -->
                <!-- bof editorieal history  -->
                <!-- <div class="card">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="card-title">Editorial history</h4>
                            <?php //if ($editorialHistory['notifications']): ?>
                                <?php //foreach ($editorialHistory as $history): ?>
                                    <?php //foreach ($history as $notifications): ?>
                                        <ul>
                                            <li>From : <? //= $notifications['sender']; ?> To <? //= $notifications['recipient']; ?>
                                            </li>
                                            <span><? //= $notifications['title']; ?></span>
                                        </ul>
                                    <?php //endforeach; ?>
                                <?php //endforeach; ?>
                                <? //= anchor('editor/editorialhistory/' . $editorialHistory['notifications'][0]['submissionID'], '<span class="btn1 btn-success">More</span>'); ?>
                            <?php //endif; ?>
                        </div>
                    </div>
                </div> -->
                <!-- eof editorial history  -->
            </div>
        </div>


        <!-- end col -->

    </div>

    <!-- end row -->




    <?= $this->section('javascript'); ?>

    <script type="text/javascript" src="<?= base_url(); ?>js/production.js"></script>



    <?= $this->endSection(); ?>
    <?= $this->endSection(); ?>
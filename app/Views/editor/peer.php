<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container ">
  <div class="list-group col-6 p-2 mx-auto">

    <h1><?= $submission->title; ?></h1>
    <h4>Review date: <?= $peerDetails->review_date; ?></h4>

    <?php if ($peerDetails->status == 1): ?>
      <div class="list-group-item" role="alert">
        <span class="btn-secondary  waves-light" style="padding: 0.6rem 50px; border-radius: 5px;">
          <i class="fa fa-comments"></i>&nbsp; Sent to reviewer
        </span>
      </div>
    <?php elseif ($peerDetails->status == 2): ?>
      <div class="list-group-item" role="alert">

        <span class="btn-danger waves-light" style="padding: 0.47rem 55px; border-radius: 5px;">
          <i class="fa fa-comments"></i>&nbsp; In Review
        </span>
      </div>

    <?php elseif ($peerDetails->status == 20): ?>
      <div class="list-group-item" role="alert">
        <span class="btn-danger  waves-light" style="padding: 0.6rem 13px;border-radius: 50px;">
          <i class="fa fa-comments"></i>&nbsp; Rejected
        </span>
      </div>

    <?php endif; ?>


    <?php if ($peerDetails->status == 3): ?>
      <div class="list-group-item" role="alert">
        <span class="btn-success waves-light" style="padding: 0.47rem 31px; border-radius: 5px;">
          <i class="fa fa-comments"></i>&nbsp; Review submitted

        </span>
      </div>

      <div class="list-group-item" role="alert">
        <?= anchor('editor/accepted/' . $submission->submissionID . '/' . 4 . '/' . $peerDetails->reviewID, '<span class="btn-dark waves-light" style="padding: 0.47rem 34px; border-radius: 5px;"><i class="fa fa-comments"></i>&nbsp; Accept & proceed</span>'); ?>
      </div>


      <div class="list-group-item" role="alert">
        <?= anchor('editor/reject_peer/' . $submission->submissionID . '/' . $peerDetails->reviewID . '/' . $peerDetails->reviewerID, '<span class="btn-danger waves-light" style="padding: 0.47rem 12px; border-radius: 5px;"><i class="fa fa-comments"></i>&nbsp; Reject review & reassign</span>', 'onclick="return resetPeer()"'); ?>
      </div>
    <?php endif; ?>

    <?php if ($peerDetails->status == 4): ?>

      <div class="list-group-item" role="alert">
        <form method="POST" action="../tocopyedit">
          <!-- <form method="POST" action="../tocpeditor"> -->

          <input type="hidden" name="submissionid" value="<?= $submission->submissionID; ?>" />
          <input type="hidden" name="peer_id" value="<?= $peerDetails->reviewID; ?>" />

          <input type="hidden" name="title" value="<?= $submission->title; ?>" />

          <button class="btn btn-dark waves-effect waves-light" submit="button" style="padding: 0.47rem 23px;">
            <i class="fa fa-search"></i>&nbsp;Send To Copy Editing
          </button>
        </form>
      </div>
    <?php endif; ?>
    <?php if ($peerDetails->status == 5): ?>
      <div class="list-group-item" role="alert">
        <span class=" btn-secondary waves-light" style="padding: 0.47rem 27px; border-radius: 5px;">
          <i class="fas fa-edit"></i>&nbsp; Sent To Copy Editing
        </span>
      </div>
    <?php endif; ?>
    <?php if ($peerDetails->status == 6): ?>
      <div class="list-group-item" role="alert">
        <span class=" btn-danger waves-light" style="padding: 0.47rem 27px; border-radius: 5px;">
          <i class="fas fa-edit"></i>&nbsp; Under Copy Editing
        </span>
      </div>
    <?php endif; ?>
    <?php if ($peerDetails->status == 7): ?>
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
      <?php if ($editorialDecision->status == 8 && $peerDetails->status == 8): ?>

        <form method="POST" action="../toproduction">
          <input type="hidden" name="submissionid" value="<?= $submission->submissionID; ?>" />
          <input type="hidden" name="peer_id" value="<?= $peerDetails->reviewID; ?>" />

          <input type="hidden" name="title" value="<?= $submission->title; ?>" />

          <button type="submit" class="btn btn-dark waves-effect waves-light" style="padding: 0.47rem 54px;">
            <i class="fa fa-area-chart"></i>&nbsp;Send to Production
          </button>
        </form>
      <?php endif; ?>

    <?php endif; ?>

    <?php if ($peerDetails->status == 9): ?>
      <div class="list-group-item" role="alert">
        <span class=" btn-secondary waves-light" style="padding: 0.47rem 54px;">
          <i class="fa fa-area-chart"></i>&nbsp; Sent to Production
        </span>
      </div>
    <?php endif; ?>
    <?php if ($peerDetails->status == 10): ?>
      <div class="list-group-item" role="alert">
        <span class=" btn-danger waves-light" style="padding: 0.47rem 54px;">
          <i class="fa fa-area-chart"></i>&nbsp; Under Production
        </span>
      </div>
    <?php endif; ?>

    <?php if ($peerDetails->status == 11): ?>
      <div class="list-group-item" role="alert">
        <span class=" btn-success waves-light" style="padding: 0.47rem 54px;">
          <i class="fa fa-area-chart"></i>&nbsp; Production complted
        </span>
      </div>
    <?php endif; ?>

    <?php if ($peerDetails->status == 11): ?>

      <div class="list-group-item" role="alert">
        <?= anchor('editor/accepted_production/' . $submission->submissionID . '/' . 12, '<span class="btn-dark waves-light" style="padding: 0.50rem 65px; border-radius: 5px;"><i class="fa fa-comments"></i>&nbsp; Accept & proceed</span>'); ?>
      </div>
    <?php endif; ?>

    <!-- peer final files -->
    <?php if ($peerUpload): ?>
      <div class="card ">
        <div class="card-body">
          <div class="">
            <h4 class="card-title">Reviewer's final uploaded files</h4>

            <?php if (isset($peerUpload->article_file)): ?>

              <?= anchor('editor/downloads/' . $peerUpload->article_file, $peerUpload->article_file); ?>
            </div>
          <?php endif; ?>



        </div>
      </div>
      <!-- </div> -->
    <?php endif; ?>
    <!-- eof peer final files -->


    <!-- Reviewr discussion bof -->
    <div class="accordion-item ">
      <h2 class="accordion-header" id="headingPeer">
        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Reviewer Discussion
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingPeer"
        data-bs-parent="#accordionEditor">
        <div class="accordion-body">


          <?php if (!$peerDiscussions): ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#peerModal">
              Start Discussion
            </button>
          <?php endif; ?>


          <?php if ($peerDiscussions): ?>
            <?php foreach ($peerDiscussions as $key => $discussion): ?>


              <div class="card-body">
                <div class="d-flex mb-4">
                  <img class="me-3 rounded-circle avatar-sm" src="<?= base_url(); ?>assets/images/users/avatar-1.jpg"
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#peerModal">
                  <i class="mdi mdi-reply"></i>Reply
                </button>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>


      </div>
    </div>
  </div>
  <!-- copy-editor disscusson bof -->

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
          <h5>Add revision</h5>

          <div id="editor"></div>
          <form id="peerReplyForm" action="../notify" method="POST" enctype="multipart/form-data">


            <input type="hidden" name="role" id="role" value="4" />

            <div class="mb-3">
              <label for="subject-title" class="col-form-label">Subject:*</label>
              <input type="text" class="form-control" id="subject-title" name="subject-title" required>
              <?php if ($peer): ?>
                <input type="hidden" name="submissionID" value="<?= $submission->submissionID; ?>" />
                <input type="hidden" name="recipient" value="<?= $peer->email; ?>" />
                <input type="hidden" name="recipient_id" value="<?= $peer->userID; ?>" />
                <input type="hidden" name="authorName"
                  value="<?= $peer->title . ' ' . $peer->middle_name . ' ' . $peer->last_name; ?>" />
                <!-- <input type="hidden" name="role" value="<? //= $role; 
                  ?>" /> -->
              <?php endif; ?>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text" name="message-text" required></textarea>
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
</div><!-- comment -->


<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/attachment.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>js/addEditorRevision.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/copyEditorDiscussion.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/publisherDiscussion.js"></script>


<?= $this->endSection(); ?>

<?= $this->endSection(); ?>
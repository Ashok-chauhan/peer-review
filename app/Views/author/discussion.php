<?= $this->extend("layouts/base");?>
<?= $this->section("title");?>
Dashboard
<?= $this->endSection();?>

<?= $this->section("content");?>
<div class="container">
    <h1>Discussion</h1>
<div class="row"> 
    <div id="msg"></div>
    <div class="list-group col-10">
        <div><h3>Peer-Review Discussions</h3></div>
<?php if($notice):?>
        <?php foreach($notice as $note):?>
        <div class="fw-bold" > <?= $note->title;?></div>
        <div><?= $note->message;?></div>
        
        <div class="fw-bold text-end"  umail="ashok@kumar.com">
            <button type="button"   class="btn btn-primary"  data-bs-toggle="modal" onclick="toMailId('<?= $note->sender_email;?>','<?= $note->sender_id;?>')"  data-bs-target="#replyModal">
  Add discussion
</button>
        </div>
        <?php endforeach;?> 

<?php endif;?>
    </div>

</div>
 
    
    <!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#replyModal">
  Launch static backdrop modal
</button>-->

<!-- Modal -->
<div class="modal fade" id="replyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="replyModalLabel">Discussion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <h5>Participant</h5>
          <div><?= session()->get("username");?> Author</div>
          <div id="editor"></div>
          <form id="replyForm" action="../reply" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="submission" name="submission" value="<?= $submissionid;?>"/>
          
          
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
                      <option >Select article component</option>
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
    
</div>


<?= $this->section('javascript');?>
<script type="text/javascript" src="<?= base_url();?>js/authorReply.js"></script>
<?= $this->endSection();?>


<?= $this->endSection();?>

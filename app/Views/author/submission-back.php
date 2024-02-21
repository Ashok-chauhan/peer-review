<?= $this->extend("layouts/base");?>
<?= $this->section("title");?>
Dashboard
<?= $this->endSection();?>

<?= $this->section("content");?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h4>Submission</h4>
    <?php if(isset($validation)):?>
    <div class="alert alert-danger">
        <?= $validation->listErrors();?>
    </div>
    <?php endif;?>
    
    <?php if(isset($success)):?>
    <?php foreach ($success as $msg):?>
    <div class="alert alert-success">
        <?= $msg;?>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    
    
   <?= form_open_multipart();?>
<div >
    <label for="editor_comment" class="form-label fw-bold">Comments for editor</label>
  <textarea class="form-control" name="editor_comment" id="editor_comment" rows="3"></textarea>
</div>
  <p class="fw-bold">Corresponding Contact</p>
<div class="form-check">
  <input class="checkmark" type="checkbox"  id="contact" name="contact">
  <label class="form-check-label" for="contact">
    Yes, I would like to be contacted about this submission.
  </label>
</div>
<div class="form-check ">
  <input class="checkmark" type="checkbox"  id="data" name="data">
  <label class="form-check-label" for="data">
    Yes, I agree to have my data collected and stored according to the Policy statement.
  </label>
</div>
  
<!--  <div >
  <label for="article" class="form-label fw-bold">Choose file</label>
  <input class="form-control form-control-lg" id="article" name="article" type="file">
</div>-->
<div class="fw-bold">Article Component *</div>
<select class="form-select" name="article_type[]">
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
                <input type="file" name="article[]" class="fileToUpload">
            </div>
        </div>
<a href="#" id="addFile" class="fw-bold">Add More</a>
        
<!--  <div class="d-grid gap-2 p-5">
  <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
 
</div>-->
    
    
        
        </div>
        <div class="col-6">
             <div >
                 <h4>Enter Metadata</h4>
                <label for="prefix" class="form-label fw-bold">Prefix</label>
                <input type="text" class="form-control " id="prefix" name="prefix">
            </div>
            <div >
                <label for="title" class="form-label fw-bold">Title*</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div >
                <label for="subtitle" class="form-label fw-bold">Subtitle</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle">
            </div>
            <div class="mb-3">
              <label for="abstract" class="form-label fw-bold">Abstract*</label>
              <textarea class="form-control" id="abstract" name="abstract" rows="3"></textarea>
            </div>
            <div>
            
             <?= anchor('#','Add contributor',['class'=>'fw-bold','data-bs-toggle'=>'modal','data-bs-target'=>'#contributorModal'
          ]);?>  
                <span id="coauthor" class="fw-bold"> </span>
            </div>
            
            <div >
                <label for="language" class="form-label fw-bold">Language</label>
                <input type="text" class="form-control" id="language" name="language">
            </div>
            <div >
                <label for="keyword" class="form-label fw-bold">Keyword</label>
                <input type="text" class="form-control" id="keyword" name="keyword">
            </div>
            <div >
              <label for="reference" class="form-label fw-bold">References</label>
              <textarea class="form-control" id="reference" name="reference" rows="3"></textarea>
            </div>
        </div>
        
        
        <div class="d-grid gap-2 p-1">
          <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
        </div>
        <?= form_close();?>
        
    </div>
    
    
    
    
    
    
    <!-- Modal -->
<div class="modal fade" id="contributorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="contributorModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="contributorModalLabel">Add contributor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="contributorForm" action="contributor" method="POST" enctype="multipart/form-data">
         
          <div class="mb-3">
            <label for="c-name" class="col-form-label">Name:*</label>
            <input type="text" class="form-control" id="c-name" name="c-name">
          </div>
          <div class="mb-3">
            <label for="c-email" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="c-email" name="c-email">
          </div>
          <div class="mb-3">
            <label for="c-country" class="col-form-label">Country:</label>
            <input type="text" class="form-control" id="c-country" name="c-country">
          </div>
              
              <div class="form-group input-group  p-1">
      <span class="input-group-text"><i class="fa-solid fa-pen-nib"></i> </span>
     <input  class=" checkmark" type="radio" id="c-roleID" name="c-roleID" value="3">
     <label for="c-author">&nbsp; Author</label><br>
    </div> 
    
    <div class="form-group input-group  p-1">
      <span class="input-group-text"><i class="fa-solid fa-language"></i> </span>
     <input  class=" checkmark" type="radio" id="c-roleID" name="c-roleID" value="5">
     <label for="translator">&nbsp; Translator</label><br>
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
<!--    eof modal-->
    
    
</div>
<?= $this->section('javascript');?>
<script type="text/javascript" src="<?= base_url();?>js/submission.js"></script>
    
<?= $this->endSection();?>
    
<?= $this->endSection();?>
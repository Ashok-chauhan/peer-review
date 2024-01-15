<?= $this->extend("layouts/base");?>
<?= $this->section("title");?>
Dashboard
<?= $this->endSection();?>

<?= $this->section("content");?>
<div class="container">
    
    <h4><span class="badge bg-secondary">Your submissions</span></h4>
    
  
    
    <div class="row">   
        <div id="msg"></div>
<div class="list-group col-10">
    <?php  if(isset($list)) :?>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#/Title</th>
      <th scope="col">Download</th>
      <th scope="col">Date</th>
      
    </tr>
  </thead>
  
  
    <?php foreach($list as $key => $row):?>
  
  <tbody>
    <tr> 
      <td class="fw-bold" colspan="2"> <?=$key?> </td>
      <td> 
    <?= anchor('#','Add revision',['class'=>'btn btn-primary', 'data-bs-toggle'=>'modal','data-bs-target'=>'#revisionModal'
          ,'onClick'=>'subId('.$list[$key][0]->submissionID.')']);?>      
  
 
 <?php if($notification[$key]):?> 
          &nbsp;&nbsp;&nbsp;
          <?= anchor('author/discussion/'.$list[$key][0]->submissionID.'', '<i class="fa fa-envelope fa-lg">&nbsp;'.$notification[$key].'</i>');?>
          </i>
        <?php endif;?>
      
      </td>
    </tr>
    
    <?php foreach($row as $val):?>
    <?php $revId = $val->submissionID;?>
    <tr>
      <th scope="row"><?= $val->submissionID;?></th>
      <td ><a href="<?= base_url();?>author/downloads/<?= $val->content;?>"><?= $val->content;?></a></td>
      <td><?=$val->submission_date;?></td>
      
    </tr>
    <?php endforeach;?>
    </tbody>
    <?php endforeach;?>
    </table>
</div>
    </div>
  <?php endif;?>
    
    
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
<script type="text/javascript" src="<?= base_url();?>js/addRevision.js"></script>
<?= $this->endSection();?>
<?= $this->endSection();?>

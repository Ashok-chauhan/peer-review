<?= $this->extend("layouts/base");?>
<?= $this->section("title");?>
Dashboard
<?= $this->endSection();?>

<?= $this->section("content");?>
<div class="container">
    
    <p></p>
    
<div class="list-group">
  <span class="list-group-item list-group-item-action active" aria-current="true">
    What would you like to do next?
  </span>
  <a href="<?= base_url();?>author/viewsubmission" class="list-group-item list-group-item-action">View submission</a>
  <a href="<?= base_url();?>author/submission" class="list-group-item list-group-item-action">Make a new submission</a>
  <a href="#" class="list-group-item list-group-item-action">Edit profile</a>
  
</div>    
</div><!-- comment -->

<?= $this->endSection();?>
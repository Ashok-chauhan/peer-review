<?php $page_session = \Config\Services::session();?>
<?= $this->extend("layouts/base");?>
<?= $this->section("title"); ?>
Registration
<?= $this->endSection();?>
<?= $this->section("content");?>

<div class="container p-5 ">







<div class="card bg-light col-6 offset-3" style="width: 50%;" >
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	
<!--        	<p class="divider-text">
        <span class="bg-light">OR</span>
    </p>-->
<!--        <form >-->
<?php if($page_session->getTempdata("success")):?>
<div class="alert alert-success"><?= $page_session->getTempdata("success");?></div>
<?php endif;?>

<?php if(isset($validation)):?>
<div class="alert alert-danger"><?= $validation->listErrors();?></div>
<?php endif;?>
<?= form_open()?>
	<div class="form-group input-group p-1 ">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="username" value="<?= set_value('username');?>"id="username" class="form-control" placeholder="Full name" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group p-1">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" value="<?= set_value('email');?>" id="email" class="form-control" placeholder="Email address" type="email">
    </div> <!-- form-group// -->
    <div class="form-group input-group p-1">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
<!--		<select class="custom-select" style="max-width: 120px;">
		    <option selected="">+971</option>
		    <option value="1">+972</option>
		    <option value="2">+198</option>
		    <option value="3">+701</option>
		</select>-->
    	<input name="phone" value="<?= set_value('phone');?>" id="phone" class="form-control" placeholder="Phone number" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group p-1">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-globe "></i> </span>
		</div>
<!--		<select class="form-control">
			<option selected=""> Select job type</option>
			<option>Designer</option>
			<option>Manager</option>
			<option>Accaunting</option>
		</select>-->
        <input name="country" value="<?= set_value('country');?>" id="country" class="form-control" placeholder="Country" type="text">
	</div> <!-- form-group end.// -->
    <div class="form-group input-group p-1">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" value="<?= set_value('password');?>" id="password" class="form-control" placeholder="Create password" type="password">
    </div> <!-- form-group// -->
    <div class="form-group input-group p-1">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="cpass" value="<?= set_value('cpass');?>" id="cpass" class="form-control" placeholder="Repeat password" type="password">
    </div> <!-- form-group// -->   
    
    
    
    
    <div class="form-group input-group  p-1">
      <span class="input-group-text"><i class="fa-solid fa-pen-nib"></i> </span>
     <input  class=" checkmark" type="radio" id="roleID" name="roleID" value="3">
     <label for="author">&nbsp; Author</label><br>
    </div> 
    
    <div class="form-group input-group  p-1">
      <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i> </span>
     <input  class=" checkmark" type="radio" id="roleID" name="roleID" value="4">
     <label for="author">&nbsp; Reviewer</label><br>
    </div> 
    
    <div class="form-group input-group  p-1">
      <span class="input-group-text"><i class="fa-solid fa-book-open-reader"></i> </span>
     <input  class=" checkmark" type="radio" id="roleID" name="roleID" value="6">
     <label for="author">&nbsp; Reader</label><br>
    </div> 
    <div class="form-group input-group  p-1">
      <span class="input-group-text"><i class="fa-sharp fa-solid fa-eye-dropper"></i> </span>
     <input  class=" checkmark" type="radio" id="roleID" name="roleID" value="7">
     <label for="author">&nbsp; Copy editor</label><br>
    </div> 
    
    
    

    
    
    <div class="form-group d-md-flex justify-content-md-center p-1">
<!--        <button type="submit" class="btn btn-primary "> Create Account  </button>-->
<button type="submit" class="btn btn-primary ">Create Account </button>
    </div>    

    <p class="text-center">Have an account? <a href="<?= base_url();?>login">Log In</a> </p>                                                                 
<!--</form>-->
<?= form_close()?>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->


<?= $this->endSection();?>

<?= $this->extend("layouts/base");?>
<?= $this->section("title");?>
Login
<?= $this->endSection();?>

<?= $this->section("content");?>

<div class="container p-5 ">







<div class="card bg-light col-6 offset-3" style="width: 50%;" >
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Login</h4>



<?php if(isset($validation)):?>
<div class="alert alert-danger"><?= $validation->listErrors();?></div>
<?php endif;?>
<?php if(session()->getTempdata('error')):?>
<div class="alert alert-danger"><?= session()->getTempdata('error');?></div>
<?php endif;?>
<?= form_open()?>
	
    <div class="form-group input-group p-1">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" value="<?= set_value('email');?>" id="email" class="form-control" placeholder="Email address" type="email">
    </div> <!-- form-group// -->
   
   
    <div class="form-group input-group p-1">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" value="<?= set_value('password');?>" id="password" class="form-control" placeholder="Password" type="password">
    </div> <!-- form-group// -->
                                       
    <div class="form-group d-md-flex justify-content-md-center p-1">
<!--        <button type="submit" class="btn btn-primary "> Create Account  </button>-->
<button type="submit" class="btn btn-primary ">Login </button>
    </div>    

    <p class="text-center">Don't Have an account? <a href="<?= base_url();?>registration">Register</a> </p>                                                                 
<!--</form>-->
<?= form_close()?>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

<?= $this->endSection();?>
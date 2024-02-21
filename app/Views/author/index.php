<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>


<div class="row">
  <div class="col-xl-4 col-md-6">
    <a href="<?= base_url(); ?>author/viewsubmission">
      <div class="card">
        <div class="card-body1">
          <div class="d-flex">
            <div class="flex-grow-1">
              <span class="text-primary rounded-3">
                <img src="<?= base_url(); ?>assets/images/icon/icon-1.png">
              </span>
              <h4 class="mb-2 mt-6 font-size-15"><b>View Submission</b></h4>
            </div>
          </div>
        </div><!-- end cardbody -->
    </a>

  </div><!-- end card -->
</div><!-- end col -->
<div class="col-xl-4 col-md-6">
  <a href="<?= base_url(); ?>author/submission">
    <div class="card">
      <div class="card-body1">
        <div class="d-flex">
          <div class="flex-grow-1">

            <span class="text-primary rounded-3">
              <img src="<?= base_url(); ?>assets/images/icon/icon-2.png">
            </span>

            <h4 class="mb-2 mt-6 font-size-15"><b>Make a New Submission</b></h4>


          </div>


        </div>
      </div><!-- end cardbody -->
    </div><!-- end card -->
  </a>
</div><!-- end col -->
<div class="col-xl-4 col-md-6">
  <div class="card">
    <div class="card-body1">
      <div class="d-flex">
        <div class="flex-grow-1">
          <span class="text-primary rounded-3">
            <img src="<?= base_url(); ?>assets/images/icon/icon-3.png">
          </span>
          <h4 class="mb-2 mt-6 font-size-15"><b>Edit Profile</b></h4>

        </div>

      </div>
    </div><!-- end cardbody -->
  </div><!-- end card -->
</div><!-- end col -->

</div><!-- end row -->


<?= $this->endSection(); ?>
<?= $this->extend("layouts/base");?>
<?= $this->section("title"); ?>
Account activation
<?= $this->endSection();?>
<?= $this->section("content");?>

<h1>Account Activation</h1>
<?php if(isset($error)):?>
<div class="alert alert-danger">
    <?= $error; ?>
</div>
<?php endif;?>


<?php if(isset($success)):?>
<div class="alert alert-success">
    <?= $success; ?>
</div>
<?php endif;?>
<?= $this->endSection();?>

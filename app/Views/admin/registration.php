<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<?php $page_session = \Config\Services::session(); ?>
<div class="container">
    <div class="row">
        <div class="list-group col-8">


            <?php
            $role = [
                '1' => 'Admin',
                '2' => 'Editor',
                '3' => 'Author',
                '4' => 'Reviewr',
                '5' => 'Copy-editor',
                '6' => 'Publisher',
                '7' => 'Reader',
            ];
            $status = [
                'active' => 'Active',
                'inactive' => 'Inactive',

            ];
            ?>
            <div class="card">
                <div class="card-body">



                    <h4 class="text-muted text-center font-size-18"><b>REGISTER</b></h4>

                    <?php if ($page_session->getTempdata("success")): ?>
                        <div class="alert alert-success"><?= $page_session->getTempdata("success"); ?></div>
                    <?php endif; ?>

                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger"><?= $validation->listErrors(); ?></div>
                    <?php endif; ?>
                    <div id="error"></div>
                    <div class="p-3">
                        <!-- <form class="form-horizontal mt-3" action="#"> -->
                        <?php $attributes = ['class' => 'form-horizontal mt-3', 'id' => 'registration']; ?>
                        <?= form_open('', $attributes) ?>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <!--  <input class="form-control" type="text" required="" placeholder="Title"> -->
                                <select class="form-select" name="title">
                                    <option selected>Dr.</option>
                                    <option selected>Prof.</option>
                                    <option selected>Mr.</option>
                                    <option selected>Ms.</option>
                                    <option selected>Mrs.</option>
                                    <option selected>Title</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <!-- <input class="form-control" type="text" required="" placeholder="First name"> -->
                                <input name="username" value="<?= set_value('username'); ?>" id="username"
                                    class="form-control" placeholder="First name" type="text">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">

                                <input name="middle_name" value="<?= set_value('middle_name'); ?>" id="middle_name"
                                    class="form-control" placeholder="Middle name" type="text">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="last_name" value="<?= set_value('last_name'); ?>" id="last_name"
                                    class="form-control" placeholder="Last name" type="text" required>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <!-- <input class="form-control" type="email" required="" placeholder="Email"> -->
                                <input name="email" value="<?= set_value('email'); ?>" id="email" class="form-control"
                                    placeholder="Email address" type="email">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <!-- <input class="form-control" type="text" required="" placeholder="Phone number"> -->
                                <input name="phone" value="<?= set_value('phone'); ?>" id="phone" class="form-control"
                                    placeholder="Phone number" type="text">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="country" value="<?= set_value('country'); ?>" id="country"
                                    class="form-control" placeholder="Country" type="text">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="password" value="<?= set_value('password'); ?>" id="password"
                                    class="form-control" placeholder="Create password" type="password">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="cpass" value="<?= set_value('cpass'); ?>" id="cpass" class="form-control"
                                    placeholder="Repeat password" type="password">
                                <!-- <input type="hidden" id="roleID" name="roleID" value="3"> -->
                            </div>
                        </div>




                        <h6 class="alert-warning">You have to select appropriate role to register</h6>
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="data_consent">
                                        <input type="checkbox" class="custom-control-input" id="editor" name="roles[]"
                                            value="2"><a href="#" class="text-muted ms-6 ">
                                            Editor</a></label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="data_consent">
                                        <input type="checkbox" class="custom-control-input" id="author" name="roles[]"
                                            value="3"><a href="#" class="text-muted ms-6 ">
                                            Author</a></label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="notification">
                                        <input type="checkbox" class="custom-control-input" id="reviewer" name="roles[]"
                                            value="4"> <a href="#" class="text-muted  ms-6 ">
                                            Reviewer</a></label>
                                </div>


                                <!-- journal -->
                                <div class="form-group mb-3 row" id="review-interests">
                                    <div class="col-12">
                                        <?php if ($journals): ?>
                                            <label for="intrest" class="">Review Interests/Journal</label>
                                            <select class="js-example-basic-multiple" style="width:100%;" name="interests[]"
                                                multiple="multiple">

                                                <?php foreach ($journals as $value): ?>
                                                    <option value="<?= $value->id; ?>"><?= $value->journal_name; ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <!-- journal -->
                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="notification">
                                        <input type="checkbox" class="custom-control-input" id="copy-editor"
                                            name="roles[]" value="5"> <a href="#" class="text-muted  ms-6 ">
                                            Copy-editor</a></label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="notification">
                                        <input type="checkbox" class="custom-control-input" id="publisher"
                                            name="roles[]" value="6"> <a href="#" class="text-muted  ms-6 ">
                                            Publisher</a></label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <label class="form-label fw-normal" for="notification">
                                        <input type="checkbox" class="custom-control-input" id="translator"
                                            name="roles[]" value="7"> <a href="#" class="text-muted  ms-6 ">
                                            Translator</a></label>
                                </div>



                            </div>

                        </div>



                        <div class="form-group text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light"
                                    type="submit">Register</button>
                            </div>
                        </div>


                        <!-- </form> -->
                        <?= form_close() ?>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end cardbody -->
            </div>






        </div>
        <!-- right col bof -->
        <div class="col-4">

        </div>
        <!-- right col eof -->

        <!-- Editor bof -->

        <!-- editor eof -->

    </div> <!-- row -->
</div> <!--container-->
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>

<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/admin.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/registration.js"></script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
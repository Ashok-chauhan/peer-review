<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row ">
        <div class="col-12 d-flex justify-content-center">
            <div class="page-title-box ">
                <h5 class="mb-sm-0 font-size-24">You have multiple access</h5>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <?php session_start(); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex justify-content-center">

                        <ul>
                            <?php // foreach (session()->get('roles') as $role) {
                            
                            if (in_array('1', session()->get('roles'))) {
                                echo '<li>Login as ' . anchor('admin/?r=' . base64_encode(1), 'Admin') . '</li>';
                            }
                            if (in_array('2', session()->get('roles'))) {
                                //  $_SESSION["role"] = 2;
                                // if (isset($GLOBALS["roles"]))
                                //     unset($GLOBALS["roles"]);
                            
                                echo '<li>Login as ' . anchor('editor/?r=' . base64_encode(2), 'Editor') . '</li>';

                            }
                            if (in_array('3', session()->get('roles'))) {

                                echo '<li>Login as ' . anchor('author/profile/?r=' . base64_encode(3), 'Author') . '</li>';

                            }
                            if (in_array('4', session()->get('roles'))) {

                                echo '<li>Login as ' . anchor('peer/?r=' . base64_encode(4), 'Reviewer') . '</li>';

                            }
                            if (in_array('5', session()->get('roles'))) {

                                echo '<li>Login as ' . anchor('editcopy/?r=' . base64_encode(5), 'Copy-editor') . '</li>';

                            }
                            if (in_array('6', session()->get('roles'))) {
                                echo '<li>Login as ' . anchor('translator/?r=' . base64_encode(6), 'Translator') . '</li>';

                            }
                            if (in_array('7', session()->get('roles'))) {

                                echo '<li>Login as ' . anchor('reader/?r=' . base64_encode(7), 'Reader') . '</li>';

                            }
                            // } ?>

                        </ul>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>




</div>

<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/peer.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
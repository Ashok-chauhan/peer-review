<?php $page_session = \Config\Services::session(); ?>
<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Peer Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>



<div class="container">
    <?php if ($page_session->getTempdata("success")) : ?>
        <div class="alert alert-success"><?= $page_session->getTempdata("success"); ?></div>
    <?php endif; ?>

    <?php if ($page_session->getTempdata("error")) : ?>
        <div class="alert alert-danger"><?= $page_session->getTempdata("error"); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="list-group col-6 p-2 mx-auto">
            <h2><span class="badge bg-secondary">Term & conditons</span></h2>
            <div class="p-2">


                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a gravida ex, nec interdum libero. Quisque dapibus turpis at lorem maximus, vel suscipit metus consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam blandit orci ut mi tincidunt, ac tristique lorem aliquet. Etiam suscipit faucibus lacus a lobortis. Praesent ac nisi sapien. Etiam maximus diam sed libero luctus hendrerit. Nam suscipit purus sit amet ornare scelerisque. Phasellus mattis ornare sollicitudin. Morbi vehicula bibendum massa eget dictum.

                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a gravida ex, nec interdum libero. Quisque dapibus turpis at lorem maximus, vel suscipit metus consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam blandit orci ut mi tincidunt, ac tristique lorem aliquet. Etiam suscipit faucibus lacus a lobortis. Praesent ac nisi sapien. Etiam maximus diam sed libero luctus hendrerit. Nam suscipit purus sit amet ornare scelerisque. Phasellus mattis ornare sollicitudin. Morbi vehicula bibendum massa eget dictum.

            </div>

            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <div class="form-check">
                        <input type="hidden" name="rev_id" value="<?= $rev_id ?>" />
                        <input class="checkmark" type="checkbox" value="2" id="accept" name="consent">
                        <label class="form-check-label fw-bold" for="accept">
                            Accept
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="checkmark" type="checkbox" value="4" id="decline" name="consent">
                        <label class="form-check-label fw-bold" for="decline">
                            Decline
                        </label>
                    </div>
                </div>

                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-outline-secondary" type="submit">Submit</button>

                </div>
            </form>

        </div>

    </div>
</div>

<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/peer.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
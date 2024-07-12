<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Notifications
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-24" style="text-transform: capitalize;">Notification</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-10">
            <div class="card">
                <div class="card-body">


                    <?php if ($notifications): ?>
                        <?php foreach ($notifications as $key => $notification): ?>
                            <!-- <a href="" class="text-reset notification-item"> -->
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="ri-shopping-cart-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">
                                        <?= $notification->title; ?>
                                    </h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1 fw-bold">You have received a new notification from Editorial Co-ordinator
                                        </p>
                                        <p class="mb-1">
                                            <?= $notification->message; ?>
                                        </p>

                                        <?php if ($notification->file): ?>
                                            <h6>Attachment</h6>
                                            Article component:
                                            <?= $notification->article_component; ?>
                                            <p>
                                                <?= anchor('editor/downloads/' . $notification->file, $notification->file); ?>
                                            </p>
                                        <?php endif; ?>

                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                            <?= date("l jS \of F Y h:i:s A", strtotime($notification->date_created)); ?>
                                        </p>
                                        </br>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <!-- </a> -->
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>

        </div>
        <!-- end col -->


        <!-- end col -->

    </div>
    <!-- end row -->


</div>

<?= $this->endSection(); ?>
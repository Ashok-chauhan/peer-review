<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<div class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="list-group col-6">
            <h1><?= $journal->journal_name; ?></h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="30%">Assigned editor</th>
                        <th scope="col" width="10%">Email</th>
                        <th scope="col" width="10%">Phone</th>
                        <th scope="col" width="3%">Revoke</th>
                        <!-- <th scope="col">Username</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php if ($editors): ?>
                        <?php foreach ($editors as $editor): ?>
                            <tr>
                                <td><?= $editor->title . ' ' . $editor->username . ' ' . $editor->middle_name . ' ' . $editor->last_name; ?>
                                </td>
                                <td>

                                    <?= $editor->email; ?>
                                </td>
                                <td>
                                    <?= $editor->phone; ?>
                                </td>
                                <td>

                                    <form action="../revoke" method="post">
                                        <input type="hidden" name="jid" value="<?= $journal->id; ?>" />
                                        <input type="hidden" name="eid" value="<?= $editor->userID; ?>" />
                                        <button type="submit" class="btn btn-danger btn-sm">Revoke</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>


                </tbody>
            </table>
        </div>
        <div class="list-group col-6">
            <h2>Assign editor</h2>
            <p></p>
            <form action="../assigneditor" method="post">
                <input type="hidden" name="jid" value="<?= $journal->id; ?>" />
                <select class="form-select" aria-label="Default select example" name="eid">
                    <option disabled selected>Select editor</option>
                    <?php if ($allEditors): ?>
                        <?php foreach ($allEditors as $editor): ?>
                            <option value="<?= $editor->userID; ?>">
                                <?= $editor->title . ' ' . $editor->username . ' ' . $editor->middle_name . ' ' . $editor->last_name; ?>
                            </option>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                </br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div> <!-- row -->
</div> <!-- container -->


<?= $this->section('javascript'); ?>
<link href="<?= base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?= base_url(); ?>js/admin.js"></script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
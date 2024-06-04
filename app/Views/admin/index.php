<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container">
    <div class="row">
        <div class="list-group col-8">
            <h4>User management</h4>
            <?php if ($users): ?>
                <?php
                $role = [
                    '1' => 'Admin',
                    '2' => 'Editor',
                    '3' => 'Author',
                    '4' => 'Reviewr',
                    '5' => 'Copy-editor',
                    '6' => 'Translator',
                    '7' => 'Reader',
                ];
                $status = [
                    'active' => 'Active',
                    'inactive' => 'Inactive',

                ];
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">email</th>
                            <th scope="col">role</th>
                            <th scope="col">status</th>
                            <th scope="col"></th>
                            <th scope="col">Username</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <form id="<?= $user->userID; ?>" method="POST" action="admin">
                                <tr>
                                    <td>
                                        <?= $user->username; ?>
                                    </td>
                                    <td>
                                        <?= $user->email; ?>
                                    </td>
                                    <input type="hidden" name="userid" value="<?= $user->userID; ?>" />
                                    <td>
                                        <?= form_dropdown('roleID', $role, $user->roleID); ?>
                                    </td>
                                    <td>
                                        <?= form_dropdown('status', $status, $user->status); ?>
                                    </td>
                                    <td><input type="submit" value="Submit"></td>
                                </tr>
                            </form>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <!-- right col bof -->
        <div class="col-4">
            <h4>Submissions</h4>
            <?php if ($submissions): ?>
                <table class="table table-striped">
                    <tbody>
                        <?php foreach ($submissions as $submission): ?>
                            <tr>
                                <td class="fw-bold">
                                    <?= $submission->title; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php endif; ?>
        </div>
        <!-- right col eof -->

        <!-- Editor bof -->

        <div class="list-group col-8">
            <h4>Editor , Journal assignment</h4>
            <?php if ($editors): ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">Journal</th>
                            <th scope="col"></th>



                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($editors as $editor): ?>
                            <form id="<?= $editor->userID; ?>" method="POST" action="admin">
                                <tr>
                                    <td>
                                        <?= $editor->username; ?>
                                    </td>
                                    <td>
                                        <?= $editor->email; ?>
                                    </td>
                                    <input type="hidden" name="editor_id" value="<?= $editor->userID; ?>" />
                                    <?php
                                    $select = '';
                                    foreach ($selected as $key => $val) {

                                        if ($val == $editor->userID) {
                                            $select = $key;
                                        }
                                    }
                                    ?>
                                    <td>
                                        <?= form_dropdown('jid', $journals, $select); ?>
                                    </td>

                                    <td><input type="submit" value="Submit"></td>
                                </tr>
                            </form>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <!-- editor eof -->

    </div> <!-- row -->
</div> <!--container-->


<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/admin.js"></script>

<?= $this->endSection(); ?>
<?= $this->endSection(); ?>
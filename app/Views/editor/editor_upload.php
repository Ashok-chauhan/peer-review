<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="container">
    <div class="list-group col-6 p-2 mx-auto">

        <h1>Editor upload</h1>
        <p></p>
        <?= form_open_multipart(); ?>
        <?php if ($contents): ?>
            <?php foreach ($contents as $content): ?>
                <div>
                    <label for="title" class="form-label fw-bold"><?= $content->article_component; ?></label>
                    <input type="hidden" class="form-control" id="title" name="<?= $content->id; ?>"
                        value="<?= $content->article_component; ?>">
                </div>
                <div>

                    <input type="file" class="form-control" id="title" name="<?= $content->id; ?>" required>
                </div>
            <?php endforeach; ?>
            <p></p>
            <div class="d-grid">
                <button class="btn btn btn-primary" type="submit" value="Submit">Upload files</button>
            </div>
            <br />
            <div class="d-grid">
                <button class="btn btn btn-warning" onclick="history.back()">Cancel/Go Back</button>
            </div>
        <?php endif; ?>
        <?= form_close(); ?>
    </div>
</div><!-- comment -->

<?= $this->endSection(); ?>
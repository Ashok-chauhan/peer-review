<?= $this->extend("layouts/base");?>
<?= $this->section("title");?>
Dashboard
<?= $this->endSection();?>

<?= $this->section("content");?>
<div class="container">
    <div class="list-group col-6 p-2 mx-auto">
    <p></p>
   
    
    <?= form_open_multipart();?>
    
            <div >
                <label for="title" class="form-label fw-bold">Title*</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
        <div >
            <label for="message" class="form-label fw-bold">Notification/Message</label>
          <textarea class="form-control" name="message" id="message" rows="6" required></textarea>
        </div>
    
        <p></p>
        <div class="d-grid">
          <button class="btn btn-outline-secondary" type="submit" value="Submit">Send</button>
        </div>
        <?= form_close();?>
    </div>
</div><!-- comment -->

<?= $this->endSection();?>
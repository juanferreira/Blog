	<div id="upload">
    <div class="container">
  		<div class="row">
  			<div class="col-lg-6">
  				<h1>Upload form</h1>

          <?= $error; ?>

          <form action="<?= base_url(); ?>upload/do_upload/" method="post" enctype="multipart/form-data">
            <label for="file_upload">Choose file:</label><input type="file" name="file_upload" id="file_upload" class="form-control">
            <br>
            <button type="submit" class="btn btn-primary">Upload</button>
          </form>

        </div>
      </div>
    </div>
	</div>
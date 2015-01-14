	
	<div id="posts">
    <div class="container">
  		<div class="row">
  			<div class="col-lg-12">
  				<h1>Juan's Post Blog</h1>
  			</div>
  		</div>
      
      <?php
        // Check if post was successful. If so display success message. 
        if($success==1){ 
      ?>
        <div class="row">
          <div class="col-lg-4">
            <div class="alert alert-success">PostID <?= $post['postID']; ?> has been successfully updated! <a href="<?= base_url(); ?>posts/">Go back</a></div>
          </div>
        </div>
      <? }?>

      <div class="row">
        <div class="col-lg-3">
          <form action="<?= base_url(); ?>posts/editpost/<?= $post['postID']; ?>" method="post">
            <label for="title">Title:</label><input type="text" name="title" id="title" class="form-control" value="<?= $post['title']; ?>">
            <label for="post">Post:</label><input type="text" name="post" id="post" class="form-control" value="<?= $post['post']; ?>">
            <br>
            <button type="submit" class="btn btn-primary">Edit Post</button>
          </form>
        </div>
      </div>
    </div>
	</div>
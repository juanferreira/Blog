
  <div id="posts">
    <div class="container">
  		<div class="row">
  			<div class="col-lg-9">
  				<h1>Juan's Blog Post</h1> 
  			</div>
        
        <div class="col-lg-3" style="margin-top: 25px;">
        <?php  if($this->session->userdata('userName')){ ?>
            <p>You're logged in as: <?= $this->session->userdata('userName'); ?></p>
            <a href="<?= base_url(); ?>users/logout/">Logout</a>
        <? }
          else{ ?>
              <a href="<?= base_url()?>users/login/">Login</a> <a href="<?= base_url()?>users/register/">Register</a>
        <? } ?>
        </div>
  		</div>
      
      <div class="row">
        <form action="<?= base_url(); ?>posts/new_post/" method="post">
          <button class="btn btn-primary">Add Post</button>
        </form>
      </div>

  		<div class="row">
  			<div class="col-lg-12">
  				<?php
  					if(isset($posts) && count($posts) >= 1){
  						foreach($posts as $post){ ?>
  							<h3><a href="<?= base_url();?>posts/post/<?= $post['postID']; ?>">PostID <?= $post['postID']; ?></a> - <a href="<?= base_url();?>posts/editpost/<?= $post['postID']; ?>">Edit</a> | <a href="<?= base_url();?>posts/deletepost/<?= $post['postID']; ?>">Delete</a></h3>
  							<p>Title: <?= html_escape($post['title']); ?><p>
  							<p>Post: <?= html_escape(substr($post['post'],0, 5)).'...'; ?></p>
  							<hr>
  				  <? }//end for
  					}//end if
  					else echo "<p>No post have been made in this blog.</p>";
  				?>
  			</div>
  		</div>

      <div class="row">
        <?= $pages; ?>
      </div>
    </div>
	</div>
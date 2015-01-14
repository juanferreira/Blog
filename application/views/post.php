	
	<div id="posts">
    <div class="container">
  		<div class="row">
  			<div class="col-lg-12">
  				<h1>Juan's Blog Post</h1>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-lg-9">
          <?php
            if(!isset($post)){ ?>
              <p>This page was accessed incorrectly.</p>
           <? }//end if
           else{ ?>
              <h2><?= html_escape($post['title']); ?></h2>
              <?= html_escape($post['post']); ?>
            <? } ?>
  			</div>

        <div class="col-lg-3">
          <a href="<?= base_url()?>posts/">Go back</a>
        </div>
  		</div>

      <div class="row">
        <div class="col-lg-12">
            <h2>Comments (<?= count($comments); ?>)</h2>
            <?php 
              if(count($comments) > 0){
                foreach($comments as $comment){ ?>
                  <p><strong><?= html_escape($comment['username']); ?> said at <?= date('m/d/Y H:i A', strtotime($comment['date_added'])); ?></strong></p>
                  <br>
                  <?= html_escape($comment['comment']); ?>
                  <hr>
               <? }//end foreach
              }//end if
              else{ ?>
                <p>There are currently no comments.</p>
             <? }//end else
            ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <form action="<?= base_url(); ?>comments/add_comment/<?= $post['postID']; ?>" method="post">
            <textarea name="comment" class="form-control" rows="5"></textarea>
            <br>
            <p>Captcha code: <?= $captcha; ?></p>
            <input type="text" name="captcha" width="5" >
            <br><br>
            <button type="submit" class="btn btn-primary">Add comment</button>
          </form>
        </div>
      </div>
    </div>
	</div>
<h3>Your file was successfully uploaded!</h3>

<ul>
	<?php 
		foreach($upload_data as $key => $value){ ?>
			<li><?= $key; ?> : <?= $value; ?></li>
		<? }//end foreach ?>
</ul>

<a href="<?= base_url(); ?>upload/">Upload additional files</a>
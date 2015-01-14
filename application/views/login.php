	
	<div id="login">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<h1>Login</h1>
				
					<?php
						// If error is equal to 1 then display incorrect login message. 
						if($error== 1){ ?>
						<div class="alert alert-danger">Login incorrect!</div>
					<?	} ?>

					<form action="<?= base_url(); ?>users/login/" method="post">
						<label for="username">Username:</label><input type="text" class="form-control" name="username" id="username">
						<label for="password">Password:</label><input type="password" class="form-control" name="password" id="password">
						<label for="user_type">User Type:</label>
						<select name="user_type" class="form-control" id="user_type">
							<option value="" selected="selected">--</option>
							<option value="admin">Admin</option>
							<option value="author">Author</option>
							<option value="user">User</option>
						</select>
						<br>
						<button type="submit" class="btn btn-primary">Login</button>	
					</form>
				</div>
			</div>
		</div>
	</div>

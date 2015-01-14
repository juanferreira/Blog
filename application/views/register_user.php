	<div id="register_user">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<h1>Register User</h1>
					
					<?php if(isset($errors)){ ?>
						<div class="alert alert-danger">
							<?= $errors; ?>
						</div>
					<? } ?>

					<form action="<?= base_url(); ?>users/register/" method="post">
						<label for="username">Username:</label><input type="text" class="form-control" name="username" id="username" required>
						<label for="email">Email:</label><input type="email" class="form-control" name="email" id="email" required>
						<label for="password">Password:</label><input type="password" class="form-control" name="password" id="password" required>
						<label for="password2">Confirm Password:</label><input type="password" class="form-control" name="password2" id="password2" required>
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


<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
<div class="row">
	<div class="col-md-4 m-auto">
		<h2 class="text-center"><?= $title; ?></h2>
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control" placeholder="Enter Name">
		</div>
		<div class="form-group">
			<label>ZipCode</label>
			<input type="text" name="zipcode" class="form-control" placeholder="Enter ZipCode">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" class="form-control" placeholder="Enter Email">
		</div>
		<div class="form-group">
			<label>Username</label>
			<input type="text" name="username" class="form-control" placeholder="Enter UserName">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control" placeholder="Enter Password">
		</div>
		<div class="form-group">
			<label>Confirm Password</label>
			<input type="password" name="password2" class="form-control" placeholder="Confirm Password">
		</div>
		<button type="submit" class="btn btn-primary btn-block">Submit</button>
	</div>
</div>
<?php echo form_close(); ?>


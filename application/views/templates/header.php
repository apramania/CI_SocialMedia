<!DOCTYPE html>
<html>
<head>
	<title>CI Blog</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
	<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
</head>
<body>
	<nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
		<div class="container">
			  <a class="navbar-brand" href="#">CI Blog</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarColor01">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo base_url(); ?>posts">Blog</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo base_url(); ?>categories">Categories</a>
			      </li>
			    </ul>
			    <ul class="nav navbar-nav navbar-right">
			    	<?php if(!$this->session->userdata('logged_in')): ?>
				    	 <li class="nav-item">
					        <a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a>
					    </li>
					    <li class="nav-item">
					        <a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a>
					    </li>
					<?php endif; ?>
					<?php if($this->session->userdata('logged_in')): ?>
					    <li class="nav-item">
					        <a class="nav-link" href="<?php echo base_url(); ?>posts/add">Add Posts</a>
					    </li>
					    <li class="nav-item">
					        <a class="nav-link" href="<?php echo base_url(); ?>categories/create">Create Categories</a>
					    </li>
					    <li class="nav-item">
					        <a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a>
					    </li>
				    <?php endif; ?>
			    </ul>
			  </div>
		</div>
	</nav>

	<div class="container pt-4">
		<!-- Flash Message -->
		<?php if($this->session->flashdata('user_registered')) : ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('post_created')) : ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('post_updated')) : ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('category_added')) : ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_added').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('post_deleted')) : ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('login_failed')) : ?>
			<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('user_loggedin')) : ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('user_loggedout')) : ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('category_deleted')) : ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_deleted').'</p>'; ?>
		<?php endif; ?>
	
	

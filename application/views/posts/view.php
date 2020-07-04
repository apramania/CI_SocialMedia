
<h3><?php echo $post['title']; ?></h3>
<small class="post-date">Posted on: <?php echo $post['created_at']; ?></small><br>
				<img class="img-thumb" src="<?php echo base_url(); ?>uploads/<?php echo $post['post_image']; ?>">
<div class="post-body">
	<?php echo $post['body']; ?>
</div>

<?php if($this->session->userdata('user_id') == $post['user_id']): ?>
<hr>
<div>
	<?php echo form_open('posts/delete/'.$post['id']); ?>
		<input type="submit" name="submit" value="Delete" class="btn btn-danger float-left">
	</form>
	<a class="btn btn-success float-right" href="<?php echo base_url();?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
</div>
<br><br>
<?php endif; ?>

<hr>
<h3>Comments</h3>
<?php if($comments): ?>
	<?php foreach($comments as $comment): ?>
		<div class="card card-body bg-light">
		<h6><?php echo $comment['body']; ?> [by <strong><?php echo $comment['name']; ?></strong>]</h6>
		</div><br>
	<?php endforeach; ?>
<?php else: ?>
	<p>No Comments To Display</p>
<?php endif; ?>

<br><br>

<hr>
<h3>Add Comments</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('comments/create/'.$post['id']); ?>
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea name="body" class="form-control"></textarea>
	</div>
	<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
<br><br><br>
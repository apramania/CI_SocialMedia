<h2><?= $title ?></h2>
<div class="container pt-3">
	<?php foreach ($posts as $post): ?>
		<h3><?php echo $post['title']; ?></h3>
		<div class="row">
			<div class="col-md-3">
				<img style="width: 100%;" class="img-thumb" src="<?php echo base_url(); ?>uploads/<?php echo $post['post_image']; ?>">
			</div>
			<div class="col-md-9">
				<small class="post-date">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['name']; ?></strong></small><br>
				<?php echo word_limiter($post['body'],60); ?>
				<br><br>
				<p><a class="btn btn-light"href="<?php echo site_url('/posts/'.$post['slug']); ?>">Read More</a></p>
			</div>
		</div>
		
	<?php endforeach; ?>
	<div class="pagination-link">
		<?php echo $this->pagination->create_links(); ?>
	</div>
</div>
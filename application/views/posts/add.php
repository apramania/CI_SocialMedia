<h3><?= $title ?></h3>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('posts/add'); ?>
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title">
  </div>
  <div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body"></textarea>
  </div>
  <div class="form-group">
  	<label>Category</label>
  	<select name="category_id" class="form-control">
  		<?php foreach($category as $cat): ?>
  			<option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
  		<?php endforeach; ?>
  	</select>
  </div>
  <div class="form-group">
  	<label>Upload Image</label>
  	<input type="file" name="userfile" size="20">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


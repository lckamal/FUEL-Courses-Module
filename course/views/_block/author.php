<?php if(isset($author)): ?>
<div class="col-lg-12">
	<?php if($author['author_image'] != ''):?>
		<img src="<?php echo base_url('assets/images/'.$author['author_image']); ?>" width="100" height="100" class="img-circle" />
	<?php endif; ?>
	<p>This lesson is created by:</p>
	<h3><?php echo $author['author_name']; ?></h3>
	<div><?php echo $author['about_author']; ?></div>
</div>
<?php endif; ?>
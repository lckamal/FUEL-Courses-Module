<div class="row-fluid">

	<h2><?php echo $course['title']; ?></h2>

	<?php if(is_array($lessons) && count($lessons) > 0):
	foreach($lessons as $key => $lesson): ?>
		<h3>
			<a href="<?php echo site_url('courses/'.$course['slug'].'/'.$lesson['slug']); ?>"><?php echo '<span class="badge">'.($key + 1).'</span> ' . $lesson['title']; ?></a>
		</h3>
		<div class="text">
			0/<?php echo $lesson['articles_count']; ?> COMPLETED
		</div>
		<hr />
	<?php endforeach;
		endif; ?>

</div>
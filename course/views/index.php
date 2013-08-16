<div class="row-fluid">
<?php if(is_array($courses)):
	foreach($courses as $key => $course):
 ?>
	<h4><?php echo $course['title']; ?></h4>

	<?php if(is_array($course['lessons']) && count($course['lessons']) > 0):
	foreach($course['lessons'] as $key => $lesson): ?>
		<h3>
			<a href="<?php echo site_url('courses/'.$course['slug'].'/'.$lesson['slug']); ?>"><?php echo '<span class="badge">'.($key + 1).'</span> ' . $lesson['title']; ?></a>
		</h3>
		<div class="text">
			0/<?php echo $lesson['articles_count']; ?> COMPLETED
		</div>
		<hr />
	<?php endforeach;
		endif; ?>

<?php 
endforeach;
endif; ?>
</div>
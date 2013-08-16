<div id="fuel_main_content_inner">
<?php if(is_array($courses)):
	foreach($courses as $course):
 ?>
	<h2>
		<?php echo $course['course_name']; ?>
	</h2>
<?php 
endforeach;
endif; ?>
</div>
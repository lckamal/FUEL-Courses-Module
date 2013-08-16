<?php
$config['modules']['course_courses'] = array(
	'module_name' => 'courses',
	'module_uri' => 'course/courses',
	'model_name' => 'courses_model',
	'model_location' => 'course',
	'table_headers' => array(
		'id', 
		'title', 
		'slug', 
		'created_at',  
		'published'
	),
	'display_field' => 'title',
	'preview_path' => 'course/id/{id}',
	'permission' => 'course/courses',
	'instructions' => lang('module_instructions_default', 'Courses Records'),
	'archivable' => TRUE,
	'configuration' => array('course' => 'course'),
	'nav_selected' => 'course/courses',
	//'js' => array('course' => 'CourseController.js'),
	//'css' => array('course' => 'course.css'),
	'default_col' => 'title',
	'default_order' => 'asc',
	'table_actions' => array('EDIT','VIEW' => fuel_url(COURSE_FOLDER.'/courses/view/{id}'),'DELETE')
);

$config['modules']['course_lessons'] = array(
	'module_name' => 'lessons',
	'module_uri' => 'course/lessons',
	'model_name' => 'lessons_model',
	'model_location' => 'course',
	'display_field' => 'title',
	'permission' => 'course/lessons',
	'configuration' => array('course' => 'course'),
	'nav_selected' => 'course/lessons'
);

$config['modules']['course_articles'] = array(
	'module_name' => 'articles',
	'module_uri' => 'course/articles',
	'model_name' => 'articles_model',
	'model_location' => 'course',
	'display_field' => 'title',
	'permission' => 'course/articles',
	'configuration' => array('course' => 'course'),
	'nav_selected' => 'course/articles'
);
$config['modules']['course_authors'] = array(
	'module_name' => 'authors',
	'module_uri' => 'course/authors',
	'model_name' => 'authors_model',
	'model_location' => 'course',
	'display_field' => 'author_name',
	'permission' => 'course/authors',
	'configuration' => array('course' => 'course'),
	'nav_selected' => 'course/authors'
);



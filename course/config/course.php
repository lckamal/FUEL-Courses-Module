<?php 
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['courses'] = array(
	'course/courses' => lang('module_courses'),
	'course/lessons' => lang('module_course_lessons'),
	'course/articles' => lang('module_course_articles'),
	'course/authors' => lang('module_course_authors'),
);

/*
|--------------------------------------------------------------------------
| Configurable in settings if course_use_db_table_settings is set
|--------------------------------------------------------------------------
*/

// deterines whether to use this configuration below or the database for controlling the courses behavior
$config['course_use_db_table_settings'] = TRUE;

$config['course'] = array();

$config['course']['settings']['uri'] = array('value' => 'course');
$config['course']['settings']['theme_path'] = array('value' => 'themes/default');
$config['course']['settings']['theme_layout'] = array('value' => 'main', 'size' => '20');
$config['course']['settings']['theme_module'] = array('value' => 'course', 'size' => '20');
$config['course']['settings']['use_cache'] = array('type' => 'checkbox', 'value' => '1');
$config['course']['settings']['asset_upload_path'] = array('default' => 'images/course/');
$config['course']['settings']['per_page'] = array('value' => 1, 'size' => 3);
$config['course']['settings']['page_title_separator'] = array('value' => '&laquo;', 'size' => 10);


// the cache folder to hold course cache files
$config['course_cache_group'] = 'course';

/*
|--------------------------------------------------------------------------
| Programmer specific config (not exposed in settings)
|--------------------------------------------------------------------------
*/
// content formatting options
$config['course']['formatting'] = array(
	'auto_typography' => 'Automatic',
	'Markdown' => 'Markdown',
	'' => 'None'
	);
// pagination
$config['course']['pagination'] = array(
		'prev_link' => 'Prev',
		'next_link' => 'Next',
		'first_link' => '',
		'last_link' => '',
	);


// tables for course
$config['tables']['courses'] = 'module_courses';
$config['tables']['lessons'] 				= 'module_lessons';
$config['tables']['articles'] 				= 'module_articles';
$config['tables']['authors'] 				= 'module_authors';


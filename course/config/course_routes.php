<?php 
$education_models = array(
	'courses_model',
);

$education_controllers = array(
	'ajax',
	'courses',
	'lessons',
	'articles',
	'authors'
);
foreach($education_models as $c)
{
	$route[FUEL_ROUTE.COURSE_FOLDER.'/'.$c] = FUEL_FOLDER.'/module';
	$route[FUEL_ROUTE.COURSE_FOLDER.'/'.$c.'/(.*)'] = FUEL_FOLDER.'/module/$1';

}

foreach($education_controllers as $c)
{
	$route[FUEL_ROUTE.COURSE_FOLDER.'/'.$c] = COURSE_FOLDER.'/'.$c;
	$route[FUEL_ROUTE.COURSE_FOLDER.'/'.$c.'/(.*)'] = COURSE_FOLDER.'/'.$c.'/$1';
}
$route['courses'] = 'course/course';
$route['courses(:any)'] = 'course/course$1';


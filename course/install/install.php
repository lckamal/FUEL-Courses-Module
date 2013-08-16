<?php 
$config['name'] = 'Course Module';
$config['version'] = '1';
$config['author'] = 'Kamal Lamichhane';
$config['company'] = 'http://lkamal.com.np';
$config['license'] = 'Apache 2';
$config['copyright'] = '2013';
$config['author_url'] = 'http://lkamal.com.np';
$config['description'] = 'The courses module is capable of adding courses and lessons on it.';
$config['compatibility'] = '1.0';
$config['instructions'] = '';
$config['permissions'] = array('course_manage', 'lesson_manage', 'blog_categories', 'blog_users');
$config['migration_version'] = 0;
$config['install_sql'] = 'fuel_course_install.sql';
$config['uninstall_sql'] = 'fuel_course_uninstall.sql';
$config['repo'] = '';
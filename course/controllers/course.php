<?php
require_once(MODULES_PATH.'/course/libraries/Course_base_controller.php');

class Course extends Course_base_controller {
	
	function __construct()
	{
		parent::__construct();
		$this->view_location = 'fuel';
		
		$this->load->module_model(COURSE_FOLDER, 'courses_model');
		$this->load->module_model(COURSE_FOLDER, 'lessons_model');
		$this->load->module_model(COURSE_FOLDER, 'articles_model');
		$this->load->module_model(COURSE_FOLDER, 'authors_model');
	}
	
	function _remap()
	{
		$args = func_get_args();
		$method = $args[0];
		$segments = $args[1];

		if($method == 'index')
		{
			$vars = array('page_title' => 'Courses');

			$vars['courses'] = $this->courses_model->get_courses();
			
	 		$this->_render('index', $vars);
		}
		elseif($method == 'lesson'){
			$this->lesson(isset($segments[0]) ? $segments[0] : NULL);
		}
		elseif($method == 'article'){
			$this->article(isset($segments[0]) ? $segments[0] : NULL);
		}
		else{

			if(isset($segments[0]))
			{
				$this->lesson($segments[0]);

			}
			else{
				$vars = array('page_title' => 'Courses :: '.$method);
				$vars['course'] = $this->courses_model->find_one(array('slug' => $method), '', 'array');

				$vars['lessons'] = $this->lessons_model->get_lessons(array('course_id' => $vars['course']['id']), null, null, null, 'array');

		 		$this->_render('course', $vars);
			}
		}
        		 
	}
	
	function lesson($course_slug = NULL)
	{
		if($course_slug == NULL) show_404();

		$vars = array('page_title' => 'Lesson :: '.$course_slug);
		$vars['lesson'] = $this->lessons_model->find_one(array('slug' => $course_slug), '', 'array');
		$vars['author'] = $this->authors_model->find_one(array('id' => $vars['lesson']['author_id']), '', 'array');
		$vars['sidebar'] = $this->load->module_view('course', '_block/author', $vars, true);
		$vars['articles'] = $this->articles_model->find_all(array('lesson_id' => $vars['lesson']['id']), null, null, null, 'array');

 		$this->_render('lesson', $vars);
	}

	function article($article_slug = NULL)
	{
		if($article_slug == NULL) show_404();

		$vars = array('page_title' => 'Article :: '.$article_slug);
		$vars['article'] = $this->articles_model->find_one(array('slug' => $article_slug), '', 'array');

 		$this->_render('article', $vars);
	}
	
}
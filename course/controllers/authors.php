<?php
require_once(FUEL_PATH.'controllers/module.php');
class Authors extends Module {

	function __construct()
	{
		parent::__construct();
		$this->config->module_load(COURSE_FOLDER, COURSE_FOLDER);
		$this->load->module_model(COURSE_FOLDER,'authors_model');
		$this->view_location = 'fuel';
		
		
		$crumbs = array('course/authors' => 'Authors', 'View');
		$this->fuel->admin->set_titlebar($crumbs);
	}
	
	function items()
	{
		parent::items();
	}
	
	function view($id = NULL){
		if (empty($id))
		{
			show_404();
		}
		
		
		$this->fuel->admin->render('course/view', $vars, Fuel_admin::DISPLAY_NO_ACTION);
	}

}
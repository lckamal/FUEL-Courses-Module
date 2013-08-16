<?php
require_once(FUEL_PATH.'controllers/module.php');
class Articles extends Module {

	function __construct()
	{
		parent::__construct();
		$this->config->module_load('course', 'course');
		$this->view_location = 'fuel';
	}
	
	function items()
	{
		parent::items();
	}
}
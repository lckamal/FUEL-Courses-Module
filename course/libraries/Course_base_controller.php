<?php
class Course_base_controller extends CI_controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->fuel->auth->accessible_module('course'))
		{
			show_404();
		}
	}
	
	function _common_vars()
	{
		$vars['course'] =& $this->fuel->course;
		$vars['is_course'] = TRUE;
		$vars['page_title'] = '';
		//$this->load->vars($vars);
		return $vars;
	}
	
	/**
	* Render course module view to application view layout
	*
	* @param string $view module view
	* @param array $vars
	* @param bool $return decide to render or return
	* @param string $layout layout to use
	*/
	function _render($view, $vars = array(), $return = FALSE, $layout = '')
	{

		$vars['body'] = $this->load->module_view(COURSE_FOLDER, $view, $vars, TRUE);
		
		$layout = (! empty($layout) ) ? $layout : 'main';
		$output = $this->load->view('_layouts/'.$layout, $vars, TRUE);
        
		$this->load->module_library(FUEL_FOLDER, 'fuel_pages');
		$this->fuel_pages->initialize();
		$output = $this->fuel_page->fuelify($output);
		
		if ($return)
		{
			return $output;
		}
		else
		{
			$this->output->set_output($output);
		}
	}
}
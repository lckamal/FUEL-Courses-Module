<?php
class Course_controller extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->fuel->auth->accessible_module('dudbc'))
		{
			show_404();
		}
	}
	
	function ajax_combo_zone()
	{
		if (is_ajax()):
			$CI =& get_instance();
			$options = $_POST;
			$region_id = !empty($options['region_id']) ? $options['region_id'] : 0;
			
			$options = $CI->zones_model->options_list(array('region_id' => $region_id));
			$fields['zone_id'] = array('label' => 'Zone', 'class' => '', 'type' => 'select', 'options' => $options);
			
			echo '<option value="">select section</option>';
			foreach($sections as $key => $section){
				echo '<option value="'.$section['section_id'].'" label="'.$section['name'].'">'.$section['name'].'</option>';
			}
		
		else:
			echo '<html><body>This page was NOT an AJAX request</body></html>';
		endif;
	}
}
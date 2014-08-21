<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
 
class Articles_model extends Base_module_model {

    public $record_class = 'Title';
	public $required = array(
		'title' => 'Please fill out the course name',
		'slug' => 'Slug cannot be empty',
		'lesson_id' => 'Please select course'
	);
	
	public $foreign_keys = array(
		'lesson_id' => array('course' => 'lessons_model')
	);

    function __construct()
    {
        parent::__construct('module_articles', COURSE_FOLDER);
    }
 

	 function list_items($limit = NULL, $offset = NULL, $col = 'title', $order = 'asc')
	{
		$data = parent::list_items($limit, $offset, $col, $order);
		return $data;
	}
	
	function form_fields($values = array())
	{
		$CI =& get_instance();
		$fields = parent::form_fields($values);
		$fields['lesson_id']['order'] = '1';

		return $fields;
	}
	
}
 
class Article_model extends Base_module_record {
    function on_init()
    {
        $this->_tables = $this->_CI->config->item('tables');
    }
	}
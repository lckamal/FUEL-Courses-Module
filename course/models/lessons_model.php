<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
 
class Lessons_model extends Base_module_model {

    public $record_class = 'Lesson';
	public $required = array(
		'title' => 'Please fill out the course name',
		'slug' => 'Slug cannot be empty',
		'course_id' => 'Please select course'
	);
	
	public $foreign_keys = array(
		'course_id' => array('course' => 'courses_model'),
		'author_id' => array('course' => 'authors_model')
	);
    function __construct()
    {
        parent::__construct('lessons', COURSE_FOLDER);
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
		$fields['course_id']['order'] = '1';

		return $fields;
	}

	function get_lessons($where = array(), $order_by ='title', $limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	{
		$lessons = $this->find_all($where, $order_by, $limit, $offset, 'array');

		if(is_array($lessons))
		{
			foreach($lessons as &$lesson)
			{
				$lesson['articles_count'] = $this->articles_model->record_count(array('lesson_id' => $lesson['id']));
			}
		}
		return $lessons;
	}
	
}
 
class Lesson_model extends Base_module_record {

	private $_tables;

	function on_init()
	{
		$this->_tables = $this->_CI->config->item('tables');
	}

	function count_lessons($course_id = 0)
	{
		return 5;
	}
}
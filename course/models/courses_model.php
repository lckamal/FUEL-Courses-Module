<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
 
class Courses_model extends Base_module_model {

    public $record_class = 'Course';
	public $required = array(
		'title' => 'Please fill out the course name',
		'slug' => 'Slug cannot be empty',
	);
    function __construct()
    {
		
        parent::__construct('module_courses', COURSE_FOLDER);

        $this->load->module_model(COURSE_FOLDER, 'lessons_model');
    }
 

	 function list_items($limit = NULL, $offset = NULL, $col = 'title', $order = 'asc')
	{
		$data = parent::list_items($limit, $offset, $col, $order);
		return $data;
	}
	
	function form_fields($values = array())
	{
		$fields = parent::form_fields($values);
		unset($fields['created_at']);
		return $fields;
	}

	function get_courses($where = array(), $order_by ='title', $limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	{
		$courses = $this->db->get($this->_tables['courses'])->result_array();
		if($courses)
		{
			foreach($courses as &$course)
			{
				$course['lessons'] = $this->db->where(array('course_id' => $course['id']))->get($this->_tables['lessons'])->result_array();
				if(is_array($course['lessons']))
				{
					foreach ($course['lessons'] as $key => &$lesson) {
						$lesson['articles_count'] = $this->db->where(array('lesson_id' => $lesson['id']))->get($this->_tables['articles'])->num_rows();
					}
				}
				
			}
		}
		return $courses;

	}
	
}
 
class Course_model extends Base_module_record {
	private $_tables;


	function on_init()
	{
		$this->_tables = $this->_CI->config->item('tables');
	}

}
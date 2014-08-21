<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
 
class Authors_model extends Base_module_model {

    public $record_class = 'Author';
	public $required = array(
		'author_name' => 'Please fill out the author name',
		'author_name' => 'Please fill out the author email',
	);
    function __construct()
    {
        parent::__construct('module_authors', COURSE_FOLDER);
    }
 

	function list_items($limit = NULL, $offset = NULL, $col = 'author_name', $order = 'asc')
	{
		$data = parent::list_items($limit, $offset, $col, $order);
		return $data;
	}
	
	function form_fields($values = array())
	{
		$fields = parent::form_fields($values);

		return $fields;
	}
	
}
 
class Author_model extends Base_module_record {
	}
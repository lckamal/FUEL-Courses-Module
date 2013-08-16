<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * The Main Library class used in the blog
 *
 * @package		FUEL COURSE
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Kamal Lamichhane @ lkamal.com.np
 * @link		http://www.lkamal.com.np
 */

class Fuel_course extends Fuel_advanced_module {
	
	protected $_settings = NULL;

	/**
	 * Constructor
	 *
	 * The constructor can be passed an array of config values
	 */
	function __construct($params = array())
	{
		parent::__construct();
		
		if (empty($params))
		{
			$params['name'] = 'course';
		}
		$this->initialize($params);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Initialize the user preferences
	 *
	 * Accepts an associative array as input, containing display preferences
	 *
	 * @access	public
	 * @param	array	config preferences
	 * @return	void
	 */	
	function initialize($params = array())
	{
		parent::initialize($params);
		
		if (!empty($params))
		{
			foreach ($params as $key => $val)
			{
				$sans_course_key = substr($key, count('course_'));
				if (isset($this->$key))
				{
					$this->$sans_course_key = $val;
				}
			}
		}
		
		// }
		
	}

	function get_lessons_count($where = array())
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'lessons_model');
		$this->CI->lessons_model->readonly = TRUE;
		$count = $this->CI->lessons_model->record_count($where);
		return $count;
	}

	function get_courses($where = array(), $order_by ='course_name', $limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'courses_model');
		$this->CI->courses_model->readonly = TRUE;
		$courses = $this->CI->courses_model->find_all($where, $order_by, $limit, $offset, $return_method, $assoc_key);
		var_dump($courses);exit;
		return $posts;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns posts based on specific query parameters
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @param	int
	 * @param	int
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function get_posts($where = array(), $order_by = 'sticky, post_date desc', $limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_posts_model');
		$this->CI->blog_posts_model->readonly = TRUE;
		$where = $this->_publish_status('blog_posts', $where);
		$posts = $this->CI->blog_posts_model->find_all($where, $order_by, $limit, $offset, $return_method, $assoc_key);
		return $posts;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns the number of posts
	 *
	 * @access	public
	 * @param	mixed
	 * @return	array
	 */
	function get_posts_count($where = array())
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_posts_model');
		$where = $this->_publish_status('blog_posts', $where);
		$count = $this->CI->blog_posts_model->record_count($where);
		return $count;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns posts to be displayed for a specific page. Used for pagination mostly
	 *
	 * @access	public
	 * @param	int
	 * @param	int
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function get_posts_by_page($limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_posts_model');
		$this->CI->blog_posts_model->readonly = TRUE;
		$posts = $this->get_posts('', 'sticky, post_date desc', $limit, $offset, $return_method, $assoc_key);
		return $posts;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns posts grouped by the year/month
	 *
	 * @access	public
	 * @param	int
	 * @param	int
	 * @return	array
	 */
	function get_post_archives($limit = NULL, $offset = NULL)
	{
		$posts = $this->get_posts(array(), 'post_date desc');
		$return = array();
		foreach($posts as $post)
		{
			$key = date('Y/m', strtotime($post->post_date));
			// if ($key != date('Y/m', time()))
			// {
				if (!isset($return[$key]))
				{
					$return[$key] = array();
				}
				$return[$key][] = $post;
			//}
		}
		return $return;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns a single post
	 *
	 * @access	public
	 * @param	mixed	can be id or slug
	 * @param	string
	 * @param	string
	 * @return	object
	 */
	function get_post($post, $order_by = NULL, $return_method = NULL)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_posts_model');
		$this->CI->blog_posts_model->readonly = TRUE;
		$where = $this->_publish_status('blog_posts');
		$tables = $this->CI->config->item('tables');
		if (is_int($post))
		{
			$where[$tables['blog_posts'].'.id'] = $post;
		}
		else
		{
			$where[$tables['blog_posts'].'.slug'] = $post;
		}
		$post = $this->CI->blog_posts_model->find_one($where, $order_by, $return_method);
		return $post;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns the next post (if any) from a given date
	 *
	 * @access	public
	 * @param	object	The current post
	 * @param	string	The return type of the object (array or object)
	 * @return	object
	 */
	function get_next_post($current_post, $return_method = NULL)
	{
		$posts = $this->get_posts(array('post_date >=' => $current_post->post_date, 'id !=' => $current_post->id), 'post_date, id asc', 1, NULL, $return_method);
		if (!empty($posts))
		{
			return $posts[0];
		}
		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns the previous post (if any) from a given date
	 *
	 * @access	public
	 * @param	object	The current post
	 * @param	string	The return type of the object (array or object)
	 * @return	object
	 */
	function get_prev_post($current_post, $return_method = NULL)
	{
		$posts = $this->get_posts(array('post_date <=' => $current_post->post_date, 'id !=' => $current_post->id), 'post_date, id desc', 1, NULL, $return_method);
		if (!empty($posts))
		{
			return $posts[0];
		}
		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns a list of blog categories
	 *
	 * @access	public
	 * @param	mixed
	 * @param	int
	 * @param	int
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function get_categories($where = array(), $order_by = NULL, $limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_categories_model');
		$this->CI->blog_categories_model->readonly = TRUE;
		$tables = $this->CI->config->item('tables');
		$where[$tables['blog_categories'].'.published'] = 'yes';
		
		$categories = $this->CI->blog_categories_model->find_all($where, $order_by, $limit, $offset, $return_method, $assoc_key);
		return $categories;
	}


	// --------------------------------------------------------------------

	/**
	 * Returns a single blog category
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	object
	 */
	function get_category($category, $order_by = NULL, $return_method = NULL)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_categories_model');
		$this->CI->blog_categories_model->readonly = TRUE;
		$tables = $this->CI->config->item('tables');
		$where = $tables['blog_categories'].'.slug = "'.$category.'" OR '.$tables['blog_categories'].'.name = "'.$category.'" AND '.$tables['blog_categories'].'.published = "yes"';
		$categories = $this->CI->blog_categories_model->find_one($where, $order_by, $return_method);
		return $categories;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns a the posts associated with categories
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @param	int
	 * @param	int
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	// function get_posts_to_categories($where = array(), $order_by = NULL, $limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	// {
		// $this->CI->load->module_model(COURSE_FOLDER, 'blog_posts_to_categories_model');
		// $this->CI->blog_posts_to_categories_model->readonly = TRUE;
		// $tables = $this->CI->config->item('tables');
		// $where[$tables['blog_categories'].'.published'] = 'yes';
		// $where[$tables['blog_posts'].'.published'] = 'yes';
		// $where = $this->_publish_status('blog_posts', $where);
		// $this->CI->blog_posts_to_categories_model->db()->group_by('category_id');
		// $posts_to_categories = $this->CI->blog_posts_to_categories_model->find_all($where, $order_by, $limit, $offset, $return_method, $assoc_key);
		// 
		// $CI->load->module_model(FUEL_FOLDER, 'relationships_model');
		// $this->CI->relationships_model->readonly = TRUE;
		// $tables = $this->CI->config->item('tables');
		// $where['candidate_table.published'] = 'yes';
		// $where['foreign_table.published'] = 'yes';
		// $where = $this->_publish_status('blog_posts', $where);
		// $this->CI->relationships_model->db()->group_by('foreign_id');
		// $this->CI->relationships_model->db()->where($where);
		// $this->CI->relationships_model->db()->order_by($order_by);
		// $this->CI->relationships_model->db()->limit($limit);
		// $this->CI->relationships_model->db()->offset($offset);
		// $this->_tables['blog_posts'], $this->_tables['blog_categories']
		// $posts_to_categories = $this->CI->relationships_model->find_by_candidate($this->_tables['blog_posts'], $this->_tables['blog_categories'], $return_method, $assoc_key);
		// 
		// return $posts_to_categories;
	// }

	function get_published_categories()
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_categories_model');
		return $this->CI->blog_categories_model->get_published_categories();
	}

	// --------------------------------------------------------------------

	/**
	 * Searches posts for a specific term
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	int
	 * @param	int
	 * @return	array
	 */
	function search_posts($term, $order_by = 'post_date desc', $limit = NULL, $offset = NULL)
	{
		$this->CI->load->module_model('blog', 'blog_posts_model');
		$this->CI->blog_posts_model->readonly = TRUE;
		
		$tables = $this->CI->config->item('tables');

		// can't use this because of the need to group with parenthesis'
		// $this->CI->blog_posts_model->db()->like('title', $t);
		// $this->CI->blog_posts_model->db()->or_like('content', $t);
		
		$terms = explode(' ', $term);
		$where = '(';
		$cnt = count($terms);
		$i = 0;
		foreach($terms as $t)
		{
			$t = $this->_CI->db->escape_str($t);
			$where .= "(title LIKE '%".$t."%' OR content LIKE '%".$t."%' OR content_filtered LIKE '%".$t."%')";
			if ($i < $cnt - 1) $where .= " AND ";
			$i++;
		}
		$where .= ") AND ".$tables['blog_posts'].".published = 'yes'";
		$posts = $this->CI->blog_posts_model->find_all($where, $order_by, $limit, $offset);
		return $posts;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns comments. Usually specify a post in the where parameter
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @param	int
	 * @param	int
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function get_comments($where = array(), $order_by = 'post_date desc', $limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_comments_model');
		$this->CI->blog_comments_model->readonly = TRUE;
		$tables = $this->CI->config->item('tables');
		$where[$tables['blog_comments'].'.published'] = 'yes';
		$where[$tables['blog_posts'].'.published'] = 'yes';
		$comments = $this->CI->blog_comments_model->find_all($where, $order_by, $limit, $offset, $return_method, $assoc_key);
		return $comments;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns a single comment
	 *
	 * @access	public
	 * @param	int
	 * @return	array
	 */
	function get_comment($id)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_comments_model');
		$this->CI->blog_comments_model->readonly = TRUE;
		$comment = $this->CI->blog_comments_model->find_by_key($id);
		return $comment;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns links
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @param	int
	 * @param	int
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function get_links($where = array(), $order_by = 'precedence desc', $limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_links_model');
		$this->CI->blog_links_model->readonly = TRUE;
		$tables = $this->CI->config->item('tables');
		$where[$tables['blog_links'].'.published'] = 'yes';
		$links = $this->CI->blog_links_model->find_all($where, $order_by, $limit, $offset, $return_method, $assoc_key);
		return $links;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns a FUEL author/user
	 *
	 * @access	public
	 * @param	int
	 * @return	object
	 */
	function get_user($id)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_users_model');
		$this->CI->blog_users_model->readonly = TRUE;
		$where['active'] = 'yes';
		$where['fuel_user_id'] = $id;
		$user = $this->CI->blog_users_model->find_one($where);
		return $user;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns FUEL users/authors
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @param	int
	 * @param	int
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function get_users($where = array(), $order_by = NULL, $limit = NULL, $offset = NULL, $return_method = NULL, $assoc_key = NULL)
	{
		$this->CI->load->module_model(COURSE_FOLDER, 'blog_users_model');
		$this->CI->blog_users_model->readonly = TRUE;
		$where['active'] = 'yes';
		$users = $this->CI->blog_users_model->find_all($where, $order_by, $limit, $offset, $return_method, $assoc_key);
		return $users;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns the logged in information array of the currently logged in FUEL user
	 *
	 * @access	public
	 * @return	mixed
	 */
	function logged_in_user()
	{
		$this->CI->load->module_library(FUEL_FOLDER, 'fuel_auth');
		$valid_user = $this->CI->fuel->auth->valid_user();
		if (!empty($valid_user))
		{
			return $valid_user;
		}
		return NULL;
	}

	// --------------------------------------------------------------------

	/**
	 * Returns whether you are logged into FUEL or not
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @param	int
	 * @param	int
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function is_logged_in()
	{
		$this->CI->load->module_library(FUEL_FOLDER, 'fuel_auth');
		return $this->CI->fuel->auth->is_logged_in();
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns whether cache should be used based on the blog settings
	 *
	 * @access	public
	 * @return	boolean
	 */
	function use_cache()
	{
		$use_cache = (int) $this->config('use_cache');
		return !(empty($use_cache));
	}

	// --------------------------------------------------------------------

	/**
	 * Returns a cached file if it exists
	 *
	 * @access	public
	 * @param	string
	 * @return	mixed
	 */
	function get_cache($cache_id)
	{
		if ($this->use_cache())
		{
			$cache_options =  array('default_ttl' => $this->config('cache_ttl'));
			$this->CI->load->library('cache', $cache_options);
			$cache_group = $this->CI->config->item('blog_cache_group');

			if ($this->use_cache() AND $this->CI->cache->get($cache_id, $cache_group, FALSE))
			{
				$output = $this->CI->cache->get($cache_id, $cache_group);
				return $output;
			}
		}
		return FALSE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Saves output to the cache
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	function save_cache($cache_id, $output)
	{
		if ($this->use_cache())
		{
			$cache_options =  array('default_ttl' => $this->config('cache_ttl'));
			$this->CI->load->library('cache', $cache_options);

			$cache_group = $this->CI->config->item('blog_cache_group');

			// save to cache
			$this->CI->cache->save($cache_id, $output, $cache_group, $this->config('cache_ttl'));
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Removes page from cache
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	function remove_cache($cache_id = NULL)
	{
		if ($this->use_cache())
		{
			$this->CI->load->library('cache');

			$cache_group = $this->CI->config->item('blog_cache_group');

			// save to cache
			if (!empty($cache_id))
			{
				$this->CI->cache->remove($cache_id, $cache_group);
			}
			else
			{
				$this->CI->cache->remove_group($cache_group);
			}
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns the page title
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function page_title($title = '', $sep = NULL, $order = 'right')
	{
		$title_arr = array();
		if (!isset($sep))
		{
			$sep = $this->config('page_title_separator');
		}
		if ($order == 'left') $title_arr[] = $this->config('title');
		if (is_array($title))
		{
			foreach($title as $val)
			{
				$title_arr[] = $val;
			}
		}
		else if (!empty($title))
		{
			array_push($title_arr, $title);
		}
		if ($order == 'right') $title_arr[] = $this->config('title');
		return implode($sep, $title_arr);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Runs a specific blog hook
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @return	string
	 */
	function run_hook($hook, $params = array())
	{
		// call module specific hook
		$hook_name = 'blog_'.$hook;
		$GLOBALS['EXT']->_call_hook($hook_name, $params);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Convenience magic method if you want to drop the "get" from the method
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @return	string
	 */
	function __call($name, $args)
	{
		$method = 'get_'.$name;
		if (method_exists($this, $method))
		{
			return call_user_func_array(array($this, $method), $args);
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns where condition based on the users logged in state
	 *
	 * @access	protected
	 * @param	string
	 * @param	mixed
	 * @return	array
	 */
	protected function _publish_status($t = 'blog_posts', $where = array())
	{
		$this->CI->load->module_helper(FUEL_FOLDER, 'fuel');
		$tables = $this->CI->config->item('tables');
		
		if (!is_fuelified())
		{
			if (empty($where) OR is_array($where))
			{
				$where[$tables[$t].'.published'] = 'yes';

				// don't show posts in the future'
				if ($t == 'blog_posts')
				{
					$where[$tables[$t].'.post_date <= '] = datetime_now();
				}
			}

			// commented out because it needs to be an array syntax for now
			else
			{
			//	$where .= ' AND '.$tables[$t].'.published = "yes"';

				// don't show posts in the future'
				if ($t == 'blog_posts')
				{
				//	$where .= ' AND '.$tables[$t].'.post_date <= "'.datetime_now().'"';
				}
			}
		}
		return $where;
	}
	
	
	
}

/* End of file Fuel_blog.php */
/* Location: ./modules/blog/libraries/Fuel_blog.php */
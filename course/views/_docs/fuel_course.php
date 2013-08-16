<h1>fuel->course Class</h1>

<p>The main class used to marshal information to the course.</p>

<p>This helper is loaded using the following code:</p>

<pre class="brush: php">
$this->load->module_library(BLOG_FOLDER, 'fuel->course');
</pre>

<p>The following function is available:</p>

<h2>$this->fuel->course->title()</h2>
<p>Returns the title of the course specified in the settings.</p>


<h2>$this->fuel->course->description()</h2>
<p>Returns the descripton of the course specified in the settings.</p>


<h2>$this->fuel->course->language(<var>'[code]'</var>)</h2>
<p>Returns the language code based on the language currently set in CodeIgniter config. If <dfn>code</dfn> is set to TRUE, then it will return the full language code.</p>


<h2>$this->fuel->course->domain()</h2>
<p>Returns the domain to be used for the course based on the FUEL configuration. If empty it will return whatever $_SERVER['SERVER_NAME']. Needed for Atom feeds.</p>


<h2>$this->fuel->course->url(<var>'uri'</var>)</h2>
<p>Returns the course specific URL.</p>


<h2>$this->fuel->course->feed(<var>'[type]'</var>, <var>'[category]'</var>)</h2>
<p>Returns the course specific RSS feed URL.</p>


<h2>$this->fuel->course->feed_header()</h2>
<p>Sets the HTTP headers needed for the RSS feed.</p>


<h2>$this->fuel->course->feed_output(<var>'[type]'</var>, <var>'[category]'</var>)</h2>
<p>Returns the output for the RSS feed.</p>


<h2>$this->fuel->course->feed_data(<var>[limit]</var>, <var>[category]</var>)</h2>
<p>Returns the data need for the course feed.</p>


<h2>$this->fuel->course->last_updated()</h2>
<p>Returns last updated course post.</p>


<h2>$this->fuel->course->theme_path()</h2>
<p>Returns the path to the theme view files.</p>


<h2>$this->fuel->course->layout()</h2>
<p>Returns name of the theme layout file to use.</p>


<h2>$this->fuel->course->settings(<var>[key]</var>)</h2>
<p>Returns the setting(s) information.</p>


<h2>$this->fuel->course->header(<var>[vars]</var>, <var>[return]</var>)</h2>
<p>Returns header of the course.
The <dfn>vars</dfn> parameter is an array of variables to pass to the header view file.
The <dfn>return</dfn> parameter determines whether to echo the output or just return a string
</p>


<h2>$this->fuel->course->view(<var>'view'</var>, <var>[vars]</var>, <var>[return]</var>)</h2>
<p>Returns a view for the course.
The <dfn>vars</dfn> parameter is an array of variables to pass to the header view file.
The <dfn>return</dfn> parameter determines whether to echo the output or just return a string
</p>


<h2>$this->fuel->course->block(<var>'block'</var>, <var>[vars]</var>, <var>[return]</var>)</h2>
<p>Returns a block view file for the course. Block files must be located in the themes <dfn>_blocks</dfn> view folder.
The <dfn>vars</dfn> parameter is an array of variables to pass to the header view file.
The <dfn>return</dfn> parameter determines whether to echo the output or just return a string
</p>

<h2>$this->fuel->course->model(<var>'[model]'</var>)</h2>
<p>Returns a the specified course model object. Options are posts, categories, comments, settings and links.</p>

<h2>$this->fuel->course->sidemenu(<var>'[blocks]'</var>)</h2>
<p>Returns the sidemenu for the course. The blocks parameter is an array of names to block files to include. The default is the search and categories block files.</p>


<h2>$this->fuel->course->get_posts_count(<var>[where]</var>)</h2>
<p>Returns the number of posts. If the <dfn>where</dfn> parameter is provided, then it will add that to the where condition of the query.</p>


<h2>$this->fuel->course->get_recent_posts(<var>[limit]</var>)</h2>
<p>Returns the most recent posts. The default limit is 5.</p>


<h2>$this->fuel->course->get_category_posts(<var>'[category]'</var>, <var>'[order_by]'</var>, <var>[limit]</var>, <var>[offset]</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns the most recent posts for a given category.</p>


<h2>$this->fuel->course->get_posts_by_date(<var>[year]</var>, <var>[month]</var>, <var>[day]</var>, <var>[permalink]</var>, <var>[where]</var>, <var>[limit]</var>, <var>[offset]</var>, <var>'[order_by]'</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns posts by providing a given date.</p>


<h2>$this->fuel->course->get_posts(<var>[where]</var>, <var>'[order_by]'</var>, <var>[limit]</var>, <var>[offset]</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns posts based on specific query parameters.</p>


<h2>$this->fuel->course->get_posts_by_page(<var>[limit]</var>, <var>[offset]</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns posts to be displayed for a specific page. Used for pagination mostly.</p>


<h2>$this->fuel->course->get_post_archives(<var>[limit]</var>, <var>[offset]</var>)</h2>
<p>Returns posts grouped by the year/month.</p>


<h2>$this->fuel->course->get_post(<var>[post]</var>, <var>'[order_by]'</var>, <var>'[return_method]'</var>)</h2>
<p>Returns a single post. The post parameter can be either the permalink value or the post's id.</p>


<h2>$this->fuel->course->get_next_post(<var>post_date</var>, <var>'[return_method]'</var>)</h2>
<p>Returns the next post (if any) from a given date.</p>


<h2>$this->fuel->course->get_previous_post(<var>post_date</var>, <var>'[return_method]'</var>)</h2>
<p>Returns the previous post (if any) from a given date.</p>


<h2>$this->fuel->course->get_categories(<var>[where]</var>, <var>'[order_by]'</var>, <var>[limit]</var>, <var>[offset]</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns a list of course categories.</p>


<h2>$this->fuel->course->get_category(<var>[category]</var> <var>'[order_by]'</var>, <var>'[return_method]'</var>)</h2>
<p>Returns a single course category.</p>


<h2>$this->fuel->course->get_posts_to_categories(<var>[where]</var>, <var>'[order_by]'</var>, <var>[limit]</var>, <var>[offset]</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns a the posts associated with categories.</p>


<h2>$this->fuel->course->search_posts(<var>term</var> <var>'[order_by]'</var>, <var>[limit]</var>, <var>[offset]</var>)</h2>
<p>Searches posts for a specific term.</p>


<h2>$this->fuel->course->get_comments(<var>[where]</var>, <var>'[order_by]'</var>, <var>[limit]</var>, <var>[offset]</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns a comments from posts based on the where condition.</p>

<h2>$this->fuel->course->get_comments(<var>[where]</var>, <var>'[order_by]'</var>, <var>[limit]</var>, <var>[offset]</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns a single comment.</p>

<h2>$this->fuel->course->get_links(<var>[where]</var>, <var>'[order_by]'</var>, <var>[limit]</var>, <var>[offset]</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns links.</p>


<h2>$this->fuel->course->get_user(<var>id</var>)</h2>
<p>Returns a FUEL author/user.</p>


<h2>$this->fuel->course->get_users(<var>[where]</var>, <var>'[order_by]'</var>, <var>[limit]</var>, <var>[offset]</var>, <var>'[return_method]'</var>, <var>'[assoc_key]'</var>)</h2>
<p>Returns FUEL users/authors.</p>


<h2>$this->fuel->course->logged_in_user()</h2>
<p>Returns the logged in information array of the currently logged in FUEL user.</p>


<h2>$this->fuel->course->is_logged_in()</h2>
<p>Returns whether you are logged into FUEL or not.</p>


<h2>$this->fuel->course->use_cache()</h2>
<p>Returns whether cache should be used based on the course settings.</p>


<h2>$this->fuel->course->get_cache(<var>'cache_id'</var>)</h2>
<p>Returns a cached file if it exists.</p>


<h2>$this->fuel->course->get_cache(<var>'cache_id'</var>)</h2>
<p>Returns a cached file if it exists.</p>


<h2>$this->fuel->course->save_cache(<var>cache_id</var>, <var>'output'</var>)</h2>
<p>Saves output to the cache.</p>


<h2>$this->fuel->course->remove_cache(<var>'[cache_id]'</var>)</h2>
<p>Removes page from cache. If no <dfn>cache_id</dfn> is provided, then all the course cache is removed.</p>


<h2>$this->fuel->course->page_title(<var>'[title]'</var>, <var>'[sep]'</var>, <var>'[order]'</var>)</h2>
<p>Returns the page title.
The <dfn>title</dfn> parameter can be either a string or an array.
The <dfn>sep</dfn> parameter is the delimiter to use between parts of the title. The default <dfn>sep</dfn> value is &laquo;.
The <dfn>order</dfn> parameter determines whether the page title should go in ascending or descending order (right to left or left to right).
 Values can be <dfn>right</dfn> or <dfn>left</dfn>. Default is <dfn>right</dfn>.
</p>

<h2>$this->fuel->course->run_hook(<var>'[hook]'</var>, <var>[params]</var>)</h2>
<p>Runs a specific course hook
The <dfn>hook</dfn> course_before_posts_by_date, course_before_posts_by_page, course_before_post, course_before_category and course_before_author.
The <dfn>params</dfn> parameter are parameters passed to each hook (varies for each hook).
</p>

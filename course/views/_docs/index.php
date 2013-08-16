<h1>Course Documentation</h1>
<p>This Course documentation is for version <?=BLOG_VERSION?>.</p>

<h2>Overview</h2>
<p>The FUEL Course is a module that allows you to manage lessons and articles for courses</p>

<h2>Installation</h2>
<p>The following are the steps to configuring the FUEL Course module:</p>
<ol>
	<li>Add course folder to fuel/modules/</li>
	<li>Add the module name to array of modules_allowed
		<code>
		$config['modules_allowed'] = array(
			'user_guide',
			'blog',
			'course',
		);
		</code>
	</li>
	<li>Import tables with the query located at <b>modules/course/install/fuel_course_install.sql</b></li>
</ol>

<h2>Uninstallation</h2>
<ol>
	<li>Remove course folder form fuel modules folder</li>
	<li>Remove course from modules_allowed list</li>
	<li>Run the query on <b>modules/course/install/fuel_course_uninstall.sql</b></li>	
</ol>

<h2>Configuration Info</h2>
<ol>
	<li><b>config/course_fuel_modules.php</b> is the main configuration file which holds config of module.
	Configuration is provided with each database table info to do CRUD operation.
	</li>
	<li>Admin Navigation for this module is loaded from configuration file on <b>course/config/course.php</b></li>
	<li>constants for the module is on <b>course/config/course_constants.php</b></li>
</ol>

<h2>Module Info</h2>
<ol>
	<li>Module is advanced module which is called opt-in contraller in FUEL terms.</li>
	<li>The module uses main layout of <b>application/views/_layouts</b></li>
	<li>There are 4 tables used in this module : 
	<ul>
		<li><b>default_course: </b> This table contains information of courses</li>
		<li><b>default_lessons: </b> This table contains information of lessons on a course</li>
		<li><b>default_articles: </b> This table contains articles of lessons which is capable of redirecting to other website if the article type is "link"</li>
		<li><b>default_authors: </b> This table contains author informations</li>
	</ul>
	</li>
</ol>

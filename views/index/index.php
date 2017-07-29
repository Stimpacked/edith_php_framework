<?php
/**
 * View for index
 * 
 */
$edith['title'] = 'Welcome' . EDITH_TITLE;

$edith['main'] = <<<EOD

<div class="content-wrapper">
<div id="front-content">
	<h1 class="front-heading"><span class="sub-heading">Hello,</span><br />this is Edith!</h1>

	<p class="front-intro">Edith is a light-weight PHP framework built on the principles of MVC, built by <strong>Stefan Sjönnebring</strong>.</p>

	<h2>Installation</h2>
	<p>Installing Edith on your server is really simple. Copy the edith-folder into your htdocs/www-folder or whatever directory you need to run it from. Make sure you have <strong>mod_rewrite rule</strong> activated by uncommenting this line in your apache config-file (usual path: yourApachePath/conf/httpd.conf). This is essential for the htaccess-file to rewrite the url.</p>
	<p>You can import the supplied sql-file or your own into your MySQL database to access a database. Once a database is created, connect to it by editing the config-file (config.php) in the Edith root-folder.

<pre>
// Define Database-related settings
define('EDITH_DB_HOST',	'localhost');		// Servername
define('EDITH_DB_USER', 'root');		// Database username
define('EDITH_DB_PASS', 'root');		// Database password
define('EDITH_DB_NAME',	'db');			// Database name</pre>

	<h2>Creating a page</h2>
	<p>As Edith follows the principles of the MVC architectural pattern, each page consists of a Model, View and Controller. The <strong>Model</strong> handles domain and data logic, like retrieving rows from a database. The <strong>View</strong> consists of the user interface and the visual representation of the page. And last but not least, the <strong>Controller</strong>, which handles user inputs and logic. In other words, the controller tells the Model what to fetch and not in order to update the View accordingly.</p>
	<p>First off, we need a <strong>controller</strong> for the given page, by creating a new php-file inside the controllers-folder (edith/controllers). By creating a child of the base controller (By using the keyword "extend") we can inherit the methods of the parent, which will be essential for every controller in order to access various framework-wide methods, such as rendering a view or loading a model. The method index() will always be the default method called for each controller. So in the example below, where we have a controller called "Contact", the method that will be called by default when the user visits the url <i>"yourwebsite.com/contact"</i> is index(). We can add additional methods to a controller which will be called in the same fashion but instead by also adding the method name into the url, like <i>"yourwebsite.com/contact/method"</i>. We can even call a specific method with a parameter by doing this: <i>"yourwebsite.com/contact/method/parameter"</i>. This is due to the bootstrap-file located in the lib-folder and the url rewriting with the htaccess-file.<br />
	And as we can see inside the index method, we are calling upon another method called render (Which we inherited from the parent class) which is used to render a view for this controller.</p>
<pre>
class Contact extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		&#36;this->view->render('contact/index');	
	}		
}</pre>

<p>So now we need to create a <strong>view</strong> in order to have a visual representation of this webpage for the visitor. We can do this by creating a new folder within the views-folder called contact and then a php-file called index within this folder (edith/views/contact/index.php). The reason for using a separate folder for each page is because we can assign multiple views to the same controller, by calling the render method from different methods within the given controller. The variable "&#36;edith['main']" contains all the HTML that you want to be rendered on page.</p>
<pre>
&#36;edith['title'] = 'Contact' . EDITH_TITLE;

&#36;edith['main'] = "&#60;h1&#62;Contact&#60;/h1&#62;"</pre>

<p>If the page requires to fetch data from a database we need to assign a model to the given page, this is optional and only necessary if the page needs to retrieve some sort of data. In order to create a new model, simply create a new php file in the models directory with the same name as the assigned controller and also adding "_model" to the end of the filename (example: contact_model.php)</p>
<p>To establish a connection to the database, the model needs to inherit the database object from it's parent (Just like the controller inherits properties from it's parents aswell). Then, simply create your own methods to fetch the desired data via the database-object inherited from the parent-class.</p>

<pre>
class Contact_Model extends Model {

	public function __construct()
	{
		parent::__construct();	
	}

	public function getContactInfo()
	{
		&#36;this->db->query("SELECT * FROM `topics`");

		&#36;result = &#36;this->db->resultset();

		return &#36;result;
	}
}
</pre>
<p>Once a method is created in the model, call upon it from the controller with the same name, and either store the result inside a variable or pass the data to the view.</p>

<pre>
// Access the data in the controller
&#36;this->model->getContactInfo();

<span class='comment'>// Or pass it to the view</span>
&#36;this->view->contactInfo = &#36;this->model->getContactInfo();
</pre>

	<h2>Additional notes</h2>
	<p><strong>CSS</strong> - To add a stylesheet, simply place it in the css-folder (edith/public/css/) and it will be automatically added to the header of the template file.</p>
	<p><strong>JavaScript</strong> - To add JavaScript to a certain page, place your javascript-files inside the js-folder (edith/public/js/) and then simply pass the following variable to the view via the controller:
	<pre>
&#36;this->view->js = array('public/js/myScript.js', 'mySecondScript.js');</pre></p>

</div>
</div>
EOD;
?>
<?php
/**
 * Bootstrap
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Bootstrap {


    /**
 	 * Class constructor
 	 *
 	 * Calls the proper controller for each page based on the URL
 	 * 
 	 * @return void
 	 *
 	 */
	public function __construct()
	{

		// URL cleanup
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);

		if(empty($url[0]))
		{
			require_once('controllers/index.php');
			$controller = new Index();
			$controller->index();
			return false;
		}

		$file = 'controllers/' . $url[0] . '.php';
		if(file_exists($file))
		{
			require_once($file);
		}
		else
		{
			$this->error();
			return false;
		}

		$controller = new $url[0];
		$controller->loadModel($url[0]);

		// If a parameter is sent via URL
		if(isset($url[2]))
		{
			if(method_exists($controller, $url[1]))
			{
				$controller->{$url[1]}($url[2]);
			}
			else
			{
				$this->error();
			}
		}
		// If a method is called via URL
		elseif(isset($url[1]))
		{
			if (method_exists($controller, $url[1]))
			{
					$controller->{$url[1]}();
			}
			else
			{
				$this->error();
			}
		}
		// Default call via URL
		else
		{
			$controller->index();	
		}
	}

	/**
     * Error-handler
     *
     */
	function error() 
	{
		require_once('controllers/error.php');
		$controller = new Error();
		$controller->index();
		return false;
	}
	
}

<?php
/**
 * The base controller
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Controller
{
	function __construct()
	{	
		require_once('config.php');
		$this->view = new View();
		Session::init(); 
	}

    /**
     * Load the correct model
     *
     * @param $name String
     */
	public function loadModel($name)
	{
		$path = 'models/' . $name . '_model.php';

		if(file_exists($path))
		{
			require_once('models/' . $name . '_model.php');
			$modelName = $name . '_Model';
			$this->model = new $modelName();
		}
	}	
}

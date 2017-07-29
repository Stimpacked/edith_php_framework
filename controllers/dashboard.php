<?php
/**
 * Dashboard-page controller
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Dashboard extends Controller
{

	function __construct()
	{
		parent::__construct();
					// Initiate the session
		$logged = Session::get('loggedIn');
		if($logged == false)					// Not logged in?
		{
			Session::destroy();
			if(isset($_GET['url'][1]))
			{
				header('location: ../login');
			} 
			else
			{
				header('location: mvc/login');
			}
			exit;
		}
		//$this->view->js = array('public/js/test.js');
	}

	public function index()
	{
		//echo 'INSIDE INDEX';
		$this->view->render('dashboard/index');	
	}

	public function logout()
	{
		Session::destroy();
		header('location: mvc/login');
		exit;
	}

}
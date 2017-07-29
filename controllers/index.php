<?php
/**
 * Index-page controller
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Index extends Controller
{

	function __construct()
	{
		parent::__construct();
		$logged = Session::get('loggedIn');
	}
	
	public function index()
	{
		//echo 'INSIDE INDEX';
		$this->view->render('index/index');	
	}
		
}
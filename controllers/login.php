<?php
/**
 * Login-page controller
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Login extends Controller 
{

	public function __construct() 
	{
		parent::__construct();
	}

	public function index() 
	{
		$this->view->render('login/index');	
	}

	/**
     * Authenticate login
     *
     */
	public function authenticate()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = $this->model->login($username);
		$count = count($result);

		if($count > 0 )
		{
			if(password_verify($password, $result['password']))
			{
				Session::init();
				Session::set('role', $result['role']);
				Session::set('id', $result['id']);
				Session::set('username', $result['username']);
				Session::set('loggedIn', true);
				header('location: ../dashboard');
			}
			else 
			{
				header('location: ../login');
			}
		}
		else 
		{
			header('location: ../login');
		}
		
	}
	
}
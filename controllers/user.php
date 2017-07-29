<?php
/**
 * User-page controller
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class User extends Controller
{

	public function __construct()
	{
		parent::__construct();						// Initiate the session
		$logged = Session::get('loggedIn');
		$role = Session::get('role');
		if($logged == false || $role != 'admin')					// Not logged in?
		{
			Session::destroy();
			if(isset($_GET['url'][1]))
			{
				header('location: ../login');
			} 
			else
			{
				header('location: login');
			}
			exit;
		}
	}

	public function index()
	{
		//echo 'INSIDE INDEX';
		$this->view->userList = $this->model->getAllUsers();
		$this->view->render('user/index');	
	}

	public function create()
	{
		$data = array();
		$data['username']	= $_POST['username'];
		$data['password']	= password_hash($_POST['password'], PASSWORD_DEFAULT);
		$data['role']		= $_POST['role'];

		$this->model->create($data);
		header('Location: ../user');

	}

	public function edit($id)
	{
		// Get the user
		$this->view->user = $this->model->getUser($id);
		$this->view->render('user/edit');
		
	}

	public function editSave($id)
	{
		$data = array();
		$data['id']	= $id;
		$data['username']	= $_POST['username'];
		$data['password']	= password_hash($_POST['password'], PASSWORD_DEFAULT);
		$data['role']		= $_POST['role'];
		$this->model->editSave($data);
		header('Location: ../../user');
	}

	public function delete($id)
	{
		$this->model->delete($id);
		header('Location: ../../user');
	}
		
}
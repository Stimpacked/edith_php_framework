<?php
/**
 * Login-page controller
 *
 * @author Stefan Sjönnebring
 * 
 */
class Topics extends Controller 
{

	public function __construct() 
	{
		parent::__construct();
	}

	public function index($cat = null) 
	{
		$this->view->topics = $this->model->getTopics($cat);
		$this->view->render('topics/index');	
	}

	public function topic($id)
	{
		$this->view->topic = $this->model->getTopic($id);

		$this->view->replies = $this->model->getReplies($id);
		$this->view->render('topics/topic');
	}

	public function create()
	{
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
		else
		{
			$this->view->categories = $this->model->getCategories();
			$this->view->render('topics/create');
		}
	}

	public function saveTopic()
	{
		$data = array();
		$data['title']		= $_POST['title'];
		$data['content']	= $_POST['content'];
		$data['category']	= $_POST['category'];
		$data['id']			= $_SESSION['id'];

		$this->model->createTopic($data);
		header('Location: ../topics');
	}

	public function reply($id)
	{
		$logged = Session::get('loggedIn');
		$user_id = Session::get('id');
		$username = Session::get('username');
		if($logged == false)					// Not logged in?
		{
			Session::destroy();
			header('location: ../../login');
			exit;
		} 
		else
		{
			$data = array();
			$data['topic_id']		= $id;
			$data['reply_author']	= $user_id;
			$data['reply_content']	= $_POST['reply_content'];
			$data['reply_username']	= $username;

			$this->model->createReply($data);
			header("Location: ../topic/{$id}");
		}
	}

	public function edit($id)
	{	
		$topic 	 = $this->model->getTopic($id);
		$author  = $topic[2][0]['id'];
		$user_id = Session::get('id');
		$role 	 = Session::get('role');

		if($user_id == $author || $role == "admin")
		{
			$this->view->topic = $this->model->getTopic($id);
			$this->view->categories = $this->model->getCategories();
			$this->view->render('topics/edit');
		}
		else
		{
			Session::destroy();
			header('location: ../../login');
			exit;
		}

	}

	public function editSave($id)
	{

		$topic 	 = $this->model->getTopic($id);
		$author  = $topic[2][0]['id'];
		$user_id = Session::get('id');
		$role 	 = Session::get('role');

		if($user_id == $author || $role == "admin")
		{
			$data = array();
			$data['id'] = $id;
			$data['title'] = $_POST['title'];
			$data['content'] = $_POST['content'];
			$data['category'] = $_POST['category'];
			$this->model->editSave($data);
			header('Location: ../topic/'.$id);
		} 
		else 
		{
			header('location: ../login');
		}
	}

	public function delete($id)
	{
		$topic 	 = $this->model->getTopic($id);
		$author  = $topic[2][0]['id'];
		$user_id = Session::get('id');
		$role 	 = Session::get('role');

		if($user_id == $author || $role == "admin")
		{
			$this->view->topic = $this->model->getTopic($id);
			$this->view->render('topics/delete');
		} 
		else 
		{
			header('location: ../login');
		}
	}

	public function deleteSave($id)
	{
		$topic 	 = $this->model->getTopic($id);
		$author  = $topic[2][0]['id'];
		$user_id = Session::get('id');
		$role 	 = Session::get('role');

		if($user_id == $author || $role == "admin")
		{
			$this->model->deleteTopic($id);
			header('Location: ../../topics');
		} 
		else 
		{
			header('location: ../login');
		}
	}
	
}
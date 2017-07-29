<?php
/**
 * Login-page Model
 *
 * @author: Stefan Sjönnebring
 * 
 */
class Login_Model extends Model
{

	public function __construct()
	{
		parent::__construct();	
	}

    /**
     * Select matched user and password from DB
     *
     * @return array | SQL result
     */
	public function login($username)
	{
		$this->db->query("SELECT * FROM `users` WHERE `username` = :username");
		$this->db->bind(':username', $username);
		$result =  $this->db->single();
		return $result;
	}
}
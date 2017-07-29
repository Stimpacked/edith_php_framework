<?php
/**
 * User-page Model
 *
 * @author: Stefan Sjönnebring
 * 
 */
class User_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
     * Get all users from db
     *
     * @return array | SQL result
     */
	public function getAllUsers()
	{
		$sql =  $this->db->query("SELECT `id`, `username`, `role` FROM `users`");
		$result = $this->db->resultset();
		return $result;
	}

	/**
     * Get a specific user
     *
     * @return array | SQL result
     */
	public function getUser($id)
	{
		$sql =  $this->db->query("SELECT `id`, `username`, `role`, `password` FROM `users` WHERE `id`={$id}");
		$result = $this->db->resultset();
		return $result;
	}

	/**
     * Store a new topic in the db
     *
     * @param array | user data
     */
	public function create($data)
	{
		$username = $data['username'];
		$password = $data['password'];
		$role	  = $data['role'];

		 $this->db->query("INSERT INTO users (`username`, `password`, `role`)
				VALUES (:username, :password, :role)");

		$this->db->bind(':username', $username);
		$this->db->bind(':password', $password);
		$this->db->bind(':role', $role);

		$this->db->execute();
	}

	/**
     * Save changes to user
     *
     * @param array | user data
     */
	public function editSave($data)
	{
		$id		  = $this->db->db_quote($data['id']);
		$username = $this->db->db_quote($data['username']);
		$role	  = $this->db->db_quote($data['role']);
		$password = $this->db->db_quote($data['password']);

		$sql = "UPDATE users SET `username` = $username, `role` = $role, `password` = $password WHERE `id` = $id ";
		$result = $this->db->db_query($sql);
	}


	/**
     * Delete a user
     *
     * @param string | user id
     */
	public function delete($id)
	{
		$this->db->query("DELETE FROM `users` WHERE `id` = {$id}");
		$this->db->execute();
	}

}
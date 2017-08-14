<?php
/**
 * Index-page model
 *
 * @author Stefan Sjönnebring
 * 
 */
class Topics_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
	}	

	public function countAllTopics() 
	{
		$stmt = $this->db->query("SELECT * FROM `topics`");
		$result = $this->db->resultSet();
		$result = count($result);
		return $result;
	}
	/**
     * Select all topics in db
     *
	 * @param $catId, string | optional category id
	 * @param $page, string | optional page number
	 *
     * @return array | SQL result
     */
	public function getTopics($catId = null, $page = null)
	{
		$param = "";
		$offset = 0;
		if(!$page == null) {
			$offset = ($page-1) * 20;
		}
		$limit = 20;

		
		if($catId != null) {
			$param = "WHERE `topic_cat` = {$catId}";
		}

		$this->db->query("SELECT * FROM `topics` {$param} ORDER BY `topic_date` DESC LIMIT 20 OFFSET {$offset}");
		$this->db->bind(':offset', $offset);
		$result = $this->db->resultset();

		$count = count($result);

		// Get additional info for each topic, and push the array
		for($i=0; $i<$count; $i++) {
			$id = $result[$i]['topic_author'];
			$cat_id = $result[$i]['topic_cat'];

			// Get username
			$sql2 = $this->db->query("SELECT `username` FROM `users` WHERE `id` = {$id}");
			$result2 = $this->db->resultset();
			$username = $result2[0]['username'];

			// Get category
			$sql3 = $this->db->query("SELECT `cat_name` from `categories` WHERE `cat_id` = {$cat_id}");
			$result3 = $this->db->resultset();
			$category = $result3[0]['cat_name'];

			$date = $result[$i]['topic_date'];

			$replies = $this->getReplies($result[$i]['topic_id']);
	
			$countReplies = count($replies);

			if($countReplies > 0) {
				$end = end($replies);
				$date = $end['reply_date'];
			}
			$time = $this->calcTime(strtotime($date));
			
			array_push($result[$i], $username); // Username of author
			array_push($result[$i], $countReplies); // Amount of replies
			array_push($result[$i], $date);	// Date of latest update
			array_push($result[$i], $time);	// Time since update
			array_push($result[$i], $category);	// Category
		}

		$this->sortByColumn($result, '2');

		return $result;
	}

	/**
     * Select a specific topic from the db
     *
     * @param &$arr array | reference original array
     * @param $col string | column to sort by
     * @param $dir mixed  | sort order
     * @return array | combined SQL results
     */
	public function sortByColumn(&$arr, $col, $dir = SORT_DESC)
	{
		$sort_col = array();
		foreach($arr as $key => $row)
		{
			$sort_col[$key] = $row[$col];
		}
		array_multisort($sort_col, $dir, $arr);
	}


	/**
     * Select a specific topic from the db
     *
     * @param string | id of topic
     * @return array | combined SQL results
     */
	public function getTopic($id)
	{
		// Fetch topic
		$sql 	= $this->db->query("SELECT * FROM `topics` WHERE `topic_id` = {$id}");
		$result = $this->db->resultset();

		$catId 	= $result[0]['topic_cat'];
		$userId = $result[0]['topic_author'];

		// Fetch category
		$category = $this->getCategory($catId);

		// Fetch user
		$username = $this->getUser($userId);

		$data = array($result, $category, $username);
		return $data;
	}

	public function getCategory($id)
	{
		$this->db->query("SELECT `cat_id`, `cat_name` FROM `categories` WHERE `cat_id` = {$id}");
		$result = $this->db->resultset();
		return $result;
	}

	public function getUser($id)
	{
		$this->db->query("SELECT `id`, `username` FROM `users` WHERE `id` = {$id}");
		$result = $this->db->resultset();
		return $result;
	}

	/**
     * Store a new topic in the db
     *
     * @param array | topic data
     */
	public function createTopic($data)
	{
		$topic_title	= $data['title'];
		$topic_content	= $data['content'];
		$topic_category = $data['category'];
		$author_id		= $data['id'];

		$this->db->query("INSERT INTO `topics` (`topic_title`, `topic_content`, `topic_cat`, `topic_author`) VALUES (:title, :content, :category, :id)");

		$this->db->bind(':title', $topic_title);
		$this->db->bind(':content', $topic_content);
		$this->db->bind(':category', $topic_category);
		$this->db->bind(':id', $author_id);

		$this->db->execute();
	}

	/**
     * Get all categories
     *
     * @return array | SQL result
     */
	public function getCategories()
	{
		$sql = "SELECT * FROM `categories`";
		$this->db->query("SELECT * FROM `categories`");
		$result = $this->db->resultset();
		return $result;
	}

	/**
     * Get all replies for a specific topic
     *
     * @return array | SQL result
     */
	public function getReplies($id)
	{
		$this->db->query("SELECT * FROM `replies` WHERE `reply_topic` = {$id}");
		$result = $this->db->resultset();
		return $result;
	}

	/**
     * Create a reply for a specific topic
     *
     * @param array | reply data
     */
	public function createReply($data)
	{
		$reply_content	= $data['reply_content'];
		$reply_topic	= $data['topic_id'];
		$reply_author	= $data['reply_author'];
		$reply_username	= $data['reply_username'];

		$this->db->query("INSERT INTO `replies` (`reply_content`, `reply_topic`, `reply_author`, `reply_username`) VALUES (:content, :topic, :author, :username)");

		$this->db->bind(':content', $reply_content);
		$this->db->bind(':topic', $reply_topic);
		$this->db->bind(':author', $reply_author);
		$this->db->bind(':username', $reply_username);

		$this->db->execute();
	}

	/**
     * Save changes to topic
     *
     * @param array | topic data
     */
	public function editSave($data)
	{
		$id			= $data['id'];
		$title 		= $data['title'];
		$content 	= $data['content'];
		$category 	= $data['category'];

		$this->db->query("UPDATE `topics` SET `topic_title` = :title, `topic_content` = :content, `topic_cat` = :category WHERE `topic_id` = :id}");

		$this->db->bind(':title', $title);
		$this->db->bind(':content', $content);
		$this->db->bind(':category', $category);
		$this->db->bind(':id', $id);

		$this->db->execute();
	}

	/**
     * Delete a specifik topic
     *
     * @param string | topic id
     */
	public function deleteTopic($id)
	{
		$id = $this->db->db_quote($id);
		$sql = "DELETE FROM `replies` WHERE `reply_topic` = {$id}";
		$result = $this->db->db_query($sql);

		$sql2 = "DELETE FROM `topics` WHERE `topic_id` = {$id}";
		$result = $this->db->db_query($sql2);
	}

	/**
     * Calculate time between two dates
     *
     * @param string | datetime
     */
	public function calcTime($time)
	{
		$time = time() - $time; // to get the time since that moment
    	$time = ($time<1)? 1 : $time;
		$tokens = array (
        	31536000 => 'year',
        	2592000 => 'month',
        	604800 => 'week',
        	86400 => 'day',
        	3600 => 'hour',
        	60 => 'minute',
        	1 => 'second'
    	);

    	foreach ($tokens as $unit => $text) {
        	if ($time < $unit) continue;
        	$numberOfUnits = floor($time / $unit);
        	return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    	}
	}

}
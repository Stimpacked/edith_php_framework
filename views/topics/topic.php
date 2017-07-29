<?php
/**
 * View for a specific topic
 * 
 */
//print_r($this->replies);

$topic_id = $this->topic[0][0]['topic_id'];
$topic_title = $this->topic[0][0]['topic_title'];
$topic_content = $this->topic[0][0]['topic_content'];
$topic_date = $this->topic[0][0]['topic_date'];
$topic_cat = $this->topic[1][0]['cat_name'];
$topic_auth = $this->topic[2][0]['username'];

$replies = "";

	$edit = "";
	$delete = "";
	if(isset($_SESSION['id']) || isset($_SESSION['role'])) {
		if($_SESSION['id'] == $topic_id || $_SESSION['role'] == "admin")
		{
			$edit = "<a href='../edit/$topic_id' class='topic-btn'>Edit</a>";
			$delete = "<a href='../delete/$topic_id' class='topic-btn'>Delete</a>";
		}
	}


foreach ($this->replies as $key => $value) {
	$replies .= "<div class='reply'>
					<p class='info'>Reply by {$value['reply_username']} {$value['reply_date']}</p>
					<p>{$value['reply_content']}</p>
				</div>";
}

$edith['title'] = 'Topic' . EDITH_TITLE;

$edith['main'] = <<<EOD
<div class="content-wrapper">
	
		<div class='topic'>

			<div id='topics-toolbar'>
				{$topic_title}
				{$delete}
				{$edit}
			</div>

			<p class='info'>Posted in <a href='../category/{$topic_cat}'>{$topic_cat}</a> by $topic_auth at {$topic_date}</p>
			<p>{$topic_content}</p>
		</div>

		{$replies}

		<form method="post" action="../reply/{$topic_id}">
			<label>Reply</label><br /><textarea name="reply_content"></textarea><br /><br />
			<input type="submit" value="Post" />
		</form>
	
</div>
EOD;
?>
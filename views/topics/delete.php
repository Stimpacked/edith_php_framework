<?php
/**
 * View for topics - edit
 * 
 */

$topic_id = $this->topic[0][0]['topic_id'];
$topic_title = $this->topic[0][0]['topic_title'];
$topic_content = $this->topic[0][0]['topic_content'];
$topic_date = $this->topic[0][0]['topic_date'];
$topic_cat = $this->topic[1][0]['cat_name'];
$topic_auth = $this->topic[2][0]['username'];

$cats = "";



$edith['title'] = 'Edit' . EDITH_TITLE;

$edith['main'] = <<<EOD

	<h1>Delete topic: {$topic_title}?</h1>

	<form method="post" action="../deleteSave/{$topic_id}">
	<p>Note: lorem ipsum dolor sit amet</p>

		<input type="Submit" value="Delete" />

	</form>

EOD;
?>
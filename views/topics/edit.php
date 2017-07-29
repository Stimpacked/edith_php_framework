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

foreach ($this->categories as $key => $val)
{
	$cats .= "<option value='{$val['cat_id']}'>{$val['cat_name']}</option>";
}

$edith['title'] = 'Edit' . EDITH_TITLE;

$edith['main'] = <<<EOD

<div class='content-wrapper'>
	<h1>Edit Topic</h1>

	<form method="post" action="../editSave/{$topic_id}">

		<label>Topic</label><br /><input type="text" name="title" value="{$topic_title}" /><br /><br />

		<label>Category</label><br />
			<select name="category">
				{$cats}
			</select><br /><br />

		<label>Content</label><br /><textarea name="content">{$topic_content}</textarea><br /><br />

		<input type="Submit" value="Save" />

	</form>
</div>
EOD;
?>
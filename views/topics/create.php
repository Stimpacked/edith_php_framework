<?php
/**
 * View for index
 * 
 */
print_r($this->categories);
$cats = "";

foreach ($this->categories as $key => $val)
{
	$cats .= "<option value='{$val['cat_id']}'>{$val['cat_name']}</option>";
}

$edith['title'] = 'Create a new topic' . EDITH_TITLE;

$edith['main'] = <<<EOD

	<h1>Create a new topic</h1>

	<form method="post" action="saveTopic">

		<label>Topic</label><br /><input type="text" name="title" /><br /><br />

		<label>Category</label><br />
			<select name="category">
				{$cats}
			</select><br /><br />
		
		<label>Content</label><br /><input type="text" name="content" /><br /><br />

		<input type="Submit" value="Save" />

	</form>

EOD;
?>
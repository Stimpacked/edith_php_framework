<?php
/**
 * View for index
 * 
 */
$topicsPagination = $this->pagTopics;

$create = "<a href='topics/create' class='topic-btn'>New Topic</a>";

$topicList = "
<tr>
	<th>Last Update</th>
	<th>Title</th>
	<th>Created By</th>
	<th>Replies</th>
	<th>Category</th>
</tr>";
//print_r($this->topics);
foreach ($this->topics as $key => $val) {

	$topicList .= "
	<tr>
	    <td>{$val['3']} ago</td>
		<td><a href='topics/topic/{$val['topic_id']}'>{$val['topic_title']}</td>
		<td>{$val['0']}</td>
		<td>{$val['1']}</td>
		<td><a href='#'>{$val['4']}</a></td>
	</tr>";
}

$edith['title'] = 'Topics' . EDITH_TITLE;

$edith['main'] = <<<EOD

<div class="content-wrapper">
		
	<div id='topics-toolbar'>Topics {$create}</div>
	<table>
		{$topicList}
	</table>
	<div id='pagination'>
		{$topicsPagination}
	</div>
</div>
EOD;
?>
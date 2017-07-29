<?php
/**
 * View for user
 * 
 */
$html = "<table><th>Username</th><th>Role</th><th></th><th></th>";
foreach($this->userList as $key => $val)
{
	if($val['role'] == 'admin') {
		$delete = "";
	} else {
		$delete = "<a href='user/delete/{$val['id']}'>Delete</a>";
	}

	$html .= "<tr>
				<td>{$val['username']}</td>
				<td>{$val['role']}</td>
				<td><a href='user/edit/{$val['id']}'>Edit</a></td>
				<td>{$delete}</td>
			</tr>";
}
$html .= "</table>";

$edith['title'] = 'Users' . EDITH_TITLE;

$edith['main'] = <<<EOD

<div class='content-wrapper'>
	<h1>Users</h1>

	<hr />

	<h3>Create a new user</h3>

	<form method="post" action="user/create">
		<label>Username</label><br /><input type="text" name="username" /><br /><br />

		<label>Password</label><br /><input type="text" name="password" /><br /><br />
		
		<label>Role</label><br />
			<select name="role">
				<option value="member">Member</option>
				<option value="moderator">Moderator</option>
			</select><br /><br />
		<input type="Submit" value="Save" />
	</form>

	<hr />

	<h3>All users</h3>

	{$html}
</div>
EOD;
?>
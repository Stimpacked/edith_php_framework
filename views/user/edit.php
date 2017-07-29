<?php
/**
 * View for user/edit
 * 
 */
if($this->user[0]['role'] == "member") {$member = 'selected';} else{$member = '';}
if($this->user[0]['role'] == "moderator") {$mod = 'selected';} else{$mod = '';}
if($this->user[0]['role'] == "admin") {$admin 	= 'selected';} else{$admin = '';}

$edith['title'] = 'Edit user' . EDITH_TITLE;

$edith['main'] = <<<EOD

	<h1>Users</h1>

	<hr />

	<h3>Create a new user</h3>

	<form method="post" action="../editSave/{$this->user[0]['id']}">

		<label>Username</label><br /><input type="text" name="username" value="{$this->user[0]['username']}"/><br /><br />

		<label>Password</label><br /><input type="password" name="password" value="{$this->user[0]['password']}"/><br /><br />

		<label>Role</label><br />
			<select name="role">
				<option value="member" {$member}>Member</option>
				<option value="moderator" {$mod}>Moderator</option>
				<option value="admin" {$admin}>Admin</option>
			</select><br /><br />
		<input type="Submit" value="Save" />
	</form>

EOD;
?>
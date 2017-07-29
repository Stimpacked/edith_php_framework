<?php
/**
 * View for index
 * 
 */
$edith['title'] = 'Login' . EDITH_TITLE;

$edith['main'] = <<<EOD

<div class="content-wrapper">
	<form action="login/authenticate" method="post" class="login-form">

		<h1>Login</h1>
		<p>Login as admin, username: Edith, password: password</p>
		<label class="login-label">Username</label><br />
		<input type="text" name="username" class="login-text-field"><br />
		<br /><br />
		<label class="login-label">Password</label><br />
		<input type="password" name="password" class="login-text-field"><br />
		<br /><br />
		<input type="submit" class="submit-btn" value="login">
	</form>
</div>
EOD;
?>
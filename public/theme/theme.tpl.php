<?php
	$css = $this->path->stylesheets();
	extract($edith);
	$url = isset($_GET['url']) ? $_GET['url'] : null;
	$url = rtrim($url, '/');
	$url = explode('/', $url);

	if(isset($url[2])) { $path = "../../";}
	elseif(isset($url[1])) { $path = "../";}
	else{$path ="";}

	if(Session::get('loggedIn') == true)
	{
		$user = "<a href='{$path}dashboard'>Dashboard</a> <a href='{$path}dashboard/logout'>Logout</a>";
		if(Session::get('role') == "admin")
		{
			$user = "<a href='{$path}dashboard'>Dashboard</a> <a href='{$path}user'>Users</a> <a href='{$path}dashboard/logout'>Logout</a>";
		}
	}
	else
	{
		$user = "<a href='{$path}login'>Login</a>";
	}
?>

<!DOCTYPE html>
<html lang="<?php echo EDITH_LANG; ?>">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<?php foreach($css as $stylesheet) {
		echo "<link rel='stylesheet' type='text/css' href='".$path."public/css/".$stylesheet."'>";
	}
	?>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
	<?php 
		if(isset($this->js)) {
			foreach($this->js as $js) 
			{
				echo "<script type='text/javascript' src='$js'></script>";
			}
		} 
	?>
</head>

<body>

<div id='head'>
	<a href='<?php echo $path; ?>index'>Home</a>
	<a href='<?php echo $path; ?>topics'>Topics</a>
	<div class='user-nav'>
		<?php echo $user ?>
	</div>
</div>

<div id='content'>
	<?php echo $main; ?>
</div>

<div id='foot'>
	© Stefan Sjönnebring
</div>

</body>

</html>
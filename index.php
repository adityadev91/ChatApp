<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>Welcome</title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
	</head>
	<body>
		<?php
		//Validates session
			session_start();
			error_reporting(0);
			$cookie_name='chatappsession';
			if(isset($_COOKIE[$cookie_name])){
				if($_COOKIE[$cookie_name]==$_SESSION['session']){
				header('Location: chats.php');
				}
			}
			include("top_banner.php");
		?>
		<div align="center">
			<form action="verify.php" method="post">
			<br/><br/>
			Username: <input type="text" name="username">
			<br/><br/>
			Password: <input type="password" name="password">
			<br/><br/>
			<input type="submit"value="Login">
			<br/><br/>
			<a href="register.php">Don't have an account?</a>
			<br/><br/>
			</form>
		</div>
	</body>
</html>

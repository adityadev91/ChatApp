<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title></title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<link rel="stylesheet" type="text/css" href="css/chats.css">
		<meta content="utf-8" http-equiv="encoding">
	</head>
	<body>
		<?php
			//Validates session in every page that includes a banner
			session_start();
			error_reporting(0);
			$cookie_name='chatappsession';
			if(!isset($_COOKIE[$cookie_name])){
				header( 'Location: index.php' );
			}
			else if(!isset($_SESSION['session'])){
				header( 'Location: index.php' );
			}
			else if($_COOKIE[$cookie_name]!=$_SESSION['session']){
				header( 'Location: index.php' );
			}
			
		?>
		
		<!--Include a logout button with banner-->
		
		<div id="session_info" align="center">
			<div id="clearchat">
				<input type="button" value="Clear Chat History"></input>
			</div>
		
			<div id="currentusername"></div>		
		
			<!--Include a logout button with banner-->
			<div id="logout">
				<input type="button" value="Logout"></input>
			</div>
		</div>
		<br /><br />
		<!--Display banner image-->
		<div id="banner" align="center" style="max-height:10%">
			<img src="images/banner.jpg"></img>
		</div>
	</body>
</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title> ChatApp - Enter New User</title>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
	</head>
	<body>
		<?php
		//To make database connection possible
			include("db_cred.php");
		?>
		<?php
			error_reporting(0);
			session_start();
			$username = $_POST["username"];
			$password = $_POST["password"];
			$fname=$_POST["fname"];
			$lname=$_POST["lname"];
			
			$md5username=md5($username);
			$md5password=md5($password);
			$md5value=$md5username.$md5password;
			
			if($username==""){
				die("Please enter your desired username!");
			}
			else if($password==""){
				die("Please enter your desired password!");
			}
			else{
				//Makes an entry in database if account doesn't exist already
				$connect=mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die("Not Connecting");
				mysql_select_db($mysql_db) or die("No database");
				$query = "INSERT INTO `user_cred` (fname,lname,username,password) VALUES ('".$fname."','".$lname."','".$username."','".$md5password."')";
				$result = mysql_query($query);
				mysql_close($connect);
				if($result){
					//Proceed if conditions are satisfied
					echo "Account successfully created! Hello ".$fname."! You may now login to your account";
					mkdir("user_data/".$username);
					header('Refresh: 3; URL=index.php');
				}else{
					//Do not proceed if conditions are wrong
					echo "Something went wrong. Username ".$username." probably already exists. Please select a different username";
					header('Refresh: 3; URL=register.php');
				}
			}
		?>
	</body>
</html>
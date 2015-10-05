<?php
	//To make database connection possible
	include("db_cred.php");
?>
<?php
	session_start();
	$username=$_SESSION['username'];
	$cookie_name = "chatappsession";
	
	//Destroy cookie value
	setcookie($cookie_name,"",time()-3600, "/"); //Set expiration time to one hour before current time
	//Destroy session value
	$_SESSION['session']=0;
	
	$connect=mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die("Not Connecting");
	mysql_select_db($mysql_db) or die("No database");
	
	//Update online status to 0 so that user can login from another location
	$query="UPDATE `chatappdb`.`user_cred` SET `online` = '0' WHERE `user_cred`.`username` = '".$username."';";
	$result = mysql_query($query);
	
	//Destroys session after online status has been changed in the database
	if($result){
		mysql_close($connect);
		unset($_SESSION);
		session_destroy();
		session_write_close();
		header('Location: index.php');
	}
	else{
		echo "Unable to logout";
	}
	exit;
?>

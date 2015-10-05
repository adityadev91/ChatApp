<?php
	//To make database connection possible
	include("db_cred.php");
?>
<?php
	error_reporting(0);
	session_start();

	$connect=mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die("Not Connecting");
	mysql_select_db($mysql_db) or die("No database");
	
	$username[]='';
	
	//Ensure that all user details except that of the current user are returned
	$query = "SELECT fname,lname,username FROM `".$mysql_table."` WHERE username !='".$_SESSION['username']."';";
	$result = mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close($connect);
	
	//Displays list of users in database as a list of menu items
	for($i=0;$i<$num;$i++){
		$username[i]=mysql_result($result,$i,"username");
		$fname=mysql_result($result,$i,"fname");
		$lname=mysql_result($result,$i,"lname");
		echo('<a href="#"><li class="friend" id="'.$username[i].'">'.$fname.' '.$lname.'</li></a><br/>');
	}

?>

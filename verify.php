<html>
	<head>
		<title> ChatApp - Verify ID</title>
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
			
			$md5username=md5($username);
			$md5password=md5($password);
			$md5value=$md5username.$md5password;
			
			if($username==""){
				die("Please enter a Username!");//Empty username
			}
			else if($password==""){
				die("Please enter a Password!");//Empty Password
			}
			else{
				$connect=mysql_connect($mysql_host,$mysql_user,$mysql_pass) or die("Not Connecting");
				
				mysql_select_db($mysql_db) or die("No database");
				$query = "SELECT * FROM `".$mysql_table."` WHERE `username`='".$username."' and `online`='0'";
				$result = mysql_query($query);
				
				$numrows = mysql_num_rows($result);
				if ($numrows==0){
					//Check if username exists
					echo "Something went wrong. Username ".$username." doesn't exist. Incorrect Username/Password!";
					header('Refresh: 3; URL=index.php');
				}else{
					//Check if user credentials are correct
					$row = mysql_fetch_assoc($result);
					$dbusername = $row['username'];
					$dbpassword = $row['password'];
					if($dbpassword!=$md5password){
						echo "Something went wrong. Username ".$username." doesn't exist. Incorrect Username/Password!";
						header('Refresh: 3; URL=index.php');
						$_SESSION['session']=0;
					}
					else{
						//Proceed if login credentials are correct
						$_SESSION['session']=$md5value;
						$_SESSION['username']=$username;
						$_SESSION['fname']=$row['fname'];
						$_SESSION['lname']=$row['lname'];
						$cookie_name = "chatappsession";
						$cookie_value = $md5value;
						setcookie($cookie_name,$cookie_value,time() + (86400*30), "/"); // 86400 = 1 day
						$query="UPDATE `chatappdb`.`".$mysql_table."` SET `online` = '1' WHERE `".$mysql_table."`.`username` = '".$username."';";
						$result = mysql_query($query);
						if($result){
							mysql_close($connect);
							header( 'Location: chats.php' );
						}
					}
				}
			}
		?>
	</body>
</html>
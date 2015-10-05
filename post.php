<?php
	session_start();
	if(isset($_SESSION['session'])){
		$text = $_POST['text'];
		$friend = $_POST['sel_friend'];
		$userdir=$_SESSION['username'];
		
		//Writes chat to current user's directory'
		$logpath="user_data/".$userdir."/".$friend.".html";
		$fp = fopen($logpath, 'a');
		fwrite($fp, "<div class='msgln'><i>(".date("g:i A").")</i> <b><font color='red'>".$_SESSION['username']."</font></b>: ".stripslashes(htmlspecialchars($text))."<br></div><br>");
		fclose($fp);
		
		//Writes chat to friend's directory as well
		$logpath="user_data/".$friend."/".$userdir.".html";
		$fp = fopen($logpath, 'a');
		fwrite($fp, "<div class='msgln'><i>(".date("g:i A").")</i> <b>".$_SESSION['username']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div><br>");
		fclose($fp);
	}
?>

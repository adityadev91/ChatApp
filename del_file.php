
<?php
	$filename = $_GET['file']; //get the filename
	$filename="/".$filename;
	unlink(__DIR__.$filename); //delete it
	header('Location: chats.php');; //redirect back to the other page
?>
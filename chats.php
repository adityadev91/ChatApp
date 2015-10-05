<html>
	<head>
		<title> ChatApp - Chat with your friends</title>
		<link rel="stylesheet" type="text/css" href="css/chats.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		</head>
	<body>
	<!--Include a banner in every page-->
		<?php
			include 'banner.php';
		?>
		<script type="text/javascript">
			var username=<?php echo json_encode($_SESSION['username']); ?>;//Obtains username from session
			var fname=<?php echo json_encode($_SESSION['fname']); ?>;//Obtains fname from session
			var lname=<?php echo json_encode($_SESSION['lname']); ?>;//Obtains lname from session
			var href;
			var logpath='';
			var oldscrollHeight;
			var firstClick=0;
			
			$(document).ready(function(){
				$("#chatting_with").hide()
				$("#currentusername").text("Welcome "+fname+" "+lname);
				
				//Logout button from banner.php sends you to logout.php if user clicks yes
				$("#logout").click(function(){
					var exit = confirm("Are you sure you want to end the session?");
					if(exit==true){
						window.location = 'logout.php';
					}
				});

				//Clear History button from banner.php allows you to clear your chat history with a user
				$("#clearchat").click(function(){
					var exit = confirm("Are you sure you want to clear your chat history with user "+$("li#"+href).text()+"?");
					if(exit==true){
						window.location = "del_file.php?file="+logpath+"";
					}
				});
				
				//Send button posts the value typed in usermsg to post.php to be written in two log files
				$("#submitmsg").click(function(e){
					var clientmsg = $("#usermsg").val();
					$.post('post.php',{text:message.usermsg.value,sel_friend:href});
					$("#usermsg").val('');
					return false;
				});				
				
				//Sets the content of the chatbox with chat history from selected friend
				var loadLog = function(){
					if(firstClick==1){//This is to ensure unnecessary refreshing of chat history when no friend has been selected initially
						oldscrollHeight = $("#chatbox").attr("height") - 20;
						$.ajax({
							url: logpath,cache: false,success: function(html){
								$("#chatbox").html(html);
								var newscrollHeight = $("#chatbox").attr("height") - 20;
								if(newscrollHeight > oldscrollHeight){
									$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
								}
							},
						});
					}
				};
				
				//Continually calls loadLog function at regular intervals
				setInterval (loadLog, 2500);
				
				//Identifies which menu item has been clicked
				$("#menu li").on("click", function (e) {
					$("#chatting_with").show();
					var origtext="You are currently chatting with ";
					firstClick=1;
					href = $(this).attr("id");
					origtext=origtext+href;
					$("#chatting_with").text(origtext);
					username=<?php echo json_encode($_SESSION['username']); ?>;
					logpath="user_data/"+username+"/"+href+".html";
					loadLog();
				});
			});
		</script>
		
		<div id="wrapper" align="center">
			<div id="menuleftcontent">
				FRIENDS
				<ul id="menu">
				<!--Displays friend list from database-->
					<?php
						include 'friends.php';
					?>
				</ul>
			</div>
			<div id="chatting_with"></div>
			<!--Displays current chat history and text box to send new messages-->
			<div id="chatbox" align="center"></div><br/>
			<div id="newmsg" align="center">
				<form name="message" action="post.php">
					<input name="usermsg" type="text" id="usermsg" size="100%"/>
					<input name="submitmsg" type="submit" id="submitmsg" value="Send" />
				</form>
			</div>
		</div>
	</body>
</html>
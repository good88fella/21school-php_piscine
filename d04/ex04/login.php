<?php
include "auth.php";
session_start();
if (auth($_POST['login'], $_POST['passwd']) == true) {
	$_SESSION['loggued_on_user'] = $_POST['login'];
	$chat = <<<CHAT
	<html>
		<head>
			<style>
				#exit {text-align: right;}
				#exit input {width: 5%;}
			</style>
		</head>
		<body>
			<form id="exit" action="logout.php" method="POST">
				<input type="submit" name="exit" value="exit" />
			</form>
			<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
			<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
		</body>
	</html>
CHAT;
	echo $chat;
} else {
	$_SESSION['loggued_on_user'] = "";
	echo "ERROR\n";
}
?>

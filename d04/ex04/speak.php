<?php
session_start();
date_default_timezone_set("Europe/Moscow");
if ($_SESSION['loggued_on_user'] != "") {
    if ($_POST['msg'] != null) {
		if (!file_exists("../private"))
			mkdir("../private");
		if (file_exists("../private/chat")) {
			$c = fopen("../private/chat", "r");
			flock($c, LOCK_EX);
			$chart = unserialize(file_get_contents("../private/chat"));
			fclose($c);
		} else
			$chart = array();
		$chart[] = array('login' => $_SESSION['loggued_on_user'], 'time' => time(), 'msg' => $_POST['msg']);
		file_put_contents("../private/chat", serialize($chart), LOCK_EX);
	}
} else {
    echo "ERROR\n";
    exit();
}
?>
<html>

<head>
    <script langage="javascript"> top.frames['chat'].location = 'chat.php';</script>
    <style>
        #msg {width: 95%;}
        #buttom {width: 4.5%;}
    </style>
</head>

<body>
    <form action='speak.php' method='POST'>
        <input id="buttom" type='submit' name='send' value='send' />
	    <input id="msg" type='text' name='msg' />
    </form>
</body>

</html>

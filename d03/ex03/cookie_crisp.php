<?php
if ($_GET['action'] == "set" && $_GET['name'] != null && $_GET['value'] != null)
	setcookie($_GET['name'], $_GET['value'], time() + 3600);
else if ($_GET['action'] == "get" && $_COOKIE[$_GET['name']] != null)
		echo $_COOKIE[$_GET['name']] . "\n";
else if ($_GET['action'] == "del" && $_GET['name'] != null)
		setcookie($_GET['name'], null, time() - 3600);
?>

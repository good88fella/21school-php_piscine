<?php
if ($_POST['login'] != null && $_POST['passwd'] != null && $_POST['submit'] == "OK") {
	header("Location: index.html");
	if (!file_exists("../private"))
		mkdir("../private");
	if (file_exists("../private/passwd"))
		$users = unserialize(file_get_contents("../private/passwd"));
	else
		$users = array();
	foreach ($users as $user) {
		if ($user['login'] == $_POST['login']) {
			echo "ERROR\n";
			exit();
		}
	}
	$users[] = array('login' => $_POST['login'], 'passwd' => hash("whirlpool", $_POST['passwd']));
	if (file_put_contents("../private/passwd", serialize($users)))
		echo "OK\n";
} else {
	echo "ERROR\n";
}
?>

<?php
if ($_POST['login'] != null && $_POST['oldpw'] != null && $_POST['newpw'] && $_POST['submit'] == "OK") {
	$users = unserialize(file_get_contents("../private/passwd"));
	foreach ($users as &$user) {
		if ($user['login'] == $_POST['login'] && $user['passwd'] == hash("whirlpool", $_POST['oldpw'])) {
			$user['passwd'] = hash("whirlpool", $_POST['newpw']);
			if (file_put_contents("../private/passwd", serialize($users)))
				echo "OK\n";
			exit();
		}
	}
	echo "ERROR\n";
} else {
	echo "ERROR\n";
}
?>

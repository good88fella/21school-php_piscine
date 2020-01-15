<?php
date_default_timezone_set("Europe/Moscow");
if (file_exists("../private/chat")) {
	$c = fopen("../private/chat", "r");
	flock($c, LOCK_EX);
	$chart = unserialize(file_get_contents("../private/chat"));
	fclose($c);
	foreach ($chart as $item)
		echo "[".date("H:i", $item['time'])."] "."<b>".$item['login']."</b>: ".$item['msg']."<br />"."\n";
}
?>

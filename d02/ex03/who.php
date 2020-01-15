#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Moscow');
$file = fopen('/var/run/utmpx', 'r');
$arr = array();
while ($utmpx = fread($file, 628)) {
	$data = unpack('A256name/a4id/A32tty/iprcs/itype/Itime', $utmpx);
	$arr[$data['tty']] = $data;
}
fclose($file);
ksort($arr);
foreach ($arr as $item) {
	if ($item['type'] == 7) {
		$name = str_pad(substr($item['name'], 0, 8), 9);
		$tty = str_pad(substr($item['tty'], 0, 8), 9);
		$date = strftime('%b %e %H:%M', $item['time']);
		echo $name . $tty . $date . "\n";
	}
}
?>

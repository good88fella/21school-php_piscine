#!/usr/bin/php
<?php
setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
$pattern = '%A %d %B %Y %H:%M:%S';
$arr = strptime($argv[1], $pattern);
if ($arr == null || $arr["unparsed"] != "" || $arr["tm_mday"] == 0) {
	print("Wrong Format\n");
} else {
	$sec = 0;
	for ($i = 1970; $i < $arr["tm_year"] + 1900; $i++) {
		$sec += 365 * 24 * 60 * 60;
		if (isLeap($i))
			$sec += 1 * 24 * 60 * 60;
	}
	$sec += $arr["tm_yday"] * 24 * 60 * 60 + $arr["tm_hour"] * 60 * 60 + $arr["tm_min"] * 60 + $arr["tm_sec"] - 1 * 60 * 60;
	print($sec . "\n");
}

function isLeap($y)
{
	return $y % 400 == 1 || ($y % 100 != 0 && ($y & 3) == 0);
}

?>

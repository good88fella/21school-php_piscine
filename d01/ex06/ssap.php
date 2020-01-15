#!/usr/bin/php
<?php
$arr = array();
foreach ($argv as $key => $item) {
	if ($key == 0)
		continue;
	$item = array_filter(explode(" ", $item), "strlen");
	$arr = array_merge($arr, $item);
}
sort($arr);
foreach ($arr as $item)
	print("$item\n");
?>

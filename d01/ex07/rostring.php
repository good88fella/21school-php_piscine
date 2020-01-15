#!/usr/bin/php
<?php
if ($argc > 1) {
	$arr = explode(" ", $argv[1]);
	$arr = array_values(array_filter($arr, "strlen"));
	$cnt = count($arr);
	if ($cnt) {
		$res = "";
		for ($i = 1; $i < $cnt; $i++)
			$res .= $arr[$i] . " ";
		print($res . $arr[0] . "\n");
	}
}
?>

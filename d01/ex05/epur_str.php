#!/usr/bin/php
<?php
if ($argc == 2) {
	$result = explode(" ", $argv[1]);
	$result = array_filter($result, "strlen");
	if (count($result)) {
		$result = implode(" ", $result);
		echo $result . "\n";
	}
}
?>

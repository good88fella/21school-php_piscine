#!/usr/bin/php
<?php
if ($argc > 1) {
	$pattern = array('/\s+/', '/^\s+|$\s+/');
	$replace = array(' ', '');
	$str = preg_replace($pattern, $replace, $argv[1]);
	if (strlen($str))
		echo trim($str) . "\n";
}
?>

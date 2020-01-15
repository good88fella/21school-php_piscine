#!/usr/bin/php
<?php
if ($argc == 4) {
	if (is_numeric($argv[1]) && is_numeric($argv[3])) {
		$operation = trim($argv[2]);
		if ($operation == "+")
			$res = trim($argv[1]) + trim($argv[3]);
		else if ($operation == "-")
			$res = trim($argv[1]) - trim($argv[3]);
		else if ($operation == "*")
			$res = trim($argv[1]) * trim($argv[3]);
		else if ($operation == "/")
			$res = trim($argv[1]) / trim($argv[3]);
		else if ($operation == "%")
			$res = trim($argv[1]) % trim($argv[3]);
		print("$res\n");
	}
} else {
	print("Incorrect Parameters\n");
}
?>

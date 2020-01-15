#!/usr/bin/php
<?php
while (true) {
	echo "Enter a number: ";
	$line = trim(fgets(STDIN));
	if (feof(STDIN)) {
		echo "\n";
		exit();
	} else if (is_numeric($line)) {
		echo $line % 2 == 0 ? "The number $line is even\n" :
			"The number $line is odd\n";
	} else {
		echo "'$line' is not a number\n";
	}
}
?>

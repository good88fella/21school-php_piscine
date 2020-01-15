#!/usr/bin/php
<?php
$arr = array();
foreach ($argv as $key =>$item) {
	if ($key == 0)
		continue;
	$item = explode(" ", $item);
	$item = array_filter($item, "strlen");
	$arr = array_merge($arr, $item);
}
usort($arr, "cmp");
foreach ($arr as $item)
	print("$item\n");

function cmp($a, $b)
{
	$a = strtolower($a);
	$b = strtolower($b);
	if ($a == $b)
		return 0;
	for ($i = 0; $i < strlen($a) && $i < strlen($b); $i++) {
		if (ctype_alpha($a[$i]) && !ctype_alpha($b[$i]))
			return -1;
		else if (ctype_digit($a[$i]) && !ctype_alnum($b[$i]))
			return -1;
		else if (ctype_digit($a[$i]) && ctype_alpha($b[$i]))
			return 1;
		else if (ctype_digit($a[$i]) && !ctype_alnum($b[$i]))
			return -1;
		else if (!ctype_alnum($a[$i]) && ctype_alnum($b[$i]))
			return 1;
		else if ((ctype_alpha($a[$i]) && ctype_alpha($b[$i])) ||
			(!ctype_alnum($a[$i]) && !ctype_alnum($b[$i])) ||
			(ctype_digit($a[$i]) && ctype_digit($b[$i]))) {
			if ($a[$i] == $b[$i])
				continue;
			return ($a[$i] < $b[$i]) ? -1 : 1;
		}
	}
	return (strlen($a) < strlen($b)) ? -1 : 1;
}
?>

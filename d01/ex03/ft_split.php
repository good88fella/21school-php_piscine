<?php
function ft_split($str)
{
	$arr = explode(" ", $str);
	$arr = array_filter($arr, "strlen");
	$arr = array_unique($arr);
	sort($arr);
	return ($arr);
}
?>

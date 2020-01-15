<?php
function ft_is_sort($tab)
{
	$cnt = count($tab);
	$sort = 0;
	$rsort = 0;
	for ($i = 0; $i < $cnt - 1; $i++) {
		if ($tab[$i] > $tab[$i + 1])
			$sort++;
		else if ($tab[$i] < $tab[$i + 1])
			$rsort++;
		else {
			$sort++;
			$rsort++;
		}
	}
	return ($sort == $cnt - 1 || $rsort == $cnt - 1) ? true : false;
}

?>

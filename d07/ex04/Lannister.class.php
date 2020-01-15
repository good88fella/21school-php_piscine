<?php


class Lannister
{
	function sleepWith($person)
	{
		if ($person instanceof Lannister)
			print("Not even if I'm drunk !" . PHP_EOL);
	}
}

?>

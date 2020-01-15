<?php


class Jaime extends Lannister
{
	function sleepWith($person)
	{
		if ($person instanceof Stark && $person instanceof Sansa)
			print("Let's do this." . PHP_EOL);
		else if ($person instanceof Lannister && $person instanceof Cersei)
			print("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
		else
			parent::sleepWith($person);
	}
}

?>

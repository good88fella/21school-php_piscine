<?php


class Tyrion extends Lannister
{

	function sleepWith($person)
	{
		if ($person instanceof Stark && $person instanceof Sansa)
			print("Let's do this." . PHP_EOL);
		else
			parent::sleepWith($person);
	}
}

?>

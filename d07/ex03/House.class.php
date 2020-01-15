<?php


abstract class House
{
	abstract function getHouseName();
	abstract function getHouseMotto();
	abstract function getHouseSeat();
	function introduce()
	{
		print("House " . static::getHouseName() . " of " .
			static::getHouseSeat() . " : \"" . static::getHouseMotto() . "\"" . PHP_EOL);
	}
}
?>

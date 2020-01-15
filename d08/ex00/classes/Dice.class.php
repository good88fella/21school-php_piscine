<?php


class Dice
{
	static public function roll()
	{
		return random_int(1, 6);
	}
}
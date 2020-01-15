<?php

class Destroyer extends Ship {

	public function __construct($x, $y, $map)
	{
		parent::__construct($x, $y, 1, 3, "d08/ex00/src/SwordFrigate.jpg",
			"Sword Of Absolution", $map, 4, 10, 18, 3, 0, new Laser());
	}
}

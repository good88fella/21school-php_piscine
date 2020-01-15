<?php

require_once 'GameObject.class.php';
abstract class Ship extends GameObject
{
	protected $hp;
	protected $pp;
	protected $speed;
	protected $inert;
	protected $shield;
	protected $weapons;
	protected $direction;
	protected $stationary = 0;
	protected $player = 0;

	const NORTH = 1;
	const EAST = 2;
	const SOUTH = 3;
	const WEST = 4;

	public function __construct($x, $y, $width, $height, $img, $name, $map, $hp, $ep, $speed, $inert, $shield, Array $weapons)
	{
		parent::__construct($x, $y, $width, $height, $img, $name, $map);
        $this->hp = $hp;
        $this->pp = $ep;
        $this->speed = $speed;
        $this->inert = $inert;
        $this->shield = $shield;
        $this->weapons = $weapons;
	}

	public function move($speed)
    {
    	parent::$x += $speed;
    }

    public function inertmov()
	{
		$this->move($this->inert);
	}

    protected function check_boundaries()
	{

	}

	public function rotate($direction)
	{
		$this->direction += $direction;
		if ($this->direction > 4)
			$this->direction = 1;
		if ($this->direction < 1)
			$this->direction = 4;
	}
}
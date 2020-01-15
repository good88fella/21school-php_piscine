<?php


abstract class GameObject
{
	protected $x;
	protected $y;
	protected $width;
	protected $height;
	protected $img;
	protected $name;
	protected $map;

	public function __construct($x, $y, $width, $height, $img, $name, $map)
	{
		$this->x = $x;
		$this->y = $y;
		$this->width = $width;
		$this->height = $height;
		$this->img = $img;
		$this->name = $name;
		$this->map = $map;
	}

}
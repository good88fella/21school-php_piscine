<?php

class Player
{
	protected $name;
	private $_ships;

	public function get_ships_count()
	{
		return count($this->_ships);
	}

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function add_ship($ship)
	{
		$this->_ships[] = $ship;
	}
}
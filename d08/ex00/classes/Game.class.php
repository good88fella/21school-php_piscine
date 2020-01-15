<?php

require_once 'Map.class.php';
require_once 'Obstacle.class.php';
require_once 'Ship.class.php';
require_once 'Player.class.php';
require_once 'Destroyer.class.php';
require_once 'GameObject.class.php';

class Game
{
	private $_map;
	private $_obstacles;
	private $players;
	private $player_active;

	const MAP_WIDTH = 150;
	const MAP_HEIGHT = 100;

	const OBSTACLES_COUNT = 5;
	const PARKING_OFFSET = 10;

	const PLAYER1_WIN = 1;
	const PLAYER2_WIN = 2;
	const DRAW = 3;
	const NOT_FINISHED = 0;

	public function __construct()
	{
		$this->_map = new Map(Game::MAP_WIDTH, Game::MAP_HEIGHT);
		for ($i = 0; $i < Game::OBSTACLES_COUNT; $i++)
		{
			$this->_obstacles[] = new Obstacle(
				rand(self::PARKING_OFFSET, self::MAP_WIDTH - self::PARKING_OFFSET - 1),
				rand(0, self::MAP_HEIGHT - 1),
				1, 1, null, "obstacle", $this->_map);
		}
		$this->players = array();
		$this->players[0] = new Player('Player 1');
		$this->players[1] = new Player('Player 2');
		$this->players[0]->add_ship(new Destroyer(0,0, $this->_map));
		$this->players[1]->add_ship(new Destroyer(0,0, $this->_map));
		$data = serialize($this);
		file_put_contents("gamemap.csv", $data);
	}

	private function end_game()
	{
		if ($this->players[0]->get_ships_count() == 0 &&
			$this->players[1]->get_ships_count() == 0)
			return self::DRAW;
		if ($this->players[0]->get_ships_count() == 0)
			return self::PLAYER2_WIN;
		if ($this->players[1]->get_ships_count() == 0)
			return self::PLAYER1_WIN;
		return self::NOT_FINISHED;
	}

	public function start()
	{
		$this->player_active = 0;
		while ($this->end_game() == self::NOT_FINISHED)
		{

			$this->player_active = !$this->player_active;
			// TODO: Possible problems with !
		}
	}
}

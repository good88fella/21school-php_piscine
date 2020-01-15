<?php
require_once ("classes/Game.class.php");
if ($_GET['start'] == 'start')
{
	$game = new Game();
	$game->start();
}

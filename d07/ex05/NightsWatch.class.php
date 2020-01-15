<?php


class NightsWatch
{
	private $_army = array();

	function recruit($person)
	{
		array_push($this->_army, $person);
	}

	function fight()
	{
		foreach ($this->_army as $fighter) {
			if ($fighter instanceof IFighter)
				$fighter->fight();
		}
	}
}

?>

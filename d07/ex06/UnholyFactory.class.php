<?php


class UnholyFactory
{
	private $_absorbed = array();

	function absorb($person)
	{
		if ($person instanceof Fighter) {
			if (!array_key_exists($person->getType(), $this->_absorbed)) {
				$this->_absorbed[$person->getType()] = $person;
				print("(Factory absorbed a fighter of type " . $person->getType() . ")" . PHP_EOL);
			} else {
				print("(Factory already absorbed a fighter of type " . $person->getType() . ")" . PHP_EOL);
			}
		} else {
			print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
		}
	}

	function fabricate($type)
	{
		if (array_key_exists($type, $this->_absorbed)) {
			print("(Factory fabricates a fighter of type $type)" . PHP_EOL);
			switch ($type) {
				case "foot soldier" :
					return new Footsoldier();
				case "archer" :
					return new Archer();
				case "assassin" :
					return new Assassin();
			}
		} else {
			print("(Factory hasn't absorbed any fighter of type $type)" . PHP_EOL);
		}
	}
}
?>

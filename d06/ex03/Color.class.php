<?php

class Color
{
	static $verbose = false;
	public $red;
	public $green;
	public $blue;

	function __construct(array $kwargs)
	{
		if (isset($kwargs['red']) && isset($kwargs['green']) && isset($kwargs['blue'])) {
			$this->red = intval($kwargs['red']);
			$this->green = intval($kwargs['green']);
			$this->blue = intval($kwargs['blue']);
		} else if (isset($kwargs['rgb'])) {
			$this->red = (intval($kwargs['rgb']) >> 16) & 255;
			$this->green = (intval($kwargs['rgb']) >> 8) & 255;
			$this->blue = intval($kwargs['rgb']) & 255;
		}
		if (self::$verbose) {
			print($this . " constructed." . PHP_EOL);
		}
	}

	function __destruct()
	{
		if (self::$verbose) {
			print($this . " destructed." . PHP_EOL);
		}
	}

	function add($rhs)
	{
		return (new Color(array('red' => $this->red + $rhs->red,
			'green' => $this->green + $rhs->green,
			'blue' => $this->blue + $rhs->blue)));
	}

	function sub($rhs)
	{
		return (new Color(array('red' => $this->red - $rhs->red,
			'green' => $this->green - $rhs->green,
			'blue' => $this->blue - $rhs->blue)));
	}

	function mult($f)
	{
		return (new Color(array('red' => $this->red * $f,
			'green' => $this->green * $f,
			'blue' => $this->blue * $f)));
	}

	function __toString()
	{
		return sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue);
	}

	static function doc()
	{
		return file_get_contents("Color.doc.txt");
	}
}

?>

<?php

require_once "Color.class.php";

class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w;
	private $_color;
	static $verbose = false;

	function __construct(array $kwargs)
	{
		if (isset($kwargs['x']) && isset($kwargs['y']) && isset($kwargs['z'])) {
			$this->_x = $kwargs['x'];
			$this->_y = $kwargs['y'];
			$this->_z = $kwargs['z'];
			$this->_w = $kwargs['w'] == null ? 1.0 : $kwargs['w'];
			$this->_color = ($kwargs['color'] != null && $kwargs['color'] instanceof Color) ?
				$kwargs['color'] : new Color(array('red'=> 255, 'green' => 255, 'blue' => 255));
			if (self::$verbose)
				print($this . " constructed" . PHP_EOL);
		}
	}

	function __destruct()
	{
		if (self::$verbose)
			print($this . " destructed" . PHP_EOL);
	}

	function __toString()
	{
		return self::$verbose == false ? sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )", $this->_x, $this->_y, $this->_z, $this->_w) :
			sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
	}

	static function doc()
	{
		return file_get_contents("Vertex.doc.txt");
	}

	function getX()
	{
		return $this->_x;
	}

	function setX($x)
	{
		$this->_x = $x;
	}

	function getY()
	{
		return $this->_y;
	}

	function setY($y)
	{
		$this->_y = $y;
	}

	function getZ()
	{
		return $this->_z;
	}

	function setZ($z)
	{
		$this->_z = $z;
	}

	function getW()
	{
		return $this->_w;
	}

	function setW($w)
	{
		$this->_w = $w;
	}

	function getColor()
	{
		return $this->_color;
	}

	function setColor($color)
	{
		$this->_color = $color;
	}
}

?>
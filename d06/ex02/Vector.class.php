<?php

require_once "Vertex.class.php";

class Vector
{
	private $_x;
	private $_y;
	private $_z;
	private $_w;
	static $verbose = false;

	function __construct(array $kwargs)
	{
		if (isset($kwargs['dest']) && $kwargs['dest'] instanceof Vertex) {
			if (isset($kwargs['orig']) && $kwargs['orig'] instanceof Vertex) {
				$orig = new Vertex(array('x' => $kwargs['orig']->getX(),
					'y' => $kwargs['orig']->getY(), 'z' => $kwargs['orig']->getZ()));
			} else {
				$orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
			}
			$this->_x = $kwargs['dest']->getX() - $orig->getX();
			$this->_y = $kwargs['dest']->getY() - $orig->getY();
			$this->_z = $kwargs['dest']->getZ() - $orig->getZ();
			$this->_w = 0.0;
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
		return sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )",
			$this->_x, $this->_y, $this->_z, $this->_w);
	}

	function magnitude()
	{
		return (float)sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z);
	}

	function normalize()
	{
		$len = $this->magnitude();
		if ($len == 1)
			return clone $this;
		return new Vector(array('dest' => new Vertex(
			array('x' => $this->_x / $len,
				'y' => $this->_y / $len,
				'z' => $this->_z / $len))));
	}

	function add(Vector $rhs)
	{
		return new Vector(array('dest' => new Vertex(
			array('x' => $this->_x + $rhs->getX(),
				'y' => $this->_y + $rhs->getY(),
				'z' => $this->_z + $rhs->getZ()))));
	}

	function sub(Vector $rhs)
	{
		return new Vector(array('dest' => new Vertex(
			array('x' => $this->_x - $rhs->getX(),
				'y' => $this->_y - $rhs->getY(),
				'z' => $this->_z - $rhs->getZ()))));
	}

	function  opposite()
	{
		return new Vector(array('dest' => new Vertex(
		array('x' => $this->_x * -1,
			'y' => $this->_y * -1,
			'z' => $this->_z * -1))));
	}

	function scalarProduct($k) {
		return new Vector(array('dest' => new Vertex(
			array('x' => $this->_x * $k,
				'y' => $this->_y * $k,
				'z' => $this->_z * $k))));
	}

	function dotProduct(Vector $rhs)
	{
		return (float)($this->_x * $rhs->getX() + $this->_y * $rhs->getY() + $this->_z * $rhs->getZ());
	}

	function cos(Vector $rhs) {
		return (float) ($this->_x * $rhs->getX() + $this->_y * $rhs->getY() + $this->_z * $rhs->getZ()) /
			(sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z) *
			sqrt($rhs->getX() * $rhs->getX() + $rhs->getY() * $rhs->getY() + $rhs->getZ() * $rhs->getZ()));
	}

	function crossProduct(Vector $rhs) {
		return new Vector(array('dest' => new Vertex(
			array('x' => $this->_y * $rhs->getZ() - $this->_z * $rhs->getY(),
				'y' => $this->_z * $rhs->getX() - $this->_x * $rhs->getZ(),
				'z' => $this->_x * $rhs->getY() - $this->_y * $rhs->getX()))));
	}

	static function doc()
	{
		return file_get_contents("Vector.doc.txt");
	}

	public function getX()
	{
		return $this->_x;
	}

	public function getY()
	{
		return $this->_y;
	}

	public function getZ()
	{
		return $this->_z;
	}

	public function getW()
	{
		return $this->_w;
	}
}

?>
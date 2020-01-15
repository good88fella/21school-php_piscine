<?php

require_once "Vector.class.php";

class Matrix
{
	const IDENTITY = 1;
	const SCALE = 2;
	const RX = 3;
	const RY = 4;
	const RZ = 5;
	const TRANSLATION = 6;
	const PROJECTION = 7;

	static $verbose = false;

	private $_matrix = array(
		0 => array(0 => 0, 1 => 0, 2 => 0, 3 => 0),
		1 => array(0 => 0, 1 => 0, 2 => 0, 3 => 0),
		2 => array(0 => 0, 1 => 0, 2 => 0, 3 => 0),
		3 => array(0 => 0, 1 => 0, 2 => 0, 3 => 0),
	);

	function __construct(array $kwargs = null)
	{
		if ($this->_checkArgs($kwargs)) {
			switch ($kwargs['preset']) {
				case (self::IDENTITY) :
					$this->_identity(1);
					break;
				case (self::SCALE) :
					$this->_identity($kwargs['scale']);
					break;
				case (self::RX) :
					$this->_rotation($kwargs['angle'], "x");
					break;
				case (self::RY) :
					$this->_rotation($kwargs['angle'], "y");
					break;
				case (self::RZ) :
					$this->_rotation($kwargs['angle'], "z");
					break;
				case (self::TRANSLATION) :
					$this->_translation($kwargs['vtc']);
					break;
				case (self::PROJECTION) :
					$this->_projection($kwargs['fov'], $kwargs['ratio'], $kwargs['near'], $kwargs['far']);
					break;
			}
			if (self::$verbose) {
				$inst = $kwargs['preset'] == self::IDENTITY ? " instance constructed" : " preset instance constructed";
				print("Matrix " . $this->_selectPreset($kwargs['preset']) . $inst . PHP_EOL);
			}
		}
	}

	function __destruct()
	{
		if (self::$verbose)
			print("Matrix instance destructed" . PHP_EOL);
	}

	function getMatrix()
	{
		return $this->_matrix;
	}

	function __toString()
	{
		$format = "M | vtcX | vtcY | vtcZ | vtxO" . PHP_EOL .
			"-----------------------------" . PHP_EOL .
			"x | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL .
			"y | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL .
			"z | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL .
			"w | %0.2f | %0.2f | %0.2f | %0.2f";
		return (sprintf($format,
			$this->_matrix[0][0], $this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3],
			$this->_matrix[1][0], $this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3],
			$this->_matrix[2][0], $this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3],
			$this->_matrix[3][0], $this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3]));
	}

	static function doc()
	{
		return file_get_contents("Matrix.doc.txt");
	}

	function mult(Matrix $rhs)
	{
		$arr = array();
		for ($i = 0; $i < 4; $i++) {
			for ($j = 0; $j < 4; $j++) {
				$arr[$i][$j] = $this->_matrix[$i][0] * $rhs->getMatrix()[0][$j] +
					$this->_matrix[$i][1] * $rhs->getMatrix()[1][$j] +
					$this->_matrix[$i][2] * $rhs->getMatrix()[2][$j] +
					$this->_matrix[$i][3] * $rhs->getMatrix()[3][$j];
			}
		}
		$matrix = new Matrix();
		$matrix->_matrix = $arr;
		return $matrix;
	}

	function transformVertex(Vertex $vtx)
	{
		return new Vertex(array(
			'x' => $this->_matrix[0][0] * $vtx->getX() + $this->_matrix[0][1] * $vtx->getY() +
				$this->_matrix[0][2] * $vtx->getZ() + $this->_matrix[0][3] * $vtx->getW(),
			'y' => $this->_matrix[1][0] * $vtx->getX() + $this->_matrix[1][1] * $vtx->getY() +
				$this->_matrix[1][2] * $vtx->getZ() + $this->_matrix[1][3] * $vtx->getW(),
			'z' => $this->_matrix[2][0] * $vtx->getX() + $this->_matrix[2][1] * $vtx->getY() +
				$this->_matrix[2][2] * $vtx->getZ() + $this->_matrix[2][3] * $vtx->getW(),
			'w' => $this->_matrix[3][0] * $vtx->getX() + $this->_matrix[3][1] * $vtx->getY() +
				$this->_matrix[3][2] * $vtx->getZ() + $this->_matrix[3][3] * $vtx->getW()
		));
	}

	function transpose()
	{
		$arr = array();
		for ($i = 0; $i < 4; $i++) {
			for ($j = 0; $j < 4; $j++) {
				$arr[$j][$i] = $this->_matrix[$i][$j];
			}
		}
		$this->_matrix = $arr;
		return $this;
	}

	private function _checkArgs($kwargs)
	{
		if (is_array($kwargs) && isset($kwargs['preset'])) {
			if ($kwargs['preset'] == self::IDENTITY || ($kwargs['preset'] == self::SCALE && isset($kwargs['scale'])) ||
				(($kwargs['preset'] == self::RX || $kwargs['preset'] == self::RY || $kwargs['preset'] == self::RZ) &&
					isset($kwargs['angle'])) || ($kwargs['preset'] == self::TRANSLATION && isset($kwargs['vtc']) &&
					$kwargs['vtc'] instanceof Vector) || ($kwargs['preset'] == self::PROJECTION && isset($kwargs['fov']) &&
					isset($kwargs['ratio']) && isset($kwargs['near']) && isset($kwargs['far'])))
				return true;
		}
		return false;
	}

	private function _selectPreset($preset)
	{
		switch ($preset) {
			case (self::IDENTITY) :
				return "_identity";
			case (self::SCALE) :
				return "SCALE";
			case (self::RX) :
				return "Ox _rotation";
			case (self::RY) :
				return "Oy _rotation";
			case (self::RZ) :
				return "Oz _rotation";
			case (self::TRANSLATION) :
				return "_translation";
			case (self::PROJECTION) :
				return "_projection";
		}
	}

	private function _identity($scale)
	{
		$this->_matrix[0][0] = $scale;
		$this->_matrix[1][1] = $scale;
		$this->_matrix[2][2] = $scale;
		$this->_matrix[3][3] = 1;
	}

	private function _translation(Vector $vtc)
	{
		$this->_identity(1);
		$this->_matrix[0][3] = $vtc->getX();
		$this->_matrix[1][3] = $vtc->getY();
		$this->_matrix[2][3] = $vtc->getZ();
	}

	private function _rotation($angle, $axis)
	{
		$this->_identity(1);
		switch ($axis) {
			case ("x") :
				$this->_matrix[1][1] = cos($angle);
				$this->_matrix[1][2] = -sin($angle);
				$this->_matrix[2][1] = sin($angle);
				$this->_matrix[2][2] = cos($angle);
				break;
			case ("y") :
				$this->_matrix[0][0] = cos($angle);
				$this->_matrix[0][2] = sin($angle);
				$this->_matrix[2][0] = -sin($angle);
				$this->_matrix[2][2] = cos($angle);
				break;
			case ("z") :
				$this->_matrix[0][0] = cos($angle);
				$this->_matrix[0][1] = -sin($angle);
				$this->_matrix[1][0] = sin($angle);
				$this->_matrix[1][1] = cos($angle);
				break;
		}
	}

	private function _projection($fov, $ratio, $near, $far)
	{
		$this->_matrix[1][1] = 1 / tan(0.5 * deg2rad($fov));
		$this->_matrix[0][0] = $this->_matrix[1][1] / $ratio;
		$this->_matrix[2][2] = (-$far - $near) / ($far - $near);
		$this->_matrix[3][2] = -1;
		$this->_matrix[2][3] = -2 * $far * $near / ($far - $near);
		$this->_matrix[3][3] = 0;
	}
}

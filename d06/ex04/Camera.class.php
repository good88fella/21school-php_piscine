<?php

require_once "Matrix.class.php";

class Camera
{
	static $verbose = false;

	private $_origin;
	private $_tT;
	private $_tR;
	private $_ratio;
	private $_proj;

	function __construct(array $kwargs)
	{
		if ($this->_checkArgs($kwargs)) {
			$this->_origin = $kwargs['origin'];
			$this->_tT = new Matrix(array(
					'preset' => Matrix::TRANSLATION,
					'vtc' => $this->_origin->opposite())
			);
			$this->_tR = $kwargs['orientation']->transpose();
			if ($kwargs['ratio'])
				$this->_ratio = (float)$kwargs['ratio'];
			else
				$this->_ratio = (float)$kwargs['width'] / (float)$kwargs['height'];
			$this->_proj = new Matrix(array(
					'preset' => Matrix::PROJECTION,
					'fov' => $kwargs['fov'],
					'ratio' => $this->_ratio,
					'near' => $kwargs['near'],
					'far' => $kwargs['far'])
			);
			if (self::$verbose) {
				print("Camera instance constructed" . PHP_EOL);
			}
		}
	}

	private function _checkArgs(array $kwargs)
	{
		if (is_array($kwargs) && isset($kwargs['origin']) && isset($kwargs['orientation']) &&
			((isset($kwargs['width']) && isset($kwargs['height'])) || isset($kwargs['ratio'])) &&
			isset($kwargs['fov']) && isset($kwargs['near']) && isset($kwargs['far']))
			return true;
		return false;
	}

	function watchVertex(Vertex $worldVertex)
	{
		$vtx = $this->_proj->transformVertex($this->_tR->transformVertex($worldVertex));
		$vtx->setX($vtx->getX() * $this->_ratio);
		$vtx->setColor($worldVertex->getColor());
		return ($vtx);
	}

	function __destruct()
	{
		if (self::$verbose)
			print("Camera instance destructed" . PHP_EOL);
	}

	function __toString()
	{
		return "Camera( " . PHP_EOL .
			"+ Origine: " . $this->_origin . PHP_EOL .
			"+ tT:" . PHP_EOL . $this->_tT . PHP_EOL .
			"+ tR:" . PHP_EOL . $this->_tR . PHP_EOL .
			"+ tR->mult( tT ):" . PHP_EOL . $this->_tR->mult($this->_tT) . PHP_EOL .
			"+ Proj:" . PHP_EOL . $this->_proj . PHP_EOL . ")";
	}

	static function doc()
	{
		return file_get_contents("Camera.doc.txt");
	}
}
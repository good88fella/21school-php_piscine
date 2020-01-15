<?php


class Square extends Map implements Doc
{
    private $_sizeY;
    private $_sizeX;

    /**
     * Square constructor.
     * @param $_sizeY
     * @param $_sizeX
     */
    public function __construct($_sizeY, $_sizeX)
    {
        $this->_sizeY = $_sizeY;
        $this->_sizeX = $_sizeX;
    }

    /**
     * @return mixed
     */
    public function getSizeY()
    {
        return $this->_sizeY;
    }

    /**
     * @return mixed
     */
    public function getSizeX()
    {
        return $this->_sizeX;
    }


    public static function doc()
    {
        $read = fopen("Square.doc.txt", 'r');
        while ($read && !feof($read))
            echo fgets($read);
    }
}

?>
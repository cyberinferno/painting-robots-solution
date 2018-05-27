<?php

namespace xola\solution\models;

/**
 * Class Position
 * @package xola\solution\models
 */
class Position
{
    private $_x;
    private $_y;

    public function __construct($x = 0, $y = 0)
    {
        $this->_x = $x;
        $this->_y = $y;
    }

    public function __toString()
    {
        return $this->_x . ',' . $this->_y;
    }

    /**
     * Gets the position
     * @return array
     */
    public function get()
    {
        return [$this->_x, $this->_y];
    }

    /**
     * Sets the position
     * @param int $x
     * @param int $y
     */
    public function set($x, $y)
    {
        $this->_x = $x;
        $this->_y = $y;
    }

    /**
     * Gets X co-ordinate
     * @return int
     */
    public function getX()
    {
        return $this->_x;
    }

    /**
     * Sets X co-ordinate
     * @param int $value
     */
    public function setX($value)
    {
        $this->_x = $value;
    }

    /**
     * Gets Y co-ordinate
     * @return int
     */
    public function getY()
    {
        return $this->_y;
    }

    /**
     * Sets Y co-ordinate
     * @param int $value
     */
    public function setY($value)
    {
        $this->_y = $value;
    }
}
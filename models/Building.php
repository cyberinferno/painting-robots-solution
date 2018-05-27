<?php

namespace xola\solution\models;

/**
 * Class Building
 * @package xola\solution\models
 */
class Building
{
    private $_sizeX;
    private $_sizeY;
    private $_panels;

    public function __construct($sizeX, $sizeY)
    {
        $this->_sizeX = (int)$sizeX;
        $this->_sizeY = (int)$sizeY;
        $this->_panels = [];
        for ($i = 0; $i < $this->_sizeX; $i++) {
            $row = [];
            for ($j = 0; $j < $this->_sizeY; $j++) {
                $row[] = 'E';
            }
            $this->_panels[] = $row;
        }
    }

    public function __toString()
    {
        $output = '';
        for ($i = 0; $i < $this->_sizeX; $i++) {
            for ($j = 0; $j < $this->_sizeY; $j++) {
                $output .= $this->_panels[$i][$j];
            }
            $output .= "\n";
        }
        return $output;
    }

    /**
     * Gets size X
     * @return int
     */
    public function getSizeX()
    {
        return $this->_sizeX;
    }

    /**
     * Gets size Y
     * @return int
     */
    public function getSizeY()
    {
        return $this->_sizeY;
    }

    /**
     * Sets color of a particular cell
     * @param int $x
     * @param int $y
     * @param int $color
     */
    public function setColor($x, $y, $color)
    {
        if ($x < $this->_sizeX && $y < $this->_sizeY) {
            $this->_panels[$x][$y] = $color;
        }
    }

    /**
     * Gets building panel
     * @return array
     */
    public function getPanels()
    {
        return $this->_panels;
    }
}
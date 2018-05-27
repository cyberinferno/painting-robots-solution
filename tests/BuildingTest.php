<?php

use PHPUnit\Framework\TestCase;
use xola\solution\models\Building;

class BuildingTest extends TestCase
{
    public function testGetSizeX()
    {
        $model = new Building(5, 5);
        $this->assertEquals(5, $model->getSizeX());
    }

    public function testGetSizeY()
    {
        $model = new Building(5, 5);
        $this->assertEquals(5, $model->getSizeY());
    }

    public function testGetPanels()
    {
        $model = new Building(5, 5);
        $panels = [];
        for ($i = 0; $i < 5; $i++) {
            $row = [];
            for ($j = 0; $j < 5; $j++) {
                $row[] = 'E';
            }
            $panels[] = $row;
        }
        $this->assertEquals($panels, $model->getPanels());
    }

    public function testSetColor()
    {
        $model = new Building(5, 5);
        $panels = [];
        for ($i = 0; $i < 5; $i++) {
            $row = [];
            for ($j = 0; $j < 5; $j++) {
                if ($i == 0 && $j == 0)
                    $row[] = 'R';
                else
                    $row[] = 'E';
            }
            $panels[] = $row;
        }
        $model->setColor(0, 0, 'R');
        $this->assertEquals($panels, $model->getPanels());
    }
}
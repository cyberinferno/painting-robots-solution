<?php

use PHPUnit\Framework\TestCase;
use xola\solution\models\Building;
use xola\solution\models\Position;
use xola\solution\models\Robot;

class RobotTest extends TestCase
{
    public function testPaint()
    {
        $model = new Robot(
            new Building(5,5),
            new Position(4),
            'N',
            'R',
            'FFRFIFIRFIF'
        );
        $model->paint();
        $panels = [];
        for ($i = 0; $i < 5; $i++) {
            $row = [];
            for ($j = 0; $j < 5; $j++) {
                $row[] = 'E';
            }
            $panels[] = $row;
        }
        $panels[2][1] = $panels[2][2] = $panels[3][2] = 'R';
        $this->assertEquals($panels, $model->getBuilding()->getPanels());
    }

    public function testGetBuilding()
    {
        $building = new Building(5,5);
        $model = new Robot(
            $building,
            new Position(4),
            'N',
            'R',
            'FFRFIFIRFIF'
        );
        $this->assertEquals($building, $model->getBuilding());
    }
}
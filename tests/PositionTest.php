<?php

use PHPUnit\Framework\TestCase;
use xola\solution\models\Position;

class PositionTest extends TestCase
{
    public function testGet()
    {
        $model = new Position();
        $this->assertEquals([0, 0], $model->get());
    }

    public function testSet()
    {
        $model = new Position();
        $model->set(1, 1);
        $this->assertEquals([1, 1], $model->get());
    }

    public function testGetX()
    {
        $model = new Position();
        $this->assertEquals(0, $model->getX());
    }

    public function testSetX()
    {
        $model = new Position();
        $model->setX(1);
        $this->assertEquals(1, $model->getX());
    }

    public function testGetY()
    {
        $model = new Position();
        $this->assertEquals(0, $model->getX());
    }

    public function testSetY()
    {
        $model = new Position();
        $model->setY(1);
        $this->assertEquals(1, $model->getY());
    }
}
<?php

namespace xola\solution\models;

/**
 * Class Robot
 * @package xola\solution\models
 */
class Robot
{
    /**
     * @var Position
     */
    private $_currentPosition;
    private $_color;
    private $_currentDirection;
    private $_commands;
    /**
     * @var Building
     */
    private $_building;

    public function __construct(Building $building, Position $currentPosition, $direction, $color, $commands)
    {
        $this->_currentPosition = $currentPosition;
        $this->_currentDirection = $direction;
        $this->_color = $color;
        $this->_commands = $commands;
        $this->_building = $building;
    }

    /**
     * Paints the building based on the command
     */
    public function paint()
    {
        for ($i = 0; $i < strlen($this->_commands); $i++) {
            $this->handleCommand($this->_commands[$i]);
        }
    }

    /**
     * Gets building model
     * @return Building
     */
    public function getBuilding()
    {
        return $this->_building;
    }

    /**
     * Handles the command given to the robot
     * @param $command
     * @throws \Exception
     */
    private function handleCommand($command)
    {
        switch ($command) {
            case 'L':
                $this->handleTurnLeft();
                break;
            case 'R':
                $this->handleTurnRight();
                break;
            case 'F':
                $this->handleMoveForward();
                break;
            case 'I':
                $this->handleInstallColor();
                break;
        }
    }

    /**
     * Handles turn left command
     */
    private function handleTurnLeft()
    {
        switch ($this->_currentDirection) {
            case 'N':
                $this->_currentDirection = 'W';
                break;
            case 'S':
                $this->_currentDirection = 'E';
                break;
            case 'E':
                $this->_currentDirection = 'N';
                break;
            case 'W':
                $this->_currentDirection = 'S';
                break;
        }
    }

    /**
     * Handles turn left command
     */
    private function handleTurnRight()
    {
        switch ($this->_currentDirection) {
            case 'N':
                $this->_currentDirection = 'E';
                break;
            case 'S':
                $this->_currentDirection = 'W';
                break;
            case 'E':
                $this->_currentDirection = 'S';
                break;
            case 'W':
                $this->_currentDirection = 'N';
                break;
        }
    }

    /**
     * Handles move forward command
     */
    private function handleMoveForward()
    {
        switch ($this->_currentDirection) {
            case 'N':
                if ($this->_currentPosition->getX() == 0) {
                    throw new \Exception('Invalid move forward command got. Aborting paint');
                }
                $this->_currentPosition->setX($this->_currentPosition->getX() - 1);
                break;
            case 'S':
                if ($this->_currentPosition->getX() == $this->_building->getSizeX() - 1) {
                    throw new \Exception('Invalid move forward command got. Aborting paint');
                }
                $this->_currentPosition->setX($this->_currentPosition->getX() + 1);
                break;
            case 'E':
                if ($this->_currentPosition->getY() == $this->_building->getSizeY() - 1) {
                    throw new \Exception('Invalid move forward command got. Aborting paint');
                }
                $this->_currentPosition->setY($this->_currentPosition->getY() + 1);
                break;
            case 'W':
                if ($this->_currentPosition->getY() == 0) {
                    throw new \Exception('Invalid move forward command got. Aborting paint');
                }
                $this->_currentPosition->setY($this->_currentPosition->getY() - 1);
                break;
        }
    }

    /**
     * Handles install color command
     */
    private function handleInstallColor()
    {
        $this->_building->setColor($this->_currentPosition->getX(), $this->_currentPosition->getY(), $this->getColorToInstall());
    }

    private function getColorToInstall()
    {
        $panels = $this->_building->getPanels();
        switch ($panels[$this->_currentPosition->getX()][$this->_currentPosition->getY()]) {
            case 'G':
                if ($this->_color == 'R')
                    return 'Y';
                return 'G';
            case 'R':
                if ($this->_color == 'G')
                    return 'Y';
                return 'R';
            default:
                return $this->_color;
        }
    }
}
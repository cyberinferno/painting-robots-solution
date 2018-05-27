<?php

namespace xola\solution\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use xola\solution\models\Building;
use xola\solution\models\Position;
use xola\solution\models\Robot;

/**
 * Class SolutionCommand
 * @package xola\solution\commands
 */
class SolutionCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('painting-robots');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $buildingSizeQuestion = new Question('Please enter the building size [5,5]: ', '5,5');
        do {
            $buildingSize = $helper->ask($input, $output, $buildingSizeQuestion);
        } while (!$this->isValidBuildingSize($buildingSize, $output));
        $buildingSizeArray = explode(',', $buildingSize);
        $building = new Building($buildingSizeArray[1], $buildingSizeArray[0]);
        $robotCountQuestion = new Question('Please enter the no. of robots [1]: ', 1);
        do {
            $robotCount = $helper->ask($input, $output, $robotCountQuestion);
        } while (!$this->isValidRobotCount($robotCount, $output));
        $initialDataQuestion = new Question('Please enter the robot initial data [0 0 N R]: ', '0 0 N R');
        $robotCommandQuestion = new Question('Please enter the robot commands [FFRFIFIRFIF]: ', 'FFRFIFIRFIF');
        for ($i = 0; $i < $robotCount; $i++) {
            try {
                do {
                    $initialData = $helper->ask($input, $output, $initialDataQuestion);
                } while (!$this->isValidInitialPosition($initialData, $building, $output));
                $dataArray = explode(' ', $initialData);
                $position = new Position($building->getSizeY() - 1 - $dataArray[1], $dataArray[0]);
                do {
                    $robotCommand = $helper->ask($input, $output, $robotCommandQuestion);
                } while (!$this->isValidRobotCommand($robotCommand, $output));
                $robot = new Robot($building, $position, $dataArray[2], $dataArray[3], $robotCommand);
                $robot->paint();
            } catch (\Exception $e) {}
        }
        $output->writeln((string)$building);
    }

    /**
     * Validates building size input
     * @param $buildingSize
     * @param OutputInterface $output
     * @return bool
     */
    private function isValidBuildingSize($buildingSize, OutputInterface $output)
    {
        $sizeArray = explode(',', $buildingSize);
        if (count($sizeArray) < 2 || !is_numeric($sizeArray[0]) || !is_numeric($sizeArray[1])) {
            $output->writeln('Invalid building size. Example building size: 5,5');
            return false;
        }
        if ($sizeArray[0] < 1 || $sizeArray[1] < 1) {
            $output->writeln('Building size co-ordinates cannot be less than 1,1');
            return false;
        }
        return true;
    }

    /**
     * Validates robot count input
     * @param $robotCount
     * @param OutputInterface $output
     * @return bool
     */
    private function isValidRobotCount($robotCount, OutputInterface $output)
    {
        if (!is_numeric($robotCount)) {
            $output->writeln('Invalid robot count');
            return false;
        }
        if ($robotCount < 1) {
            $output->writeln('Robot count cannot be less than 1');
            return false;
        }
        return true;
    }

    /**
     * Validates initial position input
     * @param $initialData
     * @param Building $building
     * @param OutputInterface $output
     * @return bool
     */
    private function isValidInitialPosition($initialData, Building $building, OutputInterface $output)
    {
        $dataArray = explode(' ', $initialData);
        if (count($dataArray) < 4 ||
            !is_numeric($dataArray[0]) || !is_numeric($dataArray[1]) ||
            !in_array($dataArray[2], ['N', 'S', 'E', 'W']) || !in_array($dataArray[3], ['R', 'G'])) {
            $output->writeln('Invalid robot initial data. Example robot initial data: 0 0 N R]');
            return false;
        }
        if ($dataArray[0] > $building->getSizeX() - 1 || $dataArray[1] > $building->getSizeY() - 1) {
            $output->writeln('Robot initial position cannot exceed building size');
            return false;
        }
        return true;
    }

    /**
     * Validates robot command input
     * @param $robotCommand
     * @param OutputInterface $output
     * @return bool
     */
    private function isValidRobotCommand($robotCommand, OutputInterface $output)
    {
        $valid = true;
        for ($i = 0; $i < strlen($robotCommand); $i++) {
            if (!in_array($robotCommand[$i], ['L', 'R', 'F', 'I'])) {
                $valid = false;
                break;
            }
        }
        if (!$valid) {
            $output->writeln('Invalid robot commands. Example robot commands: FFRFIFIRFIF]');
        }
        return $valid;
    }
}
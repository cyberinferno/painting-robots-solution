<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

final class SolutionCommandTest extends TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new \xola\solution\commands\SolutionCommand());
        $command = $application->find('painting-robots');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
        $this->assertEquals(
            "Please enter the building size [5,5]: Please enter the no. of robots [1]: Please enter the robot initial data [0 0 N R]: Please enter the robot commands [FFRFIFIRFIF]: EEEEE\nEEEEE\nERREE\nEEREE\nEEEEE\n\r\n",
            $commandTester->getDisplay()
        );
    }
}
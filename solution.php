#!/usr/bin/env php
<?php
// solution.php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use xola\solution\commands\SolutionCommand;

$application = new Application();
$application->add(new SolutionCommand());
$application->run();
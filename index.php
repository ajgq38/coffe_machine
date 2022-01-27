#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Adsmurai\CoffeeMachine\Console\Application\MakeDrinkCommand;
use Adsmurai\CoffeeMachine\Console\Application\ShowCashTotal;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new MakeDrinkCommand());
$application->add(new ShowCashTotal);

$application->run();

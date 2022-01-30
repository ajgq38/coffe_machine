#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Adsmurai\CoffeeMachine\Console\Application\MakeDrinkCommand;
use Adsmurai\CoffeeMachine\Console\Application\ShowCashTotal;
use Adsmurai\CoffeeMachine\Console\Infrastructure\OrderRepositoryMysql;
use Symfony\Component\Console\Application;

$application = new Application();

$order_repository = new OrderRepositoryMysql();
$application->add(new MakeDrinkCommand($order_repository));
$application->add(new ShowCashTotal($order_repository));

$application->run();

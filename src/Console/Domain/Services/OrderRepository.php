<?php

namespace Adsmurai\CoffeeMachine\Console\Domain\Services;

use Adsmurai\CoffeeMachine\Console\Domain\Entity\Order;

Interface OrderRepository
{
    public function saveOrderHistoric(Order $order);
    public function totals(): array;
}
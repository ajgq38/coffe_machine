<?php

namespace Adsmurai\CoffeeMachine\Console\Domain\Entity;

use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\EnumDrink;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Sugar;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Money;
use Exception;


final class Order
{

    private EnumDrink $drink;
    private Sugar $sugar;
    private bool $extraHot;
    private bool $stick;

    public function __construct(EnumDrink $drink, Sugar $sugar, bool $extraHot)
    {
        $this->drink = $drink;
        $this->sugar = $sugar;
        $this->extraHot = $extraHot;
        $this->stick = $this->sugar->value() > 0;
    }


    public function extraHot(): bool
    {
        return $this->extraHot;
    }

    public function sugar(): int
    {
        return $this->sugar->value();
    }

    public function drink(): string
    {
        return $this->drink->value;
    }

    public function stick(): bool
    {
        return $this->stick;
    }

    public function price(): float
    {
        return $this->drink->price();
    }

}
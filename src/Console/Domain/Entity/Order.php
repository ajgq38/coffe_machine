<?php

namespace Adsmurai\CoffeeMachine\Console\Domain\Entity;

use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Drink;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Sugar;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Money;
use Exception;

class Order
{
    private Drink $drink;
    private Sugar $sugar;
    private bool $extraHot;
    private Money $money;
    private bool $stick;

    public function __construct(Drink $drink, Sugar $sugar, bool $extraHot, Money $money)
    {

        $this->drink = $drink;
        $this->sugar = $sugar;
        $this->extraHot = $extraHot;
        $this->stick = $this->sugar->getValue() > 0;
        if ( $money->getValue() < $drink->getPrice() ) {
            throw new Exception('The '. $this->getDrink()->getType() .' costs '. $this->getDrink()->getPrice() .'.');
        }
        $this->money = $money;
    }


    public function getExtraHot(): bool
    {
        return $this->extraHot;
    }

    public function getSugar(): Sugar
    {
        return $this->sugar;
    }

    public function getDrink(): Drink
    {
        return $this->drink;
    }

    public function getStick(): bool
    {
        return $this->stick;
    }

}
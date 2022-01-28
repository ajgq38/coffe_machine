<?php

namespace Adsmurai\CoffeeMachine\Console\Domain\Entity;

use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Drink;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Sugar;
use Exception;


class Order
{
    private const STATUS_CANCELLED = 0;
    private const STATUS_CORRECT = 1;
    private Drink $drink;
    private Sugar $sugar;
    private bool $extraHot;
    private float $money;
    private bool $stick;


    public function __construct(Drink $drink, Sugar $sugar, bool $extraHot, $money)
    {

        $this->drink = $drink;
        $this->sugar = $sugar;
        $this->extraHot = $extraHot;
        $this->stick = $this->sugar->getValue() > 0;
        if ( $money < $drink->getPrice() ) {
            throw new Exception('The '. $this->getDrink()->getType() .' costs '. $this->getDrink()->getPrice() .'.');
        }
        $this->money = $money;

        //

    }


    public function getExtraHot(): bool
    {
        return $this->extraHot;
    }

    public function getSugar(): int
    {
        return $this->sugar->getValue();
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
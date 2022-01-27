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
    private bool $stick;


    public function __construct(Drink $drink, Sugar $sugar, bool $extraHot)
    {

        $this->drink = $drink;
        $this->sugar = $sugar;
        $this->extraHot = $extraHot;
        $this->stick = $this->sugar->getValue() > 0;

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

    public function statusFor(float $money): bool
    {
        if (!$this->drink->isLessPrice($money)) {
            return self::STATUS_CANCELLED;
        }
        return  self::STATUS_CORRECT;

    }
}
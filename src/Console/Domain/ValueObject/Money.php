<?php

namespace Adsmurai\CoffeeMachine\Console\Domain\ValueObject;

final class Money
{
    private float $value;

    public function __construct(float $money)
    {

        $this->value = $money;

    }

    public function value()
    {
        return $this->value;
    }

    public function islower(float $price) : bool
    {
        return $this->value >= $price;
    }

}
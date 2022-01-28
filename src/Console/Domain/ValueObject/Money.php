<?php

namespace Adsmurai\CoffeeMachine\Console\Domain\ValueObject;

class Money
{
    private float $value;

    public function __construct(float $money)
    {

        $this->value = $money;

    }

    public function getValue()
    {
        return $this->value;
    }
}
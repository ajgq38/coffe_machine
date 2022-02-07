<?php
declare( strict_types = 1 );
namespace Adsmurai\CoffeeMachine\Console\Domain\ValueObject;

final class Money
{
    private float $value;

    public function __construct(float $money)
    {

        $this->value = $money;

    }

    public function value(): float
    {
        return $this->value;
    }

    public function isLower(float $price) : bool
    {
        return $this->value >= $price;
    }

}
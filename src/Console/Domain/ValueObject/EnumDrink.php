<?php

namespace Adsmurai\CoffeeMachine\Console\Domain\ValueObject;

enum EnumDrink: string
{
    case TEA = 'tea';
    case COFFEE = 'coffee';
    case CHOCOLATE = 'chocolate';
    public const PRICE_TEA = 0.4;
    public const PRICE_COFFEE = 0.5;
    public const PRICE_CHOCOLATE = 0.6;

    public function price(): float
    {

        return match($this) {
            self::TEA => self::PRICE_TEA,
            self::COFFEE => self::PRICE_COFFEE,
            self::CHOCOLATE => self::PRICE_CHOCOLATE,
        };

    }
}
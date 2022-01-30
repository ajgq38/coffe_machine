<?php

namespace Adsmurai\CoffeeMachine\Console\Domain\ValueObject;
use Exception;

class Drink
{
    public const PRICE_TEA = 0.4;
    public const PRICE_COFFE = 0.5;
    public const PRICE_CHOCOLATE = 0.6;
    private const ERROR_IVALID_TYPE = 'The drink type should be tea, coffee or chocolate.';

    private string $type;
    private float $price;


    public function __construct(string $type)
    {

        switch ($type) {
            case "tea":
                $this->price = self::PRICE_TEA;
                break;
            case "coffee":
                $this->price = self::PRICE_COFFE;
                break;
            case "chocolate":
                $this->price = self::PRICE_CHOCOLATE;
                break;
            default:
                throw new Exception(self::ERROR_IVALID_TYPE);
        }
        $this->type = $type;

    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }

}
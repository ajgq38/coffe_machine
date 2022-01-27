<?php

namespace Adsmurai\CoffeeMachine\Console\Domain\ValueObject;
use Exception;

final class Sugar
{
    private  const AMOUNT_MINIMAL = 0;
    private  const AMOUNT_MAXIMAL = 2;

    private int $value;

    public function __construct(int $sugar)
    {
        if ($sugar > self::AMOUNT_MAXIMAL || $sugar < self::AMOUNT_MINIMAL) {
            throw new Exception('The number of sugars should be between 0 and 2.');
        }

        $this->value = $sugar;

    }

    public function getValue()
    {
        return $this->value;
    }
}
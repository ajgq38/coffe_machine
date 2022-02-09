<?php
declare( strict_types = 1 );
namespace Adsmurai\CoffeeMachine\Console\Domain\ValueObject;
use Adsmurai\CoffeeMachine\Console\Domain\Exceptions\SugarQuantityException;
use Exception;

final class Sugar
{
    private  const AMOUNT_MINIMAL = 0;
    private  const AMOUNT_MAXIMAL = 2;

    private int $value;

    public function __construct(int $sugar)
    {
        if ($sugar > self::AMOUNT_MAXIMAL || $sugar < self::AMOUNT_MINIMAL) {
            throw new SugarQuantityException();
        }

        $this->value = $sugar;

    }

    public function value(): int
    {
        return $this->value;
    }
}
<?php
declare( strict_types = 1 );
namespace Adsmurai\CoffeeMachine\Console\Domain\Exceptions;

class DrinkTypeException extends \Exception
{
    private const ERROR_MESSAGE = 'The drink type should be tea, coffee or chocolate.';

    public function errorMessage(): string
    {
        return self::ERROR_MESSAGE;
    }
}
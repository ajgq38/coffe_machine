<?php
declare( strict_types = 1 );
namespace Adsmurai\CoffeeMachine\Console\Domain\Exceptions;

class SugarQuantityException extends \Exception
{
    private const ERROR_MESSAGE = 'The number of sugars should be between 0 and 2.';

    public function errorMessage(): string
    {
        return self::ERROR_MESSAGE;
    }
}
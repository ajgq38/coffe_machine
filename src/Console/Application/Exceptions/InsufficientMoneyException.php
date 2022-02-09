<?php
declare( strict_types = 1 );
namespace Adsmurai\CoffeeMachine\Console\Application\Exceptions;

use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\EnumDrink;


class InsufficientMoneyException extends \Exception
{
    public function errorMessage(EnumDrink $drink): string
    {
        return sprintf("The %s costs %s.", $drink->value, $drink->price());
    }
}
<?php

namespace Adsmurai\CoffeeMachine\Console\Application\Services\SaverOrderHistoric;

use Adsmurai\CoffeeMachine\Console\Domain\Entity\Order;
use Adsmurai\CoffeeMachine\Console\Infrastructure\Bd\MysqlPdoClient;

final class SaverOrderHistoric
{
    private static Order $order;

    public static function saveOrderHistoric(Order $order): void
    {
        $orderData = [
            'drink_type' => $order->getDrink()->getType(),
            'sugars' => $order->getSugar(),
            'stick' => $order->getStick() ?:0,
            'extra_hot' => $order->getExtraHot() ?: 0,
        ];
        $pdo = MysqlPdoClient::getPdo();

        $stmt = $pdo->prepare('INSERT INTO orders (drink_type, sugars, stick, extra_hot) VALUES (:drink_type, :sugars, :stick, :extra_hot)');
        $stmt->execute($orderData);
    }
}
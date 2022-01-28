<?php

namespace Adsmurai\CoffeeMachine\Console\Application\Services\GetTotalsCash;

use Adsmurai\CoffeeMachine\Console\Infrastructure\Bd\MysqlPdoClient;

final class GetTotalsCash
{
     public static function totals(): array
    {
        $sql = 'SELECT drink_type, count(drink_type) AS "amount"
                 FROM orders
                 GROUP BY drink_type;';

        $pdo = MysqlPdoClient::getPdo();

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $totals_amount_cash = $stmt->fetchAll($pdo::FETCH_OBJ);

        return $totals_amount_cash;
    }
}
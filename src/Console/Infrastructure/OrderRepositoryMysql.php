<?php
declare( strict_types = 1 );

namespace Adsmurai\CoffeeMachine\Console\Infrastructure;

use Adsmurai\CoffeeMachine\Console\Domain\Entity\Order;
use Adsmurai\CoffeeMachine\Console\Domain\Services\OrderRepository;

class OrderRepositoryMysql implements OrderRepository
{
    public function __construct()
    {
        $pdo_mysql = new MysqlPdoClient();
        $this->pdo = $pdo_mysql->getPdo();
    }


    public function saveOrderHistoric(Order $order): void
    {
        $sql = 'INSERT INTO orders (drink_type, sugars, stick, extra_hot) VALUES (:drink_type, :sugars, :stick, :extra_hot)';
        $orderData = [
            'drink_type' => $order->drink(),
            'sugars' => $order->sugar(),
            'stick' => $order->stick() ?:0,
            'extra_hot' => $order->extraHot() ?: 0,
        ];

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($orderData);
    }

    public function totals(): array
    {
        $sql = 'SELECT drink_type, count(drink_type) AS "amount"
                 FROM orders
                 GROUP BY drink_type;';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $totals_amount_cash = $stmt->fetchAll($this->pdo::FETCH_OBJ);

        return $totals_amount_cash;
    }

}
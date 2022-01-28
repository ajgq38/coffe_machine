<?php

namespace Adsmurai\CoffeeMachine\Tests\Integration;

use Adsmurai\CoffeeMachine\Console\Infrastructure\Bd\MysqlPdoClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;

class IntegrationTestCase extends TestCase
{
    /** @var Application */
    protected $application;
    /** @var \PDO */
    protected $pdo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->application = new Application();

        $this->pdo = MysqlPdoClient::getPdo();

        $this->preparaBD();

        $this->pdo->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->pdo->rollBack();
        unset($this->pdo);

        parent::tearDown();
    }

    private function preparaBD(): void {
        $this->pdo->query("TRUNCATE orders");
        $orderDatas = [
            [
                'drink_type' => 'tea',
                'sugars' => 1,
                'stick' => 1,
                'extra_hot' => 0],
            [
                'drink_type' => 'coffee',
                'sugars' => 1,
                'stick' => 1,
                'extra_hot' => 0],
            [
                'drink_type' => 'chocolate',
                'sugars' => 2,
                'stick' => 1,
                'extra_hot' => 1],
            [
                'drink_type' => 'coffee',
                'sugars' => 1,
                'stick' => 2,
                'extra_hot' => 1],
        ];

        $stmt = $this->pdo->prepare('INSERT INTO orders (drink_type, sugars, stick, extra_hot) VALUES (:drink_type, :sugars, :stick, :extra_hot)');
        foreach ($orderDatas as $orderData){
            $stmt->execute($orderData);
        }
    }
}

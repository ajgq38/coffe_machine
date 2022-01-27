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

        $this->pdo->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->pdo->rollBack();
        unset($this->pdo);

        parent::tearDown();
    }
}

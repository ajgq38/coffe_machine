<?php

namespace Adsmurai\CoffeeMachine\Console\Infrastructure\Bd;

class MysqlPdoClient
{
    private static $pdo;
    private const HOST = 'localhost';
    private const USER_NAME = 'php';
    private const USER_PASSWORD = 'php';
    private const DB_NAME = 'test';

    public static function getPdo(): \PDO
    {

        if (!(self::$pdo instanceof \PDO)) {
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $dsn = "mysql:host=". self::HOST.";dbname=".self::DB_NAME.";charset=utf8";
            try {
                self::$pdo = new \PDO($dsn, self::USER_NAME, self::USER_PASSWORD, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }

        return self::$pdo;
    }
}
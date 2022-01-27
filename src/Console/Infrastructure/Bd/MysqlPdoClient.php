<?php

namespace Adsmurai\CoffeeMachine\Console\Infrastructure\Bd;
use Adsmurai\CoffeeMachine\Console\Infrastructure\BD\Config\Develop as BD_CONFIG_DEVELOP;

class MysqlPdoClient
{
    private static $pdo;

    public static function getPdo(): \PDO
    {
        $config_bd = BD_CONFIG_DEVELOP::getParameter();
        if (!(self::$pdo instanceof \PDO)) {
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $dsn = "mysql:host=".$config_bd["HOST"].";dbname=".$config_bd["DB_NAME"] .";charset=utf8";
            try {
                self::$pdo = new \PDO($dsn, $config_bd["USER_NAME"], $config_bd["USER_PASSWORD"], $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }

        return self::$pdo;
    }
}
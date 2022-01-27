<?php
namespace Adsmurai\CoffeeMachine\Console\Infrastructure\BD\Config;

class Develop {
    const CONFIG_BD = [
        "HOST" => "localhost",
        "USER_NAME" => "php",
        "USER_PASSWORD" => "php",
        "DB_NAME" => "test"
    ];

    public static function getParameter()
    {
        return self::CONFIG_BD;
    }
}


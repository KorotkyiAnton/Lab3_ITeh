<?php

namespace Db;

use PDO;

class SingletonDbInit
{
    private static PDO $db;

    private function __construct()
    {
    }

    public static function initiateDb(): void
    {
        try {
            static::$db = new PDO("mysql:host=127.0.0.1;dbname=library", "root","");
        } catch (\PDOException $error) {
            throw new \PDOException($error->getMessage(), $error->getCode());
        }
    }

    public static function getDb()
    {
        if (static::$db !== null) {
            return static::$db;
        }
    }
}
<?php

namespace App;

use PDO;

class DB
{
    private static PDO $connection;


    public static function setConnection($connection)
    {
        self::$connection = $connection;
    }

    private static function connect()
    {
        $connection = new PDO('sqlite:' . APP_DIR . 'db.sqlite', null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        self::setConnection($connection);
        return $connection;
    }

    public static function getConnection()
    {
        return self::$connection ?? self::connect();
    }
}

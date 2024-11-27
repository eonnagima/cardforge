<?php

namespace Codinari\Cardforge;

class Db {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            try {
                global $dbConfig;
                $dsn = 'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['dbname'];
                $user = $dbConfig['user'];
                $password = $dbConfig['password'];
                $options = $dbConfig['options'];

                return self::$conn = new \PDO($dsn, $user, $password, $options);
            } catch (\PDOException $e) {
                throw new \Exception("Error Connection Failed: " . $e->getMessage());
            }
        } else {
            return self::$conn;
        }
    }
}
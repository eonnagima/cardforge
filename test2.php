<?php

require_once __DIR__."/bootstrap.php";

global $dbConfig;

$host = $dbConfig['host'];
$dbname = $dbConfig['dbname'];
$user = $dbConfig['user'];
$password = $dbConfig['password'];

echo "host: $host, dbname: $dbname, user: $user, password: $password";

echo '<br><hr><br>';

class Test{
    public static function envTest(){
        require_once __DIR__.'/config.php';

        global $dbConfig;

        $host = $dbConfig['host'];
        $dbname = $dbConfig['dbname'];
        $user = $dbConfig['user'];
        $password = $dbConfig['password'];

        return "host: $host, dbname: $dbname, user: $user, password: $password";
    }
}

echo Test::envTest();
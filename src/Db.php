<?php

namespace Codinari\Cardforge;

include_once __DIR__.'/../settings/config.php';

class Db{
    private static $conn = null;

    public static function getConnection(){
        if(self::$conn === null){
            return self::$conn = new \PDO('mysql:host='.CONFIG['db']['host'].';dbname='.CONFIG['db']['dbname'], CONFIG['db']['user'], CONFIG['db']['password']);
        }else{
            return self::$conn;
        }
    }
}
<?php

namespace Codinari\Cardforge;

class Db{
    private static $conn = null;

    public static function getConnection(){
        if(self::$conn === null){
            return self::$conn = new \PDO('mysql:host=localhost;dbname=cardforge', 'root', '');
        }else{
            return self::$conn;
        }
    }
}
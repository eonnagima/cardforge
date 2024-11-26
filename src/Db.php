<?php

namespace Codinari\Cardforge;

require_once __DIR__.'/../config.php';

class Db{
    private static $conn = null;

    public static function getConnection(){
        if(self::$conn === null){
            try{
                return self::$conn = new \PDO('mysql:host='.CONFIG['db']['host'].';dbname='.CONFIG['db']['dbname'], CONFIG['db']['user'], CONFIG['db']['password']);
            }
            catch(\PDOException $e){
                throw new \Exception("Error Connection Failed: ".$e->getMessage());
            }
        }else{
            return self::$conn;
        }
    }
}
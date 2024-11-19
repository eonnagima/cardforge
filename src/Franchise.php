<?php

namespace Codinari\Cardforge;

use Codinari\Cardforge\Db;
use Codinari\Cardforge\interfaces\iFranchise;

class Franchise implements iFranchise{
    private $name;
    private $alias;
    private $image;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if (empty($name)) {
            throw new \Exception("Name can't be empty");
        } else {
            $this->name = $name;
            return $this;
        }
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        if (empty($alias)) {
            throw new \Exception("Alias can't be empty");
        } else {
            //check if alias does not contain special characters
            if (!preg_match('/^[a-zA-Z0-9]+$/', $alias)) {
                throw new \Exception("Alias can not contain special characters");
            }
            //check if alias is one word
            if (strpos($alias, ' ') !== false) {
                throw new \Exception("Alias can not contain spaces");
            }

            //check if alias is 24 characters or under
            if (strlen($alias) > 24) {
                throw new \Exception("Alias can not be more than 24 characters");
            }

            $this->alias = $alias;
            return $this;
        }
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image){
        $this->image = "/assets/img/franchises/placeholder.png";
        return $this;
    }

    public function franchiseExists($name){
        //check if franchise name already exists
        $conn = Db::getConnection();
        $smtm = $conn->prepare("SELECT * FROM franchises WHERE name = :name");
        $smtm->bindParam(":name", $name);
        $smtm->execute();
        $result = $smtm->fetch();

        if($result){
            throw new \Exception("Franchise with this name already exists");
        }else{
            return false;
        }
    }

    //function to check if alias already exists
    public function aliasExists($alias){
        //check if franchise alias already exists
        $conn = Db::getConnection();
        $smtm = $conn->prepare("SELECT name FROM franchises WHERE alias = :alias");
        $smtm->bindParam(":alias", $alias);
        $smtm->execute();
        $result = $smtm->fetch();

        if($result){
            throw new \Exception("This alias is already being used by ".$result['name']);
        }else{
            return false;
        }
    }

    public function save(){
        //check if franchise name already exists
        if($this->franchiseExists($this->getName())){
            return;
        }
        if($this->aliasExists($this->getAlias())){
            return;
        }

        $conn = Db::getConnection();
        $stmt = $conn->prepare("INSERT INTO franchises (name, alias, img) VALUES (:name, :alias, :image)");

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":alias", $this->alias);
        $stmt->bindParam(":image", $this->image);

        try{
            return $stmt->execute();
        }catch(\PDOException $e){
            throw new \Exception("Error: ".$e->getMessage());
        }

    }

    public static function getAll()
    {
        // Get all franchises from the database
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM franchises");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //function to get all except the one with the name 'all'
    public static function getAllExceptEverything()
    {
        // Get all franchises from the database
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM franchises WHERE name != 'everything'");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //function to get franchise by alias
    public static function getByAlias($alias){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM franchises WHERE alias = :alias");
        $stmt->bindParam(":alias", $alias);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
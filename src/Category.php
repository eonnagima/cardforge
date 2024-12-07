<?php

namespace Codinari\Cardforge;

use Codinari\Cardforge\Db;
use Codinari\Cardforge\Franchise;

class Category{
    private $name;
    private $alias;
    private $franchise;

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

    public function setAlias()
    {
        //generate a unique alias to be used in url
        $alias = strtolower(str_replace(" ", "-", $this->name));
        //also remove specialchars from alias
        $alias = preg_replace('/[^A-Za-z0-9\-]/', '', $alias);
        $this->alias = $alias;
        return $this;
    }

    public function getFranchise()
    {
        return $this->franchise;
    }

    public function setFranchise($franchise)
    {
        if (empty($franchise)) {
            throw new \Exception("Franchise can't be empty");
        } else {
            $this->franchise = $franchise;
            return $this;
        }
    }

    public function save(){
        $conn = Db::getConnection();

        $query = 'INSERT INTO categories (name, alias, franchise_id) VALUES (
            :name, 
            :alias, 
            (SELECT franchises.id FROM franchises WHERE franchises.alias = :franchise)
        )';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':alias', $this->alias);
        $stmt->bindValue(':franchise', $this->franchise);

        $result = $stmt->execute();

        if($result){
            return true;
        }else{
            throw new \Exception("Failed to save category");
        }
    }

    public static function getAll(){
        $conn = Db::getConnection();

        $query = 'SELECT * FROM categories';

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $categories;
    }

    public static function getAllByFranchise($franchise){
        $conn = Db::getConnection();

        $query = 'SELECT * FROM categories WHERE franchise_id = (SELECT franchises.id FROM franchises WHERE franchises.alias = :franchise)';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':franchise', $franchise);
        $stmt->execute();

        $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $categories;
    }

    public static function getById($id){
        $conn = Db::getConnection();

        $query = 'SELECT * FROM categories WHERE id = :id';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $category = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $category;
    }

    public static function getByAlias($alias){
        $conn = Db::getConnection();

        $query = 'SELECT * FROM categories WHERE alias = :alias';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':alias', $alias);
        $stmt->execute();

        $category = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $category;
    }
}
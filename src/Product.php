<?php

namespace Codinari\Cardforge;
//enable class Db.php to be used in this file with composer
use Codinari\Cardforge\Db;

class Product{
    private $name;
    private $description;
    private $price;
    private $image;
    private $category;
    private $franchise;

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of franchise
     */ 
    public function getFranchise()
    {
        return $this->franchise;
    }

    /**
     * Set the value of franchise
     *
     * @return  self
     */ 
    public function setFranchise($franchise)
    {
        $this->franchise = $franchise;

        return $this;
    }

    public static function save(){
        $conn = DB::getConnection();
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, image, category, franchise) VALUES (:name, :description, :price, :image, :category, :franchise)");
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":franchise", $this->franchise);
        $stmt->execute();
    }

    public static function getProductsByFranchise($franchise){
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT * FROM products WHERE franchise = :franchise");
        $stmt->bindValue(":franchise", $franchise);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }
}
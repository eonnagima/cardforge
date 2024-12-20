<?php

namespace Codinari\Cardforge;

use Codinari\Cardforge\Db;

class Product{
    private $name;
    private $description;
    private $details;
    private $alias;
    private $price;
    private $stock;
    private $category;
    private $franchise;
    private $releaseDate;
    private $setName;

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


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        //description cant be empty
        if (empty($description)) {
            throw new \Exception("Description can't be empty");
        } else {
            $this->description = $description;
            return $this;
        }
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details)
    {
        if (empty($details)) {
            $this->details = null;
        } else {
            $this->details = $details;
            return $this;
        }
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        //generate a unique alias to be used in url when new product is created
        if(empty($alias)){
            $alias = strtolower(str_replace(" ", "-", $this->name));
            //also remove specialchars from alias
            $alias = preg_replace('/[^A-Za-z0-9\-]/', '', $alias);
        }
        
        $this->alias = $alias;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        if (empty($price)) {
            throw new \Exception("Price can't be empty");
        } else {
            //convert input string to float, if this fails, throw an exception
            $price = floatval($price);
            if(!$price){
                throw new \Exception("Price must be a number");
            }
            $this->price = $price;
            return $this;
        }
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        //stock cant be empty
        if (empty($stock)) {
            throw new \Exception("Stock can't be empty");
        } else {
            //convert input string to int, if this fails, throw an exception
            $stock = intval($stock);
            if(!$stock){
                throw new \Exception("Stock must be a number");
            }
            $this->stock = $stock;
        }
    }


    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        //category cant be empty
        if (empty($category)) {
            throw new \Exception("Category can't be empty");
        } else {
            $this->category = $category;
            return $this;
        }
    }

    public function getFranchise()
    {
        return $this->franchise;
    }

    public function setFranchise($franchise)
    {
        //franchise cant be empty
        if (empty($franchise)) {
            throw new \Exception("Franchise can't be empty");
        } else {
            $this->franchise = $franchise;
            return $this;
        }
    }


    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function setReleaseDate($releaseDate)
    {
        //if empty, set to null
        if(empty($releaseDate)){
            $this->releaseDate = null;
        }else{
            $this->releaseDate = $releaseDate;
        }
        return $this;
    }

    public function getSetName()
    {
        return $this->setName;
    }

    public function setSetName($setName)
    {
        //if empty, set to null
        if(empty($setName)){
            $this->setName = null;
        }else{
            $this->setName = $setName;
        }
        return $this;
    }

    public function productExists($product){
        $conn = Db::getConnection();
        $smtm = $conn->prepare("SELECT * FROM products WHERE name = :name");
        $smtm->bindParam(":name", $product);
        $smtm->execute();
        $result = $smtm->fetch();

        if($result){
            throw new \Exception("Product with this name already exists");
        }else{
            return false;
        }
    }

    //function to check if alias already exists
    public function aliasExists($alias){
        //check if product alias already exists
        $conn = Db::getConnection();
        $smtm = $conn->prepare("SELECT name FROM products WHERE alias = :alias");
        $smtm->bindParam(":alias", $alias);
        $smtm->execute();
        $result = $smtm->fetch();

        if($result){
            throw new \Exception("A product with this alias is already exists. Please choose a different name");
        }else{
            return false;
        }
    }

    public function save(){
        //check if product name already exists
        if($this->productExists($this->getName())){
            return;
        }
        if($this->aliasExists($this->getAlias())){
            return;
        }

        $conn = Db::getConnection();

        $query = "INSERT INTO products (name, description, details,  alias, price, stock, franchise_id, category_id, set_name, release_date) VALUES (
            :name,
            :description,
            :details,
            :alias,
            :price,
            :stock,
            (SELECT franchises.id FROM franchises WHERE franchises.alias = :franchise),
            (SELECT categories.id FROM categories WHERE categories.alias = :category),
            :set_name,
            :release_date
        )";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":details", $this->details);
        $stmt->bindParam(":alias", $this->alias);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":franchise", $this->franchise);
        $stmt->bindParam(":release_date", $this->releaseDate);
        $stmt->bindParam(":set_name", $this->setName);

        $result = $stmt->execute();

        if($result){
            return true;
        }else{
            throw new \Exception("Failed to save product");
        }
    }

    public static function getAll(){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $result = $stmt->fetchAll();

        if($result){
            return $result;
        }else{
            throw new \Exception("No products found");
        }
    }

    public static function getAllByFranchise($franchise){
        $conn = Db::getConnection();
        //query with inner join between products and franchises
        $query = "SELECT products.* FROM products WHERE (SELECT franchises.id FROM franchises WHERE franchises.alias = :franchise) = products.franchise_id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":franchise", $franchise);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if($result){
            return $result;
        }else{
            throw new \Exception("No products found");
        }
    }

    public static function getByAlias($alias){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM products WHERE alias = :alias");
        $stmt->bindParam(":alias", $alias);
        $stmt->execute();
        $result = $stmt->fetch();

        if($result){
            return $result;
        }else{
            throw new \Exception("Product not found");
        }
    }

    public static function getById($id){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();

        if($result){
            return $result;
        }else{
            throw new \Exception("Product not found");
        }
    }

    public static function getNewArrivals(){
        $conn = Db::getConnection();
        //get the 4 products with the most recent created field
        $stmt = $conn->prepare("SELECT * FROM products ORDER BY created DESC LIMIT 4");
        $stmt->execute();

        $result = $stmt->fetchAll();

        if($result){
            return $result;
        }else{
            throw new \Exception("No new arrivals found");
        }
    }

    public static function getAllSortBy($sort){
        $conn = Db::getConnection();

        switch($sort){
            case "newest":
                $sort = "created DESC";
                break;
            case "oldest":
                $sort = "created ASC";
                break;
            case "cheapest":
                $sort = "price ASC";
                break;
            case "expensive":
                $sort = "price DESC";
                break;
            default:
        }
        
        $query = "SELECT * FROM products ORDER BY $sort";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getAllByFranchiseSortBy($franchise, $sort){
        $conn = Db::getConnection();

        switch($sort){
            case "newest":
                $sort = "created DESC";
                break;
            case "oldest":
                $sort = "created ASC";
                break;
            case "cheapest":
                $sort = "price ASC";
                break;
            case "expensive":
                $sort = "price DESC";
                break;
            default:
        }
        
        $query = "SELECT * FROM products WHERE franchise_id = 
            (SELECT franchises.id FROM franchises WHERE franchises.alias = :franchise)
            ORDER BY $sort"
        ;

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":franchise", $franchise);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getAllBySearch($searchRequest){
        // convert search request to lowercase
        $searchRequest = strtolower($searchRequest);
        $searchRequest = "%".$searchRequest."%";

        $conn = Db::getConnection();
        
        $query = "SELECT * FROM products WHERE 
            LOWER(name) LIKE :searchRequest1 OR
            LOWER(description) LIKE :searchRequest2 OR
            LOWER(alias) LIKE :searchRequest3";

        $stmt = $conn->prepare($query);
        $stmt->bindValue(":searchRequest1", $searchRequest);
        $stmt->bindValue(":searchRequest2", $searchRequest);
        $stmt->bindValue(":searchRequest3", $searchRequest);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if($result){
            return $result;
        }else{
            throw new \Exception("Sorry, but we couldn't find any products based on your search");
        }
    }

    public static function updateStock($product, $quantity){
        $conn = Db::getConnection();

        $query = "UPDATE products SET 
            stock = stock - :quantity,
            updated = CURRENT_TIMESTAMP
            WHERE id = (SELECT id FROM products WHERE alias = :product)
        ";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":product", $product);
        $stmt->execute();
    }

    public static function delete($id){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }

    public function update($id){
        $conn = Db::getConnection();

        $query = "UPDATE products SET
            name = :name,
            description = :description,
            details = :details,
            alias = :alias,
            price = :price,
            stock = :stock,
            franchise_id = (SELECT franchises.id FROM franchises WHERE franchises.alias = :franchise),
            category_id = (SELECT categories.id FROM categories WHERE categories.alias = :category),
            set_name = :set_name,
            release_date = :release_date,
            updated = CURRENT_TIMESTAMP
        WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":details", $this->details);
        $stmt->bindParam(":alias", $this->alias);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":franchise", $this->franchise);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":set_name", $this->setName);
        $stmt->bindParam(":release_date", $this->releaseDate);
        $stmt->bindParam(":id", $id);

        try{
            return $stmt->execute();
        }catch(\PDOException $e){
            throw new \Exception("Error: ".$e->getMessage());
        }
    }
}
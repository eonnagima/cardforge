<?php

namespace Codinari\Cardforge;

use Codinari\Cardforge\Db;

class ProductImage{
    private $product;
    private $img;
    private $alt;
    private $primaryImg;

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        if (empty($product)) {
            throw new \Exception("Product can't be empty");
        } else {
            $this->product = $product;
            return $this;
        }
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        if (empty($img)) {
            throw new \Exception("Image can't be empty");
        } else {
            $this->img = $img;
            return $this;
        }
    }

    public function getAlt()
    {
        return $this->alt;
    }

    public function setAlt($alt)
    {
        if (empty($alt)) {
            throw new \Exception("Alt can't be empty");
        } else {
            $this->alt = $alt;
            return $this;
        }
    }

    public function getPrimaryImg()
    {
        return $this->primaryImg;
    }

    public function setPrimaryImg($primaryImg)
    {
        if (empty($primaryImg)) {
            throw new \Exception("Primary Image can't be empty");
        } else {
            $this->primaryImg = $primaryImg;
            return $this;
        }
    }

    public function save(){
        $conn = Db::getConnection();

        $query = "INSERT INTO product_images (product_id, img, alt, primary_img) VALUES (
            (SELECT products.id FROM products WHERE products.alias = :product),
            :img, 
            :alt, 
            :primary_img
        )";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":product", $this->product);
        $stmt->bindParam(":img", $this->img);
        $stmt->bindParam(":alt", $this->alt);
        $stmt->bindParam(":primary_img", $this->primaryImg);

        $result = $stmt->execute();

        if($result){
            return true;
        }else{
            throw new \Exception("Failed to save product");
        }
    }

    public static function getAllByProduct($product){
        $conn = Db::getConnection();

        $query = "SELECT * FROM product_images INNER JOIN products ON product_images.product_id = products.id WHERE product.alias = :product";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getPrimaryByProduct($product){
        $conn = Db::getConnection();

        $query = "SELECT * FROM product_images INNER JOIN products ON product_images.product_id = products.id WHERE product.alias = :product AND product_images.primary_img = 1";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
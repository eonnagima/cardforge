<?php

namespace Codinari\Cardforge;

use Codinari\Cardforge\Db;

class ProductImage{
    private $product;
    private $url;
    private $alt;
    private $primaryImg;

    use Traits\ImageUploadTrait;
    use Traits\IsImageTrait;

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

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        if (empty($url)) {
            throw new \Exception("Image can't be empty");
        } else {
            $this->url = $url;
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
        if ($primaryImg === null || $primaryImg === '') {
            throw new \Exception("Primary Image can't be empty");
        } else {
            $this->primaryImg = $primaryImg;
            return $this;
        }
    }

    public function save(){
        $conn = Db::getConnection();

        $query = "INSERT INTO product_images (product_id, url, alt, primary_image) VALUES (
            (SELECT products.id FROM products WHERE products.alias = :product),
            :url, 
            :alt, 
            :primary_image
        )";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":product", $this->product);
        $stmt->bindParam(":url", $this->url);
        $stmt->bindParam(":alt", $this->alt);
        $stmt->bindParam(":primary_image", $this->primaryImg);

        $result = $stmt->execute();

        if($result){
            return true;
        }else{
            throw new \Exception("Failed to save image");
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

        $query = "SELECT * FROM product_images WHERE product_id = (SELECT products.id FROM products WHERE products.alias = :product) AND primary_image = 1";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":product", $product);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getOtherImagesByProduct($product){
        $conn = Db::getConnection();

        $query = "SELECT * FROM product_images WHERE product_id = (SELECT products.id FROM products WHERE products.alias = :product) AND primary_image = 0";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":product", $product);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function drawImage($image, $alt){

        $image = "<div class='slide'><img class='slide-img' src='{$image}' alt='{$alt}'></div>";

        return $image;
    }
}
<?php

namespace Codinari\Cardforge;

use Codinari\Cardforge\Db;

class Review{
    private $id;
    private $userId;
    private $productId;
    private $rating;
    private $text;
    private $anonymous;
    private $date;

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function getAnonymous()
    {
        return $this->anonymous;
    }

    public function setAnonymous($anonymous)
    {
        $this->anonymous = $anonymous;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function save($user, $product){
        $conn = Db::getConnection();

        $query = 'INSERT INTO product_reviews (user_id, product_id, rating, text, anonymous) VALUES (
            (SELECT users.id FROM users WHERE users.email = :user),
            (SELECT products.id FROM products WHERE products.alias = :product),
            :rating,
            :text,
            :anonymous
        )';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':user', $user);
        $stmt->bindValue(':product', $product);
        $stmt->bindValue(':rating', $this->rating);
        $stmt->bindValue(':text', $this->text);
        $stmt->bindValue(':anonymous', $this->anonymous);

        $result = $stmt->execute();

        if($result){
            return true;
        }else{
            throw new \Exception("Failed to save review");
        }
    }

    public static function countReviews($product){
        $conn = Db::getConnection();

        $query = 'SELECT COUNT(*) FROM product_reviews WHERE product_id = (SELECT products.id FROM products WHERE products.alias = :product)';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':product', $product);
        $stmt->execute();

        $result = $stmt->fetchColumn();

        return $result;
    }

    public static function averageScore($product){
        $conn = Db::getConnection();

        $query = 'SELECT ROUND(AVG(rating)) FROM product_reviews WHERE product_id = (SELECT products.id FROM products WHERE products.alias = :product)';

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':product', $product);
        $stmt->execute();

        $result = $stmt->fetchColumn();

        return $result;
    }

    public static function drawRating($rating){
        $stars = '';

        for($i = 0; $i < 5; $i++){
            if($i < $rating){
                $stars .= '<span class="fa fa-star"></span>';
            }else{
                $stars .= '<span class="far fa-star"></span>';
            }
        }

        return $stars;
    }

    public static function getAllReviewsByProduct($product){
        $conn = Db::getConnection();

        $query = "SELECT * FROM product_reviews WHERE product_id = (SELECT products.id FROM products WHERE products.alias = :product)";

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':product', $product);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }
}
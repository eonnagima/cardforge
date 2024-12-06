<?php

namespace Codinari\Cardforge;

use Codinari\Cardforge\Db;

class OrderProduct{
    private $order;
    private $product;
    private $quantity;

    public function getOrder($order){
        $this->order = $order;
    }

    public function setOrder($order)
    {
        if (empty($order)) {
            throw new \Exception("Order can't be empty");
        } else {
            $this->order = $order;
            return $this;
        }
    }

    public function getProduct($product){
        $this->product = $product;
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

    public function getQuantity($quantity){
        $this->quantity = $quantity;
    }

    public function setQuantity($quantity)
    {
        if (empty($quantity)) {
            throw new \Exception("Quantity can't be empty");
        } else {
            $this->quantity = $quantity;
            return $this;
        }
    }

    public function save(){
        $conn = Db::getConnection();

        $query = "INSERT INTO order_has_products (order_id, product_id, quantity) VALUES (
            (SELECT id FROM orders WHERE alias = :order), 
            (SELECT id FROM products WHERE alias = :product), 
            :quantity
        )";

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':order', $this->order);
        $stmt->bindValue(':product', $this->product);
        $stmt->bindValue(':quantity', $this->quantity);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            throw new \Exception("Error saving order product");
        }
    }

    public static function getAllByOrder($order){
        $conn = Db::getConnection();

        $query = "SELECT * FROM order_has_products WHERE order_id = (SELECT id FROM orders WHERE alias = :order)";
        
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':order', $order);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }
}
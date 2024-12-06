<?php

namespace Codinari\Cardforge;

use Codinari\Cardforge\Db;

class Order{
    private $alias;
    private $user;
    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $street;
    private $house_number;
    private $address_extra;
    private $city;
    private $zip;
    private $country;
    private $status;

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        if (empty($alias)) {
            //generate a random and unique order alias
            $alias = uniqid();
        }

        $this->alias = $alias;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        if (empty($user)) {
            $user = null;
        } else {
            $this->user = $user;
            return $this;
        }
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        if (empty($first_name)) {
            throw new \Exception("First name can't be empty");
        } else {
            $this->first_name = $first_name;
            return $this;
        }
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        if (empty($last_name)) {
            throw new \Exception("Last name can't be empty");
        } else {
            $this->last_name = $last_name;
            return $this;
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if (empty($email)) {
            throw new \Exception("Email can't be empty");
        } else {
            $this->email = $email;
            return $this;
        }
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        if (empty($phone)) {
            throw new \Exception("Phone can't be empty");
        } else {
            $this->phone = $phone;
            return $this;
        }
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street)
    {
        if (empty($street)) {
            throw new \Exception("Street can't be empty");
        } else {
            $this->street = $street;
            return $this;
        }
    }

    public function getHouseNumber()
    {
        return $this->house_number;
    }

    public function setHouseNumber($house_number)
    {
        if (empty($house_number)) {
            throw new \Exception("House number can't be empty");
        } else {
            $this->house_number = $house_number;
            return $this;
        }
    }

    public function getAdressExtra()
    {
        return $this->address_extra;
    }

    public function setAdressExtra($address_extra)
    {   
        if(empty($address_extra)){
            $address_extra = null;
        }

        $this->address_extra = $address_extra;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        if (empty($city)) {
            throw new \Exception("City can't be empty");
        } else {
            $this->city = $city;
            return $this;
        }
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function setZip($zip)
    {
        if (empty($zip)) {
            throw new \Exception("Zip can't be empty");
        } else {
            $this->zip = $zip;
            return $this;
        }
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        if (empty($country)) {
            throw new \Exception("Country can't be empty");
        } else {
            $this->country = $country;
            return $this;
        }
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        if (empty($status)) {
            throw new \Exception("Status can't be empty");
        } else {
            $this->status = $status;
            return $this;
        }
    }

    public function save(){
        $conn = Db::getConnection();

        if($this->user == null){
            $userQuery = ':user';
        }else{
            $userQuery = "(SELECT id FROM users WHERE email = :user)";
        }

        $query = "INSERT INTO orders (alias, user_id, first_name, last_name, email, phone, street, house_number, address_extra, city, zip, country, status) VALUES (
            :alias,
            $userQuery,
            :first_name,
            :last_name,
            :email,
            :phone,
            :street,
            :house_number,
            :address_extra,
            :city,
            :zip,
            :country,
            :status
        )";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":alias", $this->alias);
        $stmt->bindParam(":user", $this->user);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":street", $this->street);
        $stmt->bindParam(":house_number", $this->house_number);
        $stmt->bindParam(":address_extra", $this->address_extra);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":zip", $this->zip);
        $stmt->bindParam(":country", $this->country);
        $stmt->bindParam(":status", $this->status);

        $result = $stmt->execute();

        if($result){
            return true;
        }else{
            throw new \Exception("Failed to save order");
        }
    }

    public static function getAll(){
        $conn = Db::getConnection();
        $query = "SELECT * FROM orders";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getByAlias($alias){
        $conn = Db::getConnection();
        $query = "SELECT * FROM orders WHERE alias = :alias";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":alias", $alias);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
}
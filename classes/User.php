<?php

include_once(__DIR__."/Db.php");

class User {
    private $first_name;
    private $last_name;
    private $email;
    private $avatar;
    private $date_of_birth;
    private $phone_number;
    private $adress_street;
    private $adress_number;
    private $adress_extra;
    private $adress_zip;
    private $adress_province;
    private $adress_country;
    private $password;

    /**
     * Get the value of first_name
     */ 
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */ 
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */ 
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of avatar
     */ 
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */ 
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of date_of_birth
     */ 
    public function getDate_of_birth()
    {
        return $this->date_of_birth;
    }

    /**
     * Set the value of date_of_birth
     *
     * @return  self
     */ 
    public function setDate_of_birth($date_of_birth)
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    /**
     * Get the value of phone_number
     */ 
    public function getPhone_number()
    {
        return $this->phone_number;
    }

    /**
     * Set the value of phone_number
     *
     * @return  self
     */ 
    public function setPhone_number($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * Get the value of adress_street
     */ 
    public function getAdress_street()
    {
        return $this->adress_street;
    }

    /**
     * Set the value of adress_street
     *
     * @return  self
     */ 
    public function setAdress_street($adress_street)
    {
        $this->adress_street = $adress_street;

        return $this;
    }

    /**
     * Get the value of adress_number
     */ 
    public function getAdress_number()
    {
        return $this->adress_number;
    }

    /**
     * Set the value of adress_number
     *
     * @return  self
     */ 
    public function setAdress_number($adress_number)
    {
        $this->adress_number = $adress_number;

        return $this;
    }

    /**
     * Get the value of adress_extra
     */ 
    public function getAdress_extra()
    {
        return $this->adress_extra;
    }

    /**
     * Set the value of adress_extra
     *
     * @return  self
     */ 
    public function setAdress_extra($adress_extra)
    {
        $this->adress_extra = $adress_extra;

        return $this;
    }

    /**
     * Get the value of adress_zip
     */ 
    public function getAdress_zip()
    {
        return $this->adress_zip;
    }

    /**
     * Set the value of adress_zip
     *
     * @return  self
     */ 
    public function setAdress_zip($adress_zip)
    {
        $this->adress_zip = $adress_zip;

        return $this;
    }

    /**
     * Get the value of adress_province
     */ 
    public function getAdress_province()
    {
        return $this->adress_province;
    }

    /**
     * Set the value of adress_province
     *
     * @return  self
     */ 
    public function setAdress_province($adress_province)
    {
        $this->adress_province = $adress_province;

        return $this;
    }

    /**
     * Get the value of adress_country
     */ 
    public function getAdress_country()
    {
        return $this->adress_country;
    }

    /**
     * Set the value of adress_country
     *
     * @return  self
     */ 
    public function setAdress_country($adress_country)
    {
        $this->adress_country = $adress_country;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    public function save(){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        
        return $stmt->execute();
    }

}
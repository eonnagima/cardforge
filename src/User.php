<?php

namespace Codinari\Cardforge;

//enable class Db.php to be used in this file with composer
use Codinari\Cardforge\Db;
use Codinari\Cardforge\Interfaces\iUser;

class User implements iUser{
    //required properties
    protected $email;
    protected $password;
    protected $role;
    //optional user detail properties
    protected $first_name;
    protected $last_name;
    protected $avatar;
    protected $date_of_birth;
    protected $phone_number;
    //optional adress properties
    protected $adress_street;
    protected $adress_number;
    protected $adress_extra;
    protected $adress_zip;
    protected $adress_country;
    
    public function getFirst_name()
    {
        if(empty($this->first_name)){
            return "No first name";
        }else{
            return $this->first_name;
        }
    }

    public function setFirst_name($first_name)
    {
        if(empty($first_name)){
            $this->first_name = null;
        }else{
            $this->first_name = $first_name;
        }

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        if(empty($this->last_name)){
            return "No last name";
        }else{
            return $this->last_name;
        }
    }

    
    public function setLast_name($last_name)
    {
        if(empty($last_name)){
            $this->last_name = null;    
        }else{
            $this->last_name = $last_name;
        }

        return $this;
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
            //check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception("Invalid email");
            }

            $this->email = $email;
            return $this;
        }
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        if(empty($avatar)){
            $avatar = "assets/img/avatar/default.png";
        }

        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Get the value of date_of_birth
     */ 
    public function getDate_of_birth()
    {
        if(empty($this->date_of_birth)){
            return "No date of birth";
        }else{
            return $this->date_of_birth;
        }
    }

    public function setDate_of_birth($date_of_birth)
    {
        if(empty($date_of_birth)){
            $this->date_of_birth = null;
        }else{
            $this->date_of_birth = $date_of_birth;
        }
        return $this;
    }

    /**
     * Get the value of phone_number
     */ 
    public function getPhone_number()
    {
        if(empty($this->phone_number)){
            return "No phone number";
        }else{
            return $this->phone_number;
        }
    }

    public function setPhone_number($phone_number)
    {
        if (!empty($phone_number)) {
            //check if phone number is valid
            $pattern = "/^\+?[1-9]\d{1,14}$/";
    
            // Check if the phone number matches the pattern
            if (preg_match($pattern, $phone_number)) {
                throw new \Exception("Invalid phone number");
            }else{
                $this->phone_number = $phone_number;
            }

            return $this;
        }
    }

    public function getAdress_street()
    {
        if(empty($this->adress_street)){
            return "No street";
        }else{
            return $this->adress_street;
        }
    }

    public function setAdress_street($adress_street)
    {
        if(empty($adress_street)){
            $this->adress_street = null;
        }else{
            $this->adress_street = $adress_street;
        }

        return $this;
    }

    public function getAdress_number()
    {
        if(empty($this->adress_number)){
            return "No house number";
        }else{
            return $this->adress_number;
        }
    }

    public function setAdress_number($adress_number)
    {
        if(empty($adress_number)){
            $this->adress_number = null;
        }else{
            $this->adress_number = $adress_number;
        }

        return $this;
    }

    public function getAdress_extra()
    {
        if(empty($this->adress_extra)){
            return "No extra adress info";
        }else{
            return $this->adress_extra;
        }
    }

    
    public function setAdress_extra($adress_extra)
    {
        if(empty($adress_extra)){
            $this->adress_extra = null;
        }else{
            $this->adress_extra = $adress_extra;
        }

        return $this;
    }

    public function getAdress_zip()
    {
        if(empty($this->adress_zip)){
            return "No zip code";
        }else{
            return $this->adress_zip;
        }
    }

    public function setAdress_zip($adress_zip)
    {
        if(empty($adress_zip)){
            $this->adress_zip = null;
        }else{
            $this->adress_zip = $adress_zip;
        }

        return $this;
    }

    public function getAdress_country()
    {
        if(empty($this->adress_country)){
            return "No country";
        }else{
            return $this->adress_country;
        }
    }

    public function setAdress_country($adress_country)
    {
        if(empty($adress_country)){
            $this->adress_country = null;
        }else{
            $this->adress_country = $adress_country;
        }

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function validatePassword($password){
        $errors = [];

        if (strlen($password) < 8) {
            $errors[] = "be at least 8 characters long";
        }
    
        // Check for at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "contain at least one uppercase letter";
        }
    
        // Check for at least one lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "contain at least one lowercase letter";
        }
    
        // Check for at least one number
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "contain at least one number";
        }
    
        if (!empty($errors)) {
            throw new \Exception("Password must ".implode(" and ", $errors));
        }

    }

    public function setPassword($password)
    {
        if (empty($password)) {
            throw new \Exception("Password can't be empty");
        } else {
            $this->validatePassword($password);
            $this->password = $password;
            return $this;
        }
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public static function userExists($email){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            throw new \Exception("User with this email already exists");
        } else {
            return false;
        }
    }

    public function login(){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            
            // Generate a unique token for the user
            $token = $this->generateLoginToken();
            // // Store the token in the database
            $this->saveLoginToken($token);
            // // Set session variables
            $_SESSION['email'] = $user['email'];
            $_SESSION['login_token'] = $token;
            return true;
        } else {
            //throw exception invalid password or email
            throw new \Exception("The entered email or password is incorrect");
        }
    }

    protected function generateLoginToken(){
        return bin2hex(random_bytes(32));
    }

    protected function saveLoginToken($token){
        $conn = Db::getConnection();
        
        $stmt = $conn->prepare("UPDATE users SET login_token = '$token', updated = CURRENT_TIMESTAMP WHERE email = :email");
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
    }

    public static function validateLogin(){
        if (!empty($_SESSION['email']) && !empty($_SESSION['login_token'])) {
            $conn = Db::getConnection();
            // Checks if there is a user with the email in the session variable exists and if it's token matches the one in the session variable
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND login_token = :token");
            $stmt->bindParam(':email', $_SESSION['email']);
            $stmt->bindParam(':token', $_SESSION['login_token']);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                //if login is valid, return true
                return true;
            } else {
                // Invalid session, destroy it
                session_destroy();
                return false;
            }
        } else {
            return false;
        }
    }

    public  static function getByEmail($email){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        return $user;
    }
    
    public static function isAdmin($email){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindValue(":email", $email);
        $query->execute();
        $user = $query->fetch();
        
        if($user['role'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
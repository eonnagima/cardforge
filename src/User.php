<?php

namespace Codinari\Cardforge;

//enable class Db.php to be used in this file with composer
use Codinari\Cardforge\Db;
use Codinari\Cardforge\Interfaces\iUser;

class User implements iUser{
    protected $id;
    protected $email;
    protected $password;
    protected $role;
    //optional user detail properties
    protected $first_name;
    protected $last_name;
    protected $avatar;
    protected $date_of_birth;
    protected $phone_number;
    //optional address properties
    protected $address_street;
    protected $address_number;
    protected $address_extra;
    protected $address_city;
    protected $address_zip;
    protected $address_country;
    protected $wallet;

    use Traits\ImageUploadTrait;
    use Traits\IsImageTrait;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
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
        if(empty($this->address_street)){
            return "";
        }else{
            return $this->address_street;
        }
    }

    public function setAdress_street($address_street)
    {
        if(empty($address_street)){
            $this->address_street = null;
        }else{
            $this->address_street = $address_street;
        }

        return $this;
    }

    public function getAdress_number()
    {
        if(empty($this->address_number)){
            return "";
        }else{
            return $this->address_number;
        }
    }

    public function setAdress_number($address_number)
    {
        if(empty($address_number)){
            $this->address_number = null;
        }else{
            $this->address_number = $address_number;
        }

        return $this;
    }

    public function getAdress_extra()
    {
        if(empty($this->address_extra)){
            return "";
        }else{
            return $this->address_extra;
        }
    }

    
    public function setAdress_extra($address_extra)
    {
        if(empty($address_extra)){
            $this->address_extra = null;
        }else{
            $this->address_extra = $address_extra;
        }

        return $this;
    }

    public function getAdress_city()
    {
        if(empty($this->address_city)){
            return "";
        }else{
            return $this->address_city;
        }
    }

    public function setAdress_city($address_city)
    {
        if(empty($address_city)){
            $this->address_city = null;
        }else{
            $this->address_city = $address_city;
        }

        return $this;
    }

    public function getAdress_zip()
    {
        if(empty($this->address_zip)){
            return "";
        }else{
            return $this->address_zip;
        }
    }

    public function setAdress_zip($address_zip)
    {
        if(empty($address_zip)){
            $this->address_zip = null;
        }else{
            $this->address_zip = $address_zip;
        }

        return $this;
    }

    public function getAdress_country()
    {
        if(empty($this->address_country)){
            return "";
        }else{
            return $this->address_country;
        }
    }

    public function setAdress_country($address_country)
    {
        if(empty($address_country)){
            $this->address_country = null;
        }else{
            $this->address_country = $address_country;
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
            //$this->validatePassword($password);
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

    public function getWallet()
    {
        return $this->wallet;
    }

    public function setWallet($wallet)
    {
        if(!empty($wallet)){
            floatval($wallet);
            $this->wallet = $wallet;
            return $this;
        }else{
            throw new \Exception("Wallet can't be empty");
        }


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

    public static function getById($id){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
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

    public function update(){
        $conn = Db::getConnection();
        
        //query to update user where :id = $this->id
        $query = "UPDATE users SET 
            email = :email, 
            first_name = :first_name, 
            last_name = :last_name, 
            avatar = :avatar, 
            date_of_birth = :date_of_birth, 
            phone_number = :phone_number, 
            address_street = :address_street, 
            address_number = :address_number, 
            address_extra = :address_extra, 
            address_zip = :address_zip, 
            address_country = :address_country,
            updated = CURRENT_TIMESTAMP
            WHERE id = :id
        ";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':avatar', $this->avatar);
        $stmt->bindParam(':date_of_birth', $this->date_of_birth);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':address_street', $this->address_street);
        $stmt->bindParam(':address_number', $this->address_number);
        $stmt->bindParam(':address_extra', $this->address_extra);
        $stmt->bindParam(':address_zip', $this->address_zip);
        $stmt->bindParam(':address_country', $this->address_country);

        return $stmt->execute();
    }

    public function updatePassword(){
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        
        $conn = Db::getConnection();
        $query = "UPDATE users SET password = :password WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':password', $hash);

        return $stmt->execute();
    }

    public function topUpWallet($ammount){
        $conn = Db::getConnection();

        $this->wallet += $ammount;

        $query = "UPDATE users SET wallet = :wallet WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':wallet', $this->wallet);

        return $stmt->execute();
    }

    public function withdrawFromWallet($ammount){
        $conn = Db::getConnection();

        $this->wallet -= $ammount;

        $query = "UPDATE users SET wallet = :wallet WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':wallet', $this->wallet);

        return $stmt->execute();
    }
    
}
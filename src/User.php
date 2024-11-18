<?php

namespace Codinari\Cardforge;

//enable class Db.php to be used in this file with composer
use Codinari\Cardforge\Db;

class User {
    
    
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $avatar;
    protected $date_of_birth;
    protected $phone_number;
    protected $adress_street;
    protected $adress_number;
    protected $adress_extra;
    protected $adress_zip;
    protected $adress_province;
    protected $adress_country;
    protected $password;
    protected $role;

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
        if (!empty($phone_number)) {
            //check if phone number is valid
            $pattern = "/^\+?[1-9]\d{1,14}$/";
    
            // Check if the phone number matches the pattern
            if (preg_match($pattern, $phone_number)) {
                throw new \Exception("Invalid phone number");
            }

            $this->phone_number = $phone_number;
            return $this;
        }
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

    // public function verifyLogin($email, $pw){
	// 	$conn = Db::getConnection();
		
	// 	$stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
	// 	$stmt->bindParam(':email', $email);
	// 	$stmt->execute();

	// 	$user = $stmt->fetch(\PDO::FETCH_ASSOC);
	// 	//if no user is found, fetch will return false
	// 	if($user){
	// 		$hash = $user['password'];
	// 		if(password_verify($pw, $hash)){
	// 			return true;
	// 		}else{
	// 			return false;
	// 		}
	// 	}else{
	// 		return false;
	// 	}
	// }

    public static function userExists($email){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindValue(":email", $email);
        $query->execute();
        $user = $query->fetch();

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
            session_start();
            $_SESSION['email'] = $user['email'];
            $_SESSION['login_token'] = $token;
            return true;
        } else {
            //throw exception invalid password or email
            throw new \Exception("The entered email or password is incorrect");
        }
    }

    protected function  generateLoginToken(){
        return bin2hex(random_bytes(32));
    }

    protected function saveLoginToken($token){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("UPDATE users SET login_token = '$token' WHERE email = :email");
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
    }

    public static function validateLogin(){
        if (!empty($_SESSION['user_id']) && !empty($_SESSION['login_token'])) {
            $conn = Db::getConnection();
            // Checks if there is a user with the email in the session variable exists and if it's token matches the one in the session variable
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id AND login_token = :token");
            $stmt->bindParam(':id', $_SESSION['email']);
            $stmt->bindParam(':token', $_SESSION['login_token']);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                //if login is valld, return true
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
    
    public function isAdmin($email){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindValue(":email", $email);
        $query->execute();
        $user = $query->fetch();
        
        if ($user['role'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
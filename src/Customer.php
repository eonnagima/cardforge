<?php

namespace Codinari\Cardforge;

//enable class Db.php to be used in this file with composer
use Codinari\Cardforge\Db;
use PDOException;

class Customer extends User{
    
    public function save(){
        if($this->userExists($this->getEmail())){
            throw new \Exception("User with this email already exists");
        }

        $hash = password_hash($this->password, PASSWORD_DEFAULT);

        $conn = Db::getConnection();
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $hash);
        try{
            return $stmt->execute();
        }catch(\PDOException $e){
            throw new \Exception("Error: ".$e->getMessage());
        }
        
    }

    public function loginRedirect(){
        header("Location: index.php");
        exit();
    }
}


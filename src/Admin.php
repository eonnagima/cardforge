<?php

namespace Codinari\Cardforge;

//enable class Db.php to be used in this file with composer
use Codinari\Cardforge\Db;

class Admin extends User{
    
    public function save(){
        $conn = Db::getConnection();
        $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, 1)");
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        
        return $stmt->execute();
    }

    public function checkAdmin($email){
        $conn = Db::getConnection();
        $query = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindValue(":email", $email);
        $query->execute();
        $user = $query->fetch();
        if($user['role'] === 1){
            return true;
        }else {
            return false;
        }
    }
}
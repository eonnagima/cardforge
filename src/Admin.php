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

    public function loginRedirect(){
        header("Location: index.php");
        exit();
    }
}
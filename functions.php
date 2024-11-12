<?php

include_once(__DIR__."/classes/Db.php");
include_once(__DIR__."/classes/User.php");

function checkAdmin($email){
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
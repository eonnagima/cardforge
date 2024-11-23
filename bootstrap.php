<?php

require_once __DIR__."/vendor/autoload.php";

session_start();

// Set error reporting level
error_reporting(E_ALL);
ini_set('display_errors', 1);

//use user classes
use Codinari\Cardforge\User;
use Codinari\Cardforge\Admin;
use Codinari\Cardforge\Customer;

//checks if user is logged in and creates user object if they are
$user;
$email = htmlspecialchars($_SESSION['email'] ?? "");

if(User::validateLogin()){
    if(User::isAdmin($email)){
        $user = new Admin();
        $user->setRole("admin");
    }else{
        $user = new Customer();
        $user->setRole("customer");
    }
    $userData = User::getByEmail($email);
    
    $user->setId($userData['id']);
    $user->setEmail($email);
    $user->setPassword($userData['password']);
    $user->setWallet($userData['wallet']);
    $user->setFirst_name($userData['first_name']);
    $user->setLast_name($userData['last_name']);
    $user->setAvatar($userData['avatar']);
    $user->setDate_of_birth($userData['date_of_birth']);
    $user->setPhone_number($userData['phone_number']);
    $user->setAdress_street($userData['adress_street']);
    $user->setAdress_number($userData['adress_number']);
    $user->setAdress_extra($userData['adress_extra']);
    $user->setAdress_zip($userData['adress_zip']);
    $user->setAdress_country($userData['adress_country']);
}
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
       $user->setEmail($email);
       $user->setRole("admin");
   }else{
       $user = new Customer();
       $user->setEmail($email);
       $user->setRole("customer");
   }
}
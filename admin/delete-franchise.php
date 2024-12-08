<?php
    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Franchise;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $franchise = $_GET['id'];

    if(!empty($franchise)){
        Franchise::delete($franchise);
        header("Location: ./manage-franchises.php");
    }

?>
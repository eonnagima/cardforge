<?php
    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Franchise;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $franchise = $_GET['id'];

    if(!empty($franchise)){
        $result = Franchise::delete($franchise);
        if(!$result){
            header("Location: ./manage-franchises.php?error=".urlencode("Error deleting franchise"));
            exit();
        }else{
            header("Location: ./manage-franchises.php?success=".urlencode("Franchise deleted successfully"));
            exit();
        }
    }
?>
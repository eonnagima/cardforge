<?php
    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Product;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $product = $_GET['id'];

    if(!empty($product)){
        $result = Product::delete($product);
        if(!$result){
            header("Location: ./manage-products.php?error=".urlencode("Error deleting product"));
            exit();
        }else{
            header("Location: ./manage-products.php?success=".urlencode("Product deleted successfully"));
            exit();
        }
    }
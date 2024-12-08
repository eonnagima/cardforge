<?php
    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\ProductImage;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $productImage = $_GET['id'];
    $product = $_GET['product'];

    if(!empty($productImage)){
        $result = ProductImage::delete($productImage);
        if(!$result){
            header("Location: ./manage-products.php?id=".$product."?error=".urlencode("Error deleting product image"));
            exit();
        }else{
            header("Location: ./manage-products.php?id=".$product."?success=".urlencode("Product image deleted successfully"));
            exit();
        }
    }
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
        $result = ProductImage::updatePrimary($product, $productImage);
        if(!$result){
            header("Location: ./edit-product.php?id=".$product."&error=".urlencode("Error updating primary image"));
            exit();
        }else{
            header("Location: ./edit-product.php?id=".$product."&success=".urlencode("Primary image updated successfully"));
            exit();
        }
    }else{
        header("Location: ./edit-product.php?id=".$product."&error=".urlencode("Error updating primary image"));
        exit();
    }

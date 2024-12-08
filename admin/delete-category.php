<?php
    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Category;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $category = $_GET['id'];

    if(!empty($category)){
        $result = Category::delete($category);
        if(!$result){
            header("Location: ./manage-categories.php?error=".urlencode("Error deleting category"));
            exit();
        }else{
            header("Location: ./manage-categories.php?success=".urlencode("Category deleted successfully"));
            exit();
        }
    }
?>
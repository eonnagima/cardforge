<?php
    require_once __DIR__."/../bootstrap.php";

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Cardforge</title>
    <?php include_once __DIR__."/../includes/adminstylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/../includes/adminheader.inc.php";?>
    <main>
        <h1>Admin Dashboard</h1>
        <h2>Add Content</h2>
        <a href="./add-product.php" class="btn">Add New Product</a>
        <a href="./add-franchise.php" class="btn">Add New Franchise</a>
        <a href="./add-category.php" class="btn">Add New Category</a>
        <a href="./add-banner.php" class="btn">Add New Banner</a>
        <div class="seperator"></div>
        <h2>Manage Content</h2>
        <a href="./manage-products.php" class="btn">Manage Products</a>
        <a href="./manage-franchises.php" class="btn">Manage Franchises</a>
        <a href="./manage-categories.php" class="btn">Manage Categories</a>
        <!-- <a href="./manage-banners.php" class="btn">Manage Banners</a> -->
    </main>
</body>
</html>
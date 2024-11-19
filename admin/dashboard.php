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
        <a href="./add-product.php" class="btn">Add New Product</a>
    </main>
</body>
</html>
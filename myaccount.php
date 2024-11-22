<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\User;

    if(empty($user)){
        header("Location: login.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <main>
        <h1>My Account</h1>
        <section class="myaccount-section">
            <h2>Account info</h2>
            <div>
                <h3>Email</h3>
                <span><?=$user->getEmail()?></span>
            </div>
            <div>
                <h3>Password</h3>
                <span>*******</span>
            </div>
            <div>
                <h3>Avatar</h3>
                <img src=".<?=$user->getAvatar()?>" class="avatar-img">
            </div>
            <a href="accountinfo.php" class="btn">EDIT</a>
        </section>
        <div class="seperator"></div>
        <section class="myaccount-section">
            <h2>Personal info</h2>
            <div>
                <h3>First Name</h3>
                <span><?=$user->getFirst_name()?></span>
            </div>
            <div>
                <h3>Last Name</h3>
                <span><?=$user->getLast_name()?></span>
            </div>
            <div>
                <h3>Date of Birth</h3>
                <span><?=$user->getDate_of_birth()?></span>
            </div>
            <div>
                <h3>Phone Number</h3>
                <span><?=$user->getPhone_number()?></span>
            </div>
            <a href="personalinfo.php" class="btn">EDIT</a>
        </section>
        <div class="seperator"></div>
        <section class="myaccount-section">
            <h2>Adress info</h2>
            <div>
                <h3>Street</h3>
                <span><?=$user->getAdress_street()?></span>
            </div>
            <div>
                <h3>House Number</h3>
                <span><?=$user->getAdress_number()?></span>
            </div>
            <div>
                <h3>Adress Extra</h3>
                <span><?=$user->getAdress_extra()?></span>
            </div>
            <div>
                <h3>Zip code</h3>
                <span><?=$user->getAdress_zip()?></span>
            </div>
            <div>
                <h3>Country</h3>
                <span><?=$user->getAdress_country()?></span>
            </div>
            <a href="adressinfo.php" class="btn">EDIT</a>
        </section>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
</body>
</html>
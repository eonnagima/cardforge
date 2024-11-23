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
    <title>Account Settings</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <main>
        <h1>Account Settings</h1>
        <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
        <?php endif;?>
        <form class="form" action="" method="post">
            <section>
                <div class="input-wrap">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required value="<?=$user->getEmail()?>">
                </div>
                <div class="input-wrap password-toggle">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required value="">
                    <i id="toggle-icon" class="fas fa-eye toggle-icon" onclick="togglePasswordVisibility()"></i>
                </div>
                <div class="input-wrap">
                    <span class="label" for="avatar">Avatar</span>
                    <input type="email" id="email" name="email" required value="<?=$user->getEmail()?>">
                </div>
            </section>
            <div class="seperator"></div>
            <section>
                <input class="btn" type="submit" value="save changes">
                <a class="btn btn--secondary" href="myaccount.php">Back to My Account</a>
            </section>      
        </form>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
</body>
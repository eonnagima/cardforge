<?php

    require_once __DIR__."/bootstrap.php";

    if(!empty($_POST)){
        // $email = $_POST['email'];
        // $password = $_POST['password'];

        // if(verifyLogin($email, $password)){
        //     session_start();
        //     $_SESSION['user'] = $email;
        //     $_SESSION['loggedIn'] = true;
        //     header("Location: index.php");
        // }else{
        //     $error = true;
        // };

        // create 


        // User::isAdmin()
        //     Product::create(

        
        //     )
        //cloudinary image upload
        // $cloudinary = new Cloudinary();
        // $cloudinary->uploadImage($_FILES['image']);

        // $product = new Product();

    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cardforge</title>
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include_once(__DIR__."/includes/header.inc.php");?>
    <main>
        <h1>Login</h1>
        <?php if(isset($error)):?>
            <div class="error">Invalid email or password</div>
        <?php endif;?>
        <form class="form" action="" method="post">
            <section>
                <div class="input-wrap">
                    <label for="email">Email:<span>*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-wrap password-toggle">
                    <label for="password">Password:<span>*</span></label>
                    <input type="password" id="password" name="password" required>
                    <i id="toggle-icon" class="fas fa-eye toggle-icon" onclick="togglePasswordVisibility()"></i>
                </div>
            </section>
            <div class="seperator"></div>
            <section>
                <input class="btn" type="submit" value="LOGIN">
                <span>Don't have an account yet? <a href="signup.php">Signup here.</a></span>
            </section>      
        </form>
    </main>
    <script src="./js/script.js"></script>
</body>
</html>
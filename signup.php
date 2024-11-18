<?php
    require_once __DIR__."/bootstrap.php";

    //add trycatch
    if(!empty($_POST)){
        try{
            $user = new Codinari\Cardforge\Customer();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $result = $user->save();
    
            if($result){
                session_start();
                $_SESSION['user'] = $user->getEmail();
                $_SESSION['loggedIn'] = true;
                header("Location: index.php");
            }
        }catch(\Throwable $th){
            $error = $th->getMessage();
        }

    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | Cardforge</title>
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include_once(__DIR__."/includes/header.inc.php");?>
    <main>
        <h1>Signup</h1>
        <?php if(isset($error)):?>
            <div class="error"><?php echo $feedback;?></div>
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
                <input class="btn" type="submit" value="SIGNUP">
                <span>Already have an account? <a href="login.php">Login here.</a></span>
            </section>      
        </form>
    </main>
    <script src="./js/script.js"></script>
</body>
</html>
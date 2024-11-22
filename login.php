<?php
    require_once __DIR__."/bootstrap.php";

    if(!empty($_POST)){
        try{
            $user = new Codinari\Cardforge\User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);

            $user->login();

            if($user->isAdmin($user->getEmail())){
                //redirect to admin page
                header("Location: ./admin/dashboard.php");
                exit();
            }else{
                //redirect to user page
                header("Location: index.php");
                exit();
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
    <title>Login | Cardforge</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once(__DIR__."/includes/header.inc.php");?>
    <main>
        <h1>Login</h1>
        <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
        <?php endif;?>
        <form class="form" action="" method="post">
            <section>
                <div class="input-wrap">
                    <label for="email">Email<span>*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-wrap password-toggle">
                    <label for="password">Password<span>*</span></label>
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
    <?php include_once __DIR__."/includes/footer.inc.php";?>
    <script src="./js/footer.js"></script>
    <script src="./js/pwToggle.js"></script>
</body>
</html>
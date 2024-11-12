<?php
    include_once(__DIR__."/classes/Db.php");
    include_once(__DIR__."/classes/Users.php");

    $feedback = "";

    if(!empty($_POST)){
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $result = $user->save();

        if($result){
            $feedback = "User was created successfully!";
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
    <style>
        .password-toggle {
            position: relative;
        }
        .password-toggle input[type="password"] {
            padding-right: 30px;
        }
        .password-toggle .toggle-icon {
            position: absolute;
            bottom: 20px;
            transform: translateY(+50%);
            right: 10px;
            cursor: pointer;
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var toggleIcon = document.getElementById("toggle-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</head>
<body>
    <?php include_once(__DIR__."/includes/header.inc.php");?>
    <main>
        <h1>Signup</h1>
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
</body>
</html>
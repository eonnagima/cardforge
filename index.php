<?php
    require_once __DIR__."/bootstrap.php";

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Cardforge</title>
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .banner-wrap {
            position: relative;
            background-color: #f2f2f2;
        }

        .progress-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: red;
            padding: 16px;
        }

        .progress-bar .orb {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 5px;
            cursor: pointer;
        }

        .progress-bar .orb.active {
            background-color: #333;
        }

        .slideshow-container {
            height: 300px;
            min-width: 100%;
            display: inline-block;
            overflow: hidden;
        }

        .slideshow-container .slide {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 300px;
            width: 100vw;
            position: relative;
            background-color: blue;
            transition: 0.5s;
        }

        .slideshow-container {
            height: 300px;
            min-width: 100%;
            display: flex; /* Change display to flex */
            overflow: hidden;
        }

        .slideshow-container .slide {
            flex: 0 0 100%; /* Set each slide to occupy full width */
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 300px;
            position: relative;
            background-color: blue;
            transition: 0.5s;
            display: none;
        }

        .slideshow-container .slide.active {
            opacity: 1;
            display: block;
        }

        .slide-logo{
            position: absolute;
            bottom: 16px;
            left: 50%;
            transform: translateX(-50%);
            width: 250px;
        }
    </style>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <section class="banner-wrap">
        <div class="slideshow-container">
            <div class="slide" style="background-image: url('./assets/img/banner/sv08-banner.png');">
                <img src="assets/img/banner/sv08-banner-logo.png" alt="Pokémon Scarlet & Violet Surging Sparks" class="slide-logo">
            </div>
            <div class="slide active" style="background-image: url('assets/img/banner/mtg-foundations-banner.webp');">
                <img src="assets/img/banner/mtg-foundations-banner-logo.png" alt="Magic: The Gathering Foundations" class="slide-logo">
            </div>
            <div class="slide" style="background-image: url('./assets/img/banner/sv08-banner.png');">
                <img src="assets/img/banner/sv08-banner-logo.png" alt="Pokémon Scarlet & Violet Surging Sparks" class="slide-logo">
            </div>
        </div>
        <div class="progress-bar">
            <div class="orb active"></div>
            <div class="orb active"></div>
            <div class="orb"></div>
        </div>
    </section>
    <main>
        <?php if(!empty($user)): ?>
            <h1>Welcome, <?php echo $user->getEmail(); ?></h1>
            <p>You are logged in as a <?php echo $user->getRole(); ?></p>
        <?php endif; ?>
    </main>
    
<!-- Add the HTML structure for the footer -->
<footer>
    <section id="contact">
        <div>
            <h4>Account</h4>
            <i class="fas fa-caret-up fa-2x"></i>
        </div>
        <ul>
            <?php if(!empty($user)): ?>
                <li><a href="account.php">My account</a></li>
                <li><a href="logout.php">Logout</a></li>
                <?php if($user->getRole() == "admin"): ?>
                    <li><a href="./admin/dashboard.php">Admin Dashboard</a></li>
                <?php endif; ?>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            <?php endif; ?>
        </ul>
    </section>
</footer>

    <script>
        // const orbs = document.querySelectorAll('.orb');
        // const slides = document.querySelectorAll('.slide');

        // orbs.forEach((orb, index) => {
        //     orb.addEventListener('click', () => {
        //         setActiveOrb(index);
        //     });
        // });

        // function setActiveOrb(index) {
        //     orbs.forEach((orb, i) => {
        //         if (i === index) {
        //             orb.classList.add('active');
        //             slides[i].classList.add('active');
        //         } else {
        //             orb.classList.remove('active');
        //             slides[i].classList.remove('active');
        //         }
        //     });
        // }
    </script>
</body>
</html>
<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Franchise;

    $allFranchises = Franchise::getAll();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Cardforge</title>
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        <h1>Home</h1>
        <h2>New Arrivals</h2>
        <section class="product-list">
            <a class="product-listing">
                <img src="./assets/img/products/placeholder.png" alt="Product 1">
                <h5>Product 1</h5>
                <span>$10.00</span>
            </a>
            <a class="product-listing">
                <img src="./assets/img/products/placeholder.png" alt="Product 1">
                <h5>Product 1</h5>
                <span>$10.00</span>
            </a>
            <a class="product-listing">
                <img src="./assets/img/products/placeholder.png" alt="Product 1">
                <h5>Product 1</h5>
                <span>$10.00</span>
            </a>
            <a class="product-listing">
                <img src="./assets/img/products/placeholder.png" alt="Product 1">
                <h5>Product 1</h5>
                <span>$10.00</span>
            </a>
        </section>
        <h2>Cardgames</h2>
        <section class="franchises">
            <?php foreach($allFranchises as $franchise): ?>
                <a href="products.php?f=<?=htmlspecialchars($franchise['alias'])?>">
                    <img src=".<?=$franchise['img']?>" alt="<?=htmlspecialchars($franchise['name'])?>">
                </a>
            <?php endforeach;?>
            <a href="products.php?f=pokemon">
                <img src="./assets/img/franchises/placeholder.png" alt="placeholderimg">
            </a>
        </section>
    </main>
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
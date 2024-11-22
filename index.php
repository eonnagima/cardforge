<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Product;

    $allFranchises = Franchise::getAll();
    $newArrivals = Product::getNewArrivals();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Cardforge</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <section class="bannerGallery">
        <div class="slideshow-container slideshow-container--banner" data-autoplay="true">
            <a href="#" class="prev">&#10094;</a>
            <div class="slider-wrap">
                <div class="slider">
                    <div class="slide">
                        <img class="slide-img" src="./assets/img/banner/sv08-banner.png" alt="Image 1">
                        <img src="assets/img/banner/sv08-banner-logo.png" alt="Pokémon Scarlet & Violet Surging Sparks" class="slide-logo"> 
                    </div>
                    <div class="slide">
                        <img class="slide-img" src="./assets/img/banner/mtg-foundations-banner.webp" alt="Image 2">
                        <img src="assets/img/banner/mtg-foundations-banner-logo.png" alt="Magic: The Gathering Foundations" class="slide-logo"> 
                    </div>
                    <div class="slide">
                        <img class="slide-img" src="./assets/img/banner/sv08-banner.png" alt="Image 3">
                        <img src="assets/img/banner/sv08-banner-logo.png" alt="Pokémon Scarlet & Violet Surging Sparks" class="slide-logo"> 
                    </div>
                </div>  
            </div>
            <a href="#" class="next">&#10095;</a>
        </div>
        <div class="dots-container">
            <span class="dot active" data-index="0"></span>
            <span class="dot" data-index="1"></span>
            <span class="dot" data-index="2"></span>
        </div>
    </section>
    <main>
        <h1>Home</h1>
        <h2>New Arrivals</h2>
        <section class="product-list">
            <?php foreach($newArrivals as $product): ?>
                <a class="product-listing" href="product.php?p=<?=htmlspecialchars($product['alias'])?>">
                    <img src=".<?=$product['img']?>" alt="<?=htmlspecialchars($product['name'])?>">
                    <h5><?=htmlspecialchars($product['name'])?></h5>
                    <span>$<?=htmlspecialchars($product['price'])?></span>
                </a>
            <?php endforeach;?>
            <!-- product listing template -->
            <!-- <a class="product-listing">
                <img src="./assets/img/products/placeholder.png" alt="Product 1">
                <h5>Product 1</h5>
                <span>$10.00</span>
            </a> -->
        </section>
        <h2>Cardgames</h2>
        <section class="franchises">
            <?php foreach($allFranchises as $franchise): ?>
                <a href="store.php?f=<?=htmlspecialchars($franchise['alias'])?>">
                    <img src=".<?= $franchise['img']?>" alt="<?=htmlspecialchars($franchise['name'])?>">
                </a>
            <?php endforeach;?>
            <a href="products.php?f=pokemon">
                <img src="./assets/img/franchises/placeholder.png" alt="placeholderimg">
            </a>
        </section>
    </main>
    <footer>
        <section>
            <div>
                <h4>Get in touch</h4>
                <a class="fas fa-caret-down fa-2x"></a>
            </div>
            <ul class="hidden"
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Return product</a></li>
                <li><a href="https://maps.app.goo.gl/FqBkrARLpRUCpY6N9" target="_blank">Raghenoplein 21 bis<br>2800 Mechelen België</a></li>
            </ul>
        </section>
        <section>
            <div>
                <h4>Our store</h4>
                <a class="fas fa-caret-down fa-2x"></a>
            </div>
            <ul class="hidden">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About us</a></li>
                <li><a href="store.php?f=everything">Shop all</a></li>
                <?php foreach($allFranchises as $franchise): ?>
                    <li><a href="store.php?f=<?=htmlspecialchars($franchise['alias'])?>">Shop <?=htmlspecialchars($franchise['alias'])?></a></li>
                <?php endforeach;?>
            </ul>
        </section>
        <section>
            <div>
                <h4>Legal</h4>
                <a class="fas fa-caret-down fa-2x"></a>
            </div>
            <ul class="hidden">
                <li><a href="legal/terms.php">Terms & Conditions</a></li>
                <li><a href="legal/privacy.php">Privacy policy</a></li>
                <li><a href="legal/cookies.php">Cookies</a></li>
                <li><a href="legal/shipping.php">Shipping policy</a></li>
                <li><a href="legal/return.php">Return policy</a></li>
            </ul>
        </section>
        <section>
            <div>
                <h4>Follow us</h4>
                <a class="fas fa-caret-down fa-2x"></a>
            </div>
            <ul class="hidden">
                <li><a href="https://www.facebook.com/" target="_blank">Facebook</a></li>
                <li><a href="https://www.instagram.com/" target="_blank">Instagram</a></li>
                <li><a href="https://bsky.app/" target="_blank">Bluesky</a></li>
                <li><a href="https://www.twitter.com/" target="_blank">X</a></li>
            </ul>
        </section>
        <section>
            <div>
                <h4>Account</h4>
                <a class="fas fa-caret-down fa-2x"></a>
            </div>
            <ul class="hidden">
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
    <script src="./js/slider.js"></script>
    <script ></script>
</body>
</html>
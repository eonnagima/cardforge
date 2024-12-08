<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;
    use Codinari\Cardforge\Banner;

    $allFranchises = Franchise::getAllExceptEverything();
    $newArrivals = Product::getNewArrivals();
    $activeBanners = Banner::getAllActive();

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
                    <?php foreach($activeBanners as $banner):?>
                        <div class="slide">
                            <img class="slide-img" src="<?=$banner['img']?>" alt="<?=$banner['image_alt']?>">
                            <img class="slide-logo" src="<?=$banner['logo']?>" alt="<?=$banner['logo_alt']?>"> 
                        </div>
                    <?php endforeach;?>
                </div>  
            </div>
            <a href="#" class="next">&#10095;</a>
        </div>
        <div class="dots-container">
            <?php foreach($activeBanners as $key=>$banner):?>
                <span class="dot" data-index="<?=$key?>"></span>
            <?php endforeach;?>
        </div>
    </section>
    <main>
        <h1>Home</h1>
        <h2>New Arrivals</h2>
        <section class="product-list">
            <?php foreach($newArrivals as $product): ?>
                <a class="product-listing" href="product.php?p=<?=htmlspecialchars($product['alias'])?>">
                    <img src="<?=ProductImage::getPrimaryByProduct($product['alias'])['url']?>" alt="<?=htmlspecialchars($product['name'])?>">
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
            <a href="store.php">
                <img src="https://res.cloudinary.com/codinari/image/upload/v1733609745/best-trading-card-games-2024_lb6jll.webp" alt="All Products" class="all-franchises-img">
                <h3>All Products</h3>
            </a>
            <?php foreach($allFranchises as $franchise): ?>
                <a href="store.php?f=<?=htmlspecialchars($franchise['alias'])?>">
                    <img src="<?=$franchise['img']?>" alt="<?=htmlspecialchars($franchise['name'])?>">
                </a>
            <?php endforeach;?>
            <!-- <a href="products.php?f=pokemon">
                <img src="./assets/img/franchises/placeholder.png" alt="placeholderimg">
            </a> -->
        </section>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
    <script src="./js/slider.js"></script>
</body>
</html>
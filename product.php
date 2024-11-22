<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Product;

    // $product = $_GET["p"] ?? null;
    // $product = Product::getByAlias($product);
    // $franchise = Franchise::getById($product['franchise_id']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?="Product"?>| Cardforge</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <main>
        <section class="product-header">
            <nav class="product-nav">
                <a href="index.php">Home</a>
                <span>/</span> 
                <a href="store.php?f=Pokemon">Pokémon Trading Card Game</a>
                <span>/</span> 
                <a class="current" href="store.php?c=Booster-Packs">Booster Packs</a>
                <!-- <span>/</span>
                <a href="store.php?f=<?= $franchise['alias']?>"><?= $franchise['name']?></a>
                <span>/</span>
                <a class="current" href="store.php?c=<?= $category['alias']?>"><?= $category['name']?></a> -->
            </nav>
            <section class="productGallery">
                <div class="slideshow-container" data-autoplay="false">
                    <a href="#" class="prev">&#10094;</a>
                    <div class="slider-wrap">
                        <div class="slider">
                            <div class="slide"><img class="slide-img" src="https://images.unsplash.com/photo-1725120344808-420e96dd8fdf?q=80&w=2026&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 1"></div>
                            <div class="slide"><img class="slide-img" src="https://images.unsplash.com/photo-1724931282671-2d3bcd6de8f2?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 2"></div>
                            <div class="slide"><img class="slide-img" src="https://images.unsplash.com/photo-1724875299388-7257f4af1cf9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 3"></div>
                            <div class="slide"><img class="slide-img" src="https://images.unsplash.com/photo-1724770646663-2a806ed04ca4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 4"></div>
                            <div class="slide"><img class="slide-img" src="https://images.unsplash.com/photo-1723675510074-6e9f59fd3af0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 5"></div>
                            <div class="slide"><img class="slide-img" src="https://images.unsplash.com/photo-1724690416953-c787bc34b56f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 6"></div>
                        </div>  
                    </div>
                    <a href="#" class="next">&#10095;</a>
                </div>
                <div class="dots-container">
                    <span class="dot active" data-index="0"></span>
                    <span class="dot" data-index="1"></span>
                    <span class="dot" data-index="2"></span>
                    <span class="dot" data-index="3"></span>
                    <span class="dot" data-index="4"></span>
                    <span class="dot" data-index="5"></span>
                </div>
            </section>
            <div class="price-like-wrap">
                <span class="price">€164.64</span>
                <!-- font awesome heart no fill -->
                <a href="#" class="like far fa-heart"></a>
            </div>
            <h1>Pokémon TCG: Scarlet & Violet-Twilight Masquerade Booster Display Box (36 Packs)</h1>
            <section class="reviews">
                <div class="rating">
                    <!-- font awesome rounded stars *5 -->
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span> 
                    <span class="fa fa-star"></span> 
                    <span class="fa fa-star"></span> 
                    <!-- font awesome star without fill -->
                    <span class="far fa-star"></span>
                </div>
                <span class="num-reviews">10 Reviews</span>
            </section>
        </section>
        <div class="seperator"></div>
        <section class="product-section">
            <h3>Description</h3>
            <p>
                The Pokémon TCG: Scarlet & Violet—Twilight Masquerade expansion is filled with cards that tie into the story of the Pokémon TCG: Sword & Shield—Brilliant Stars expansion. The expansion features over 260 cards, including 5 Pokémon V and 2 Pokémon VMAX, as well as 16 full-art cards. The expansion also introduces a new type of card called the Pokémon VSTAR, which evolves from Pokémon V and Pokémon VMAX. The Pokémon TCG: Scarlet & Violet—Twilight Masquerade expansion will be available in booster packs, Elite Trainer Boxes, and special collections.
            </p>
        </section>
        <div class="seperator"></div>
        <section class="product-section">
            <h3>Reviews</h3>
            <div class="seperator"></div>
            <section class="review">
                <section class="header">
                    <div class="rating">
                        <!-- font awesome rounded stars *5 -->
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span> 
                        <span class="fa fa-star"></span> 
                        <span class="fa fa-star"></span> 
                        <!-- font awesome star without fill -->
                        <span class="far fa-star"></span>
                    </div>
                    <span class="reviewer">Anonymous</span>
                </section>
                <section class="info">
                    <span class="date">16 oct 2024</span>
                    <span class="verified">| Verified Purchase</span>
                </section>
                <p>
                    Fast Delivery, everything is in great condition! Would buy from again!
                </p>
            </section>
        </section>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
    <script src="./js/footer.js"></script>
    <script src="./js/slider.js"></script>
</body>
</html>
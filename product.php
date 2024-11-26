<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\Category;
    use Codinari\Cardforge\ProductImage;
    use Codinari\Cardforge\Review;

    $product = $_GET["p"] ?? null;
    $product = Product::getByAlias($product);
    
    $franchise = Franchise::getById($product['franchise_id']);
    $category = Category::getById($product['category_id']);
    
    if(!empty($product['set_name'])){
        $set = $product['set_name'];
    }

    $primaryImage = ProductImage::getPrimaryByProduct($product['alias']);
    $images = ProductImage::getOtherImagesByProduct($product['alias']);

    $imageCount = count($images) +1;

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$product['name']?> | Cardforge</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <main>
        <section class="product-header">
            <nav class="product-nav">
                <a href="index.php">Home</a>
                <span>/</span> 
                <a href="store.php?f=<?=$franchise['alias']?>"><?=$franchise['name']?></a>
                <span>/</span> 
                <?php if(!empty($set)):?>
                    <a href="store.php?c=<?=$category['alias']?>"><?=$category['name']?></a>
                    <span>/</span> 
                    <a class="current" class="current" href="store.php?c=<?=$category['alias']?>&s=<?=$set?>"><?=$set?></a>
                <?php else:?>
                    <a class="current" href="store.php?c=<?=$category['alias']?>"><?=$category['name']?></>
                <?php endif;?>
            </nav>
            <section class="productGallery">
                <div class="slideshow-container" data-autoplay="false">
                    <a href="#" class="prev">&#10094;</a>
                    <div class="slider-wrap">
                        <div class="slider">
                            <?=ProductImage::drawImage($primaryImage['url'], $primaryImage['alt'])?>
                            <?php foreach($images as $image):?>
                                <div class="slide"><img class="slide-img" src="<?=$image['url']?>" alt="<?=$image['alt']?>"></div>
                            <?php endforeach;?>
                        </div>  
                    </div>
                    <a href="#" class="next">&#10095;</a>
                </div>
                <div class="dots-container">
                    <?php if($imageCount > 1):?>
                        <span class="dot active" data-index="0"></span>
                        <?php for($i = 1; $i < $imageCount; $i++):?>
                            <span class="dot" data-index="<?=$i?>"></span>
                        <?php endfor;?>
                    <?php endif;?>
                </div>
            </section>
            <div class="price-like-wrap">
                <span class="price"><?=$product['price']?></span>
                <!-- font awesome heart no fill -->
                <a href="#" class="like far fa-heart" id="wishlist-btn"></a>
            </div>
            <h1><?=$product['name']?></h1>
            <section class="reviews">
                <div class="rating">
                    <?= Review::drawRating(Review::averageScore($product['alias']))?>
                </div>
                <span class="num-reviews"><?=Review::countReviews($product['alias'])?> Reviews</span>
            </section>
            <a href="#" class="btn btn--cart" id="add-to-cart" data-product-alias="<?=$product['alias']?>">Add to Cart</a>
            <div id="go-to-cart" class="hidden">
                <span>Product was added to your cart</span>
                <a href="./cart.php" class="btn btn--secondary" data-product-alias="<?=$product['alias']?>">Go to Cart</a>
            </div>
         
        </section>
        <div class="seperator"></div>
        <section class="product-section">
            <h3>Description</h3>
            <p><?=$product['description']?></p>
        </section>
        <?php if(!empty($product['details'])):?>
            <section class="product-section">
                <h3>Details</h3>
                <p><?=$product['details']?></p>
            </section>
        <?php endif;?>
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
    <script src="./js/slider.js"></script>
    <script>
        document.querySelector("#add-to-cart").addEventListener('click', function(e) {
            e.preventDefault();
            console.log('clicked');

            // Retrieve the product alias from the button's dataset
            var productAlias = this.dataset.productAlias;
            
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            
            // Configure the AJAX request
            xhr.open('POST', 'ajax/add_to_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            
            // Define a function to handle the server response
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            // Parse the JSON response from the server
                            var response = JSON.parse(xhr.responseText);
                            // Update the cart count in the header
                            document.getElementById('cart-count').innerText = response.cartCount;
                            // Log debugging information
                            console.log('Debug info:', response.debug);
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            console.error('Response text:', xhr.responseText);
                        }
                    } else {
                        console.error('Request failed with status:', xhr.status);
                        console.error('Response text:', xhr.responseText);
                    }
                }
            };
            
            // Send the AJAX request with the product alias in JSON format
            xhr.send(JSON.stringify({ product_alias: productAlias }));

            document.querySelector("#go-to-cart").classList.toggle('hidden');
            document.querySelector("#add-to-cart").classList.toggle('hidden');
        });
    </script>
</body>
</html> 
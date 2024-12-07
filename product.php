<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\Category;
    use Codinari\Cardforge\ProductImage;
    use Codinari\Cardforge\Review;
    use Codinari\Cardforge\OrderProduct;
    use Codinari\Cardforge\User;

    $product = $_GET["p"] ?? null;

    if(empty($product)){
        header("Location: index.php");
        exit();
    }

    $product = Product::getByAlias($product);
    
    $franchise = Franchise::getById($product['franchise_id']);
    $category = Category::getById($product['category_id']);
    
    if(!empty($product['set_name'])){
        $set = $product['set_name'];
    }

    $primaryImage = ProductImage::getPrimaryByProduct($product['alias']);
    $images = ProductImage::getOtherImagesByProduct($product['alias']);

    $imageCount = count($images) +1;

    $hasOrdered = false;

    if($user){
        if(OrderProduct::hasOrdered($user->getEmail(), $product['alias'])){
            $hasOrdered = true;
        }
    }

    if($user->getFirst_name()){
        $userFirstName = $user->getFirst_name();
    }else{
        $userFirstName = "Anonymous";
    }

    $allReviews = Review::getAllReviewsByProduct($product['alias']);

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
                <a class="current" href="store.php?c=<?=$category['alias']?>"><?=$category['name']?></>
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
                <span class="price">€<?=number_format(floatval($product['price']), 2)?></span>
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
        <section class="product-section" id="review-section">
            <h3>Reviews</h3>
            <?php if($hasOrdered):?>
                <a href="#" class="btn" id="write-review">Write Review</a>
                <section class="review-input hidden">
                    <label for="rating">Rating:</label>
                    <select name="rating" id="rating">
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                    <label for="review-txt">Review:</label>
                    <textarea name="review-txt" id="review-txt" cols="30" rows="10"></textarea>
                    <div class="checkbox-wrap">
                        <input type="checkbox" name="anonymous" id="anonymous">
                        <label for="verified">Post as Anonymous?</label>
                    </div>
                    <a href="#" class="btn" id="post-review" data-product="<?=$product['alias']?>" data-user="<?=$userFirstName?>" data-email="<?=$user->getEmail()?>">Post Review</a>
                </section>
            <?php endif;?>
            <?php foreach($allReviews as $review):?>
                <?php
                    $dateString = $review['created'];
                    $date = new DateTime($dateString);
                    $formattedDate = $date->format('d M Y');

                    if($review['anonymous'] == 0){
                        $reviewer = User::getById($review['user_id']);
                        $reviewer = $reviewer['first_name'];
                    }
                ?>
                <div class="seperator"></div>

                <section class="review">
                    <section class="header">
                        <div class="rating">
                            <?= Review::drawRating(intval($review['rating']))?>
                        </div>
                        <span class="reviewer"><?=$reviewer?></span>
                    </section>
                    <section class="info">
                        <span class="date">$formattedDate</span>
                        <span class="verified">| Verified Purchase</span>
                    </section>
                    <p><?=$review['text']?></p>
                </section>
            <?php endforeach;?>
        </section>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
    <script src="./js/slider.js"></script>
    <script src="./js/addToCart.js"></script>
    <script src="./js/review.js"></script>
</body>
</html> 
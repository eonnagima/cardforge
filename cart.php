<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;

    $cart = $_SESSION['cart'] ?? [];

    $products = [];
    $total = 0;

    foreach($cart as $item){ 
        $product = Product::getByAlias($item);
        $total += $product['price'];
        $products[] = $product;
    }

    //echo count($_SESSION['cart']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Cardforge</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once(__DIR__."/includes/header.inc.php");?>
    <main>
        <h1>My Cart</h1>
        <section class="cart-items">
            <?php if(empty($products)):?>
                <p>Your cart is empty</p>
            <?php else:?>
                <?php foreach($products as $product):?>
                    <section class="cart-item">
                        <img src="<?=ProductImage::getPrimaryByProduct($product['alias'])['url']?>" alt="" class="cart-img">
                        <span class="product-name"><?=$product['name']?></span>
                        <span class="price">€<?=$product['price']?></span>
                        <a href="" class="btn btn--remove" data-product-alias="<?=$product['alias']?>">-</a>
                    </section>
                <?php endforeach;?>
            <?php endif;?>
            <!-- <section class="cart-item">
                <img src="https://www.pokemoncenter.com/images/DAMRoot/High/10000/P9584_705E12373_01.jpg" alt="" class="cart-img">
                <span class="product-name">Pokémon TCG: Ditto Quartet Playmat</span>
                <span class="price">€25</span>
                <a href="" class="btn btn--small">-</a>
            </section> -->
        </section>
        <div class="seperator"></div>
        <section class="cart-total">
            <h3>Total:</h3>
            <span class="price">€<?=$total?></span>
        </section>
        <div class="seperator"></div>
        <!-- checkout btn and back to store btn -->
        <a href="store.php" class="btn btn--secondary">Back to store</a>
        <a href="checkout.php" class="btn">Checkout</a>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
    <script src="./js/pwToggle.js"></script>
    <script>
        //bubble on click event over btn--remove in cart-items
        
        document.querySelectorAll('.btn--remove').forEach(btn => {
            btn.addEventListener('click', function(e){
                e.preventDefault();
                const productAlias = this.getAttribute('data-product-alias');
                fetch('./ajax/remove_from_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_alias: productAlias,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if(data.error){
                        alert(data.error);
                    } else {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>
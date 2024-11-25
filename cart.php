<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;

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
        <h1>My Cart</h1>
        <section class="cart-items">
            <section class="cart-item">
                <img src="https://www.pokemoncenter.com/images/DAMRoot/High/10000/P9584_705E12373_01.jpg" alt="" class="cart-img">
                <span class="product-name">Pokémon TCG: Ditto Quartet Playmat</span>
                <span class="price">€25</span>
                <a href="" class="btn btn--small">-</a>
            </section>
        </section>
        <div class="seperator"></div>
        <section class="cart-total">
            <h3>Total:</h3>
            <span class="price">€25</span>
        </section>
        <div class="seperator"></div>
        <!-- checkout btn and back to store btn -->
        <a href="store.php" class="btn btn--secondary">Back to store</a>
        <a href="checkout.php" class="btn">Checkout</a>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
    <script src="./js/pwToggle.js"></script>
</body>
</html>
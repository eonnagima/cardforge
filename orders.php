<?php
    require_once __DIR__."/bootstrap.php";

    if(empty($user)){
        header("Location: login.php");
    }

    use Codinari\Cardforge\Order;
    use Codinari\Cardforge\OrderProduct;
    use Codinari\Cardforge\ProductImage;
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <main>
        <h1>My Orders</h1>
        <section class="orders-wrap">
            <section class="order">
                <h3>Order — jvfodjpakpvdki</h3>
                <div class="order-details-wrap">
                    <section class="order-product">
                        <img src="https://via.placeholder.com/150" alt="product image" class="order-img">
                        <div>
                            <h4>Product Name</h4>
                            <p>Quantity: 1</p>
                            <p>Price: €10</p>
                        </div>
                    </section>
                    <section class="order-product--other">
                        <p>+4 other products</p>
                    </section>
                    <section class="order-info hidden">
                        <h4>Status: In progress</h4>
                        <p>Tracking: Not available yet</p>
                        <p>Order Date: 2020-12-12</p>
                    </section>
                </div>
                <a href="order.php?o=''" class="btn">See Order Details</a>
            </section>
        </section>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
</body>
</html>
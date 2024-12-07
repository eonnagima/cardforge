<?php
    require_once __DIR__."/bootstrap.php";

    if(empty($user)){
        header("Location: login.php");
    }

    use Codinari\Cardforge\Order;
    use Codinari\Cardforge\OrderProduct;
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;

    $allOrders = Order::getAllByUser($user->getEmail());


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
        <?php if(empty($allOrders)):?>
            <p>You have no orders yet</p>
        <?php else:?>
            <?php foreach($allOrders as $order):?>
                <?php
                    $orderProducts = OrderProduct::getAllByOrder($order['alias']);
                    $product = Product::getById($orderProducts[0]['product_id']);
                    $productImage = ProductImage::getPrimaryByProduct($product['alias']);
                    $quantity = $orderProducts[0]['quantity'];
                    $otherProducts = count($orderProducts) - 1;
                ?>

                <section class="orders-wrap">
                    <section class="order">
                        <h3>Order — <?=htmlspecialchars($order['alias'])?></h3>
                        <div class="order-details-wrap">
                            <section class="order-product">
                                <img src="<?=$productImage['url']?>" alt="<?=$productImage['alt']?>" class="order-img">
                                <div>
                                    <h4><?=htmlspecialchars($product['name'])?></h4>
                                    <p>Quantity: <?=$quantity?></p>
                                    <p>Price: €<?=floatval($quantity) * floatval($product['price'])?></p>
                                </div>
                            </section>
                            <section class="order-product--other">
                                <p>+<?=$otherProducts?> other products</p>
                            </section>
                            <section class="order-info hidden">
                                <h4>Status: <?=$order['status']?></h4>
                                <p>Tracking: Not available yet</p>
                                <p>Order Date: <?=$order['created']?></p>
                            </section>
                        </div>
                        <a href="order.php?o=<?=$order['alias']?>" class="btn">See Order Details</a>
                    </section>
                </section>
            <?php endforeach;?>
        <?php endif;?>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
</body>
</html>
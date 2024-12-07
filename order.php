<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;
    use Codinari\Cardforge\Order;
    use Codinari\Cardforge\OrderProduct;

    $order = $_GET['o'] ?? null;

    if(empty($order)){
        header("Location: index.php");
        exit();
    }

    $order = Order::getByAlias($order);
    $orderProducts = OrderProduct::getAllByOrder($order['alias']);
    $products = [];

    foreach($orderProducts as $orderProduct){
        $products[] = Product::getById($orderProduct['product_id']);
    }

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
        <h1>Order — <?=$order['alias']?></h1>
        <h3>Order Details</h3>
        <section class="order-details">
            <h4>Status: </h4><p><?=htmlspecialchars($order['status'])?></p>
            <h4>Order Date: </h4><p><?=$order['created']?></p>
            <h4>Shipping Address: </h4><p><?=htmlspecialchars($order['street']." ".$order['house_number']." ".$order['address_extra'].", ".$order['zip']." ".$order['city']." ".$order['country'])?></p>
        </section>
        <div class="seperator"></div>
        <h3>Ordered Items</h3>
        <section class="cart-items">
                <?php foreach($products as $i => $product):?>
                    <section class="cart-item">
                        <img src="<?=ProductImage::getPrimaryByProduct($product['alias'])['url']?>" alt="" class="cart-img">
                        <span class="product-name"><?=$product['name']?></span>
                        <span class="price">x<?=$orderProducts[$i]['quantity']?></span>
                        <span class="price">€<?=floatval($orderProducts[$i]['quantity']) * floatval($product['price'])?></span>
                    </section>
                <?php endforeach;?>
        </section>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
</body>
</html>
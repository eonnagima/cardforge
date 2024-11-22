<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Product;

    $franchise = $_GET["f"] ?? null;

    if(!empty($franchise) && $franchise !== "everything"){
        $allProducts = Product::getAllByFranchise(Franchise::getByAlias($franchise)['id']);
        $header1 = Franchise::getByAlias($franchise)['name'];
    }

    if(!empty($franchise) && $franchise === "everything"){
        $allProducts = Product::getAll();
        $header1 = "All Products";
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $header1;?>| Cardforge</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <main>
        <h1>All Products</h1>
        <h2>New Arrivals</h2>
        <section class="product-list">
            <?php foreach($allProducts as $product): ?>
                <a class="product-listing" href="product.php?p=<?=htmlspecialchars($product['alias'])?>">
                    <img src=".<?=$product['img']?>" alt="<?=htmlspecialchars($product['name'])?>">
                    <h5><?=htmlspecialchars($product['name'])?></h5>
                    <span>$<?=htmlspecialchars($product['price'])?></span>
                </a>
            <?php endforeach;?>
        </section>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
    <script src="./js/footer.js"></script>
</body>
</html>
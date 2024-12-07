<?php
    require_once __DIR__."/bootstrap.php";
    
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Category;
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;

    $franchise = $_GET["f"] ?? null;
    $category = $_GET["c"] ?? null;
    $sortBy = $_GET["s"] ?? 'newest';
    
    if(!empty($franchise) && $franchise !== "everything"){
        $franchise = Franchise::getByAlias($franchise);

        if(!$franchise){
            header("Location: store.php");
            exit();
        }

        $allProducts = Product::getAllByFranchiseSortBy($franchise['alias'], $sortBy);
        $header1 = htmlspecialchars($franchise['name']);
    }

    if(!empty($category)){
        $category = Category::getByAlias($category);

        if(!$category){
            header("Location: store.php?f=".$_GET["f"]);
            exit();
        }

        $header1 = htmlspecialchars($category['name']);
    }

    if($franchise === "everything" || empty($franchise)){
        $allProducts = Product::getAllSortBy($sortBy);
        $header1 = "All Products";
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $header1?> | Cardforge</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <main>
        <nav class="product-nav">
            <a href="index.php">Home</a>
            <span>/</span> 
            <?php if(!empty($category)):?>
                <a href="store.php?f=<?=$franchise['alias']?>"><?=$header1?></a>
                <span>/</span> 
                <a class="current" href="store.php?c=<?=$category['alias']?>"><?=htmlspecialchars($category['name'])?></a>
            <?php else:?>
                <a class="current" href="store.php?f=<?=$franchise['alias']?>"><?=$header1?></a>
            <?php endif;?>
        </nav>
        <h1><?=$header1?></h1>
        <section class="product-filters">

        </section>
        <section class="product-list">
            <?php foreach($allProducts as $product): ?>
                <?php if(!empty($category) && $product['category_id'] === $category['id']):?>
                    <?php
                        $productImage = ProductImage::getPrimaryByProduct($product['alias']);
                    ?>
                    <a class="product-listing" href="product.php?p=<?=htmlspecialchars($product['alias'])?>">
                        <img src="<?=$productImage['url']?>" alt="<?=htmlspecialchars($productImage['alt'])?>">
                        <h5><?=htmlspecialchars($product['name'])?></h5>
                        <span>$<?=htmlspecialchars($product['price'])?></span>
                    </a>
                <?php else:?>
                    <?php
                        $productImage = ProductImage::getPrimaryByProduct($product['alias']);
                    ?>
                    <a class="product-listing" href="product.php?p=<?=htmlspecialchars($product['alias'])?>">
                        <img src="<?=$productImage['url']?>" alt="<?=htmlspecialchars($productImage['alt'])?>">
                        <h5><?=htmlspecialchars($product['name'])?></h5>
                        <span>$<?=htmlspecialchars($product['price'])?></span>
                    </a>
                <?php endif;?>
            <?php endforeach;?>
        </section>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
</body>
</html>
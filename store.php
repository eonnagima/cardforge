<?php
    require_once __DIR__."/bootstrap.php";
    
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Category;
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;

    $franchise = $_GET["f"] ?? null;
    $category = $_GET["c"] ?? null;
    $sortBy = $_GET["s"] ?? 'newest';

    $allCategories = Category::getAll();
    
    if(!empty($franchise)){
        $franchise = Franchise::getByAlias($franchise);

        if(!is_array($franchise)){
            header("Location: store.php");
            exit();
        }

        $allProducts = Product::getAllByFranchiseSortBy($franchise['alias'], $sortBy);
        $header1 = htmlspecialchars($franchise['name']);
    }

    if(!empty($category)){
        if($category == "everything"){
            $category = null;
            $categoryAlias = null;
        }else{
            $category = Category::getByAlias($category);

            if(!is_array($category)){
                if(empty($franchise)){
                    header("Location: store.php");
                    exit();
                }else{
                    header("Location: store.php?f=".$franchise['alias']);
                    exit();
                }
            }
    
            $categoryAlias = $category['alias'];
        }
    }else{ 
        $categoryAlias = null;
    }

    if(empty($franchise)){
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
            <select name="category-filter" id="category-filter">
                <option value="everything" <?php if($categoryAlias === null){echo "selected";}?>>Everything</option>
                <?php foreach($allCategories as $c):?>
                    <option value="<?=$c['alias']?>" <?php if($c['alias'] === $categoryAlias){echo "selected";}?>>
                        <?=htmlspecialchars($c['name'])?>
                    </option>
                <?php endforeach;?>
            </select>
            <select name="sort-by" id="sort-by">
                <option value="newest" <?php if($sortBy === "newest"){echo "selected";}?>>Newest</option>
                <option value="oldest" <?php if($sortBy === "oldest"){echo "selected";}?>>Oldest</option>
                <option value="cheapest" <?php if($sortBy === "cheapest"){echo "selected";}?>>Price:  to High</option>
                <option value="expensive" <?php if($sortBy === "expensive"){echo "selected";}?>>Price: High to Low</option>
            </select>
        </section>
        <section class="product-list">
            <?php foreach($allProducts as $product): ?>
                <?php if(!empty($category)):?>
                    <?php if($product['category_id'] == $category['id']):?>
                        <?php
                            $productImage = ProductImage::getPrimaryByProduct($product['alias']);
                        ?>
                        <a class="product-listing" href="product.php?p=<?=htmlspecialchars($product['alias'])?>">
                            <img src="<?=$productImage['url']?>" alt="<?=htmlspecialchars($productImage['alt'])?>">
                            <h5><?=htmlspecialchars($product['name'])?></h5>
                            <span>$<?=htmlspecialchars($product['price'])?></span>
                        </a>
                    <?php endif;?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortBySelect = document.getElementById('sort-by');
            const categoryFilter = document.getElementById('category-filter');

            sortBySelect.addEventListener('change', function() {
                updateProducts();
            });

            categoryFilter.addEventListener('change', function() {
                updateProducts();
            });

            function updateProducts() {
                const franchise = "<?=$franchise['alias'] ?? null?>";
                const sortBy = sortBySelect.value;
                const category = categoryFilter.value;

                const urlParams = new URLSearchParams(window.location.search);

                if(franchise) {
                    urlParams.set('f', franchise);
                }else{
                    urlParams.delete('f');
                }

                urlParams.set('s', sortBy);
                urlParams.set('c', category);

                const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
                history.pushState(null, '', newUrl);

                fetch(newUrl)
                    .then(response => response.text())
                    .then(data => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const newProductNav = doc.querySelector('.product-nav');
                        const newProductList = doc.querySelector('.product-list')
                        

                        if (newProductNav) {
                            document.querySelector('.product-nav').innerHTML = newProductNav.innerHTML;
                        } else {
                            console.error('Error: .product-nav element not found in the fetched HTML.');
                        }

                        if (newProductList) {
                            document.querySelector('.product-list').innerHTML = newProductList.innerHTML;
                        } else {
                            console.error('Error: .product-list element not found in the fetched HTML.');
                        }
                    })
                    .catch(error => console.error('Error fetching products:', error));
            }
        });
    </script>
</body>
</html>
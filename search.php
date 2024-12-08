<?php
    require_once __DIR__."/bootstrap.php";
    
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Category;
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;

    $searchRequest = $_GET['r'] ?? null;

    if(!empty($searchRequest)){
        try{
            $allProducts = Product::getAllBySearch($searchRequest);
        }catch(Exception $e){
            $error = $e->getMessage();
        }
    }else{
        $searchRequest = "No search request provided";
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | Cardforge</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <main>
        <h1>Search Results</h1>
        <h4 class="search-request">Searching for: <?=$searchRequest?></h4>
        <?php if(isset($error)):?>
            <p><?=$error?></p>
        <?php endif;?>
        <section class="product-list">
            <?php if(empty($allProducts)):?>
                <p>Sorry, but we couldn't find any products based on your search</p>
            <?php else:?>
                <?php foreach($allProducts as $product): ?>
                    <?php
                        $productImage = ProductImage::getPrimaryByProduct($product['alias']);
                    ?>
                    <a class="product-listing" href="product.php?p=<?=htmlspecialchars($product['alias'])?>">
                        <img src="<?=$productImage['url']?>" alt="<?=htmlspecialchars($productImage['alt'])?>">
                        <h5><?=htmlspecialchars($product['name'])?></h5>
                        <span>$<?=htmlspecialchars($product['price'])?></span>
                    </a>
                <?php endforeach;?>
            <?php endif;?>
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
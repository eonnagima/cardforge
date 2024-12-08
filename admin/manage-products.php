<?php
    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Category;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    if(!empty($_GET['error'])){
        $error = $_GET['error'];
    }

    if(!empty($_GET['success'])){
        $success = $_GET['success'];
    }

    try{
        $allProducts = Product::getAll();
    }catch(\Throwable $th){
        $error = $th->getMessage();
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Cardforge</title>
    <?php include_once __DIR__."/../includes/adminstylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/../includes/adminheader.inc.php";?>
    <main>
        <h1>Manage Products</h1>
        <?php if(isset($error)):?>
            <div class="error"><?=$error;?></div>
        <?php endif;?>
        <?php if(isset($_GET['success'])): ?>
            <div class="success"><?= htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        <section class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Primary Image</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Franchise</th>
                        <th>Category</th>
                        <th>Set</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allProducts as $product):?>
                        <?php
                            $franchise = Franchise::getById($product['franchise_id']);
                            $category = Category::getById($product['category_id']);
                            $primaryImage = ProductImage::getPrimaryByProduct($product['alias']);
                        ?>
                        <tr>
                            <td><?=$product['name']?></td>
                            <td class="table-img"><img src="<?=$primaryImage['url']?>" alt="<?=$primaryImage['alt']?>"></td>
                            <td>€<?=number_format(floatval($product['price']), 2)?></td>
                            <td><?=$product['stock']?></td>
                            <td><?=$franchise['name']?></td>
                            <td><?=$category['name']?></td>
                            <td><?=$product['set_name']?></td>
                            <td><?=$product['created']?></td>
                            <td><?=$product['updated']?></td>
                            <td class="table-actions">
                                <a href="./edit-product.php?id=<?=$product['id']?>" class="btn btn-small">Edit</a>
                                <a href="./delete-product.php?id=<?=$product['id']?>" class="btn btn--delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </section>     
        <div class="seperator"></div>
        <section>
            <a class="btn btn--secondary" href="./dashboard.php">Back to Dashboard</a>
        </section>        
    </main>
</body>
</html>
<?php

    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Product;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $allFranchises = Franchise::getAllExceptEverything();

    if(!empty($_POST)){
        try{
            $product = new Product();
            $product->setName($_POST['name']);
            $product->setDescription($_POST['description']);
            $product->setAlias();
            $product->setPrice($_POST['price']);
            $product->setStock($_POST['stock']);
            $product->setFranchise($_POST['franchise']);
            $product->setCategory(1); //placeholder
            $product->setImage(""); //placeholder
            $product->setSetName($_POST['setName']);
            $product->setReleaseDate($_POST['releaseDate']);

            $result = $product->save();
    
            if($result){
                header("Location: ./dashboard.php");
                exit();
            }
        }catch(\Throwable $th){
            $error = $th->getMessage();
        }

    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | Cardforge</title>
    <?php include_once __DIR__."/../includes/adminstylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/../includes/adminheader.inc.php";?>
    <main>
        <h1>Add New Product</h1>
        <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
        <?php endif;?>
        <form class="form" action="" method="post">
            <section>
                <div class="input-wrap">
                    <label for="name">Product Name<span>*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-wrap">
                    <label for="description">Product Description<span>*</span></label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="input-wrap">
                    <label for="franchise">Product Franchise<span>*</span></label>
                    <select id="franchise" name="franchise" required>
                        <option>Select Franchise</option>
                        <?php foreach($allFranchises as $franchise):?>
                            <option value="<?php echo $franchise['alias'];?>"><?php echo htmlspecialchars($franchise['name']);?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="input-wrap">
                    <label for="set-name">Set Name</label>
                    <input type="text" id="set-name" name="setName">
                </div>
                <!-- input release date -->
                <div class="input-wrap">
                    <label for="release-date">Release Date</label>
                    <input type="date" id="release-date" name="releaseDate">
                </div>
                <div class="input-wrap">
                    <label for="price">Product Price<span>*</span></label>
                    <input type="text" id="price" name="price" required>
                </div>
                <div class="input-wrap">
                    <label for="stock">Stock<span>*</span></label>
                    <input type="text" id="stock" name="stock" required>
                </div>         
            </section>
            <div class="seperator"></div>
            <section>
                <input class="btn" type="submit" value="ADD">
                <a class="btn btn--secondary" href="./dashboard.php">Back to Dashboard</a>
            </section>      
        </form>
    </main>
</body>
</html>
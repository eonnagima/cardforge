<?php

    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Category;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $allFranchises = Franchise::getAll();

    if(!empty($_POST)){
        try{
            $category = new Category();
            $category->setName($_POST['name']);
            $category->setAlias(null);
            $category->setFranchise($_POST['franchise']);
            $result = $category->save();
    
            if($result){
                $success = "New category was added successfully";
                header("Location: " . $_SERVER['PHP_SELF'] . "?success=" . urlencode($success));
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
            <div class="error"><?=$error;?></div>
        <?php endif;?>
        <?php if(isset($_GET['success'])): ?>
            <div class="success"><?= htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        <form class="form" action="" method="post">
            <section>
                <div class="input-wrap">
                    <label for="name">Category Name<span>*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-wrap">
                    <label for="franchise">Product Franchise<span>*</span></label>
                    <select id="franchise" name="franchise" required>
                        <option>Select Franchise</option>
                        <?php foreach($allFranchises as $franchise):?>
                            <option value="<?=$franchise['alias'];?>"><?= htmlspecialchars($franchise['name']);?></option>
                        <?php endforeach;?>
                    </select>
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
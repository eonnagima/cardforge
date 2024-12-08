<?php

    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Category;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $allFranchises = Franchise::getAll();

    $getCategoryId = intval($_GET['id']) ?? null;

    if(!empty($getCategoryId)){
            
        $categoryData = Category::getById(intval($getCategoryId));

        if(!$categoryData){
            header("Location: ./manage-categories.php?error=Category not found");
            exit();
        }

        $franchise = Franchise::getById($categoryData['franchise_id']);

        $category = new Category();
        $category->setName($categoryData['name']);
        $category->setAlias($categoryData['alias']);
        $category->setFranchise($franchise['alias']);
    }else{
        header("Location: ./manage-categories.php?error=Category not found");
        exit();
    }
    
    if(!empty($_POST) && isset($_POST['save-edit'])){
        try{
            if(!empty($_POST['name'])){
                $category->setName($_POST['name']);
                $category->setAlias(null);
            }
            if(!empty($_POST['franchise'])){
                
                $category->setFranchise($_POST['franchise']);
            }

            $result = $category->update($getCategoryId);
    
            if($result){
                $success = "Category ".urlencode($category->getName())." was edited succesfully";
                header("Location: ./manage-categories.php?success=" . urlencode($success));
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
    <title>Edit Category <?=htmlspecialchars($category->getName())?> | Cardforge</title>
    <?php include_once __DIR__."/../includes/adminstylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/../includes/adminheader.inc.php";?>
    <main>
        <h1>Edit Category: <?=htmlspecialchars($category->getName())?></h1>
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
                    <input type="text" id="name" name="name" required value="<?=$category->getName()?>">
                </div>
                <div class="input-wrap">
                    <label for="franchise">Product Franchise<span>*</span></label>
                    <select id="franchise" name="franchise" required>
                        <?php foreach($allFranchises as $franchise):?>
                            <option value="<?=$franchise['alias'];?>" <?php if($franchise['alias'] == $category->getFranchise()){echo "selected";}?>>
                                <?= htmlspecialchars($franchise['name']);?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </section>
            <div class="seperator"></div>
            <section>
                <input class="btn" type="submit" value="SAVE EDITS" name="save-edit">
                <a class="btn btn--secondary" href="./dashboard.php">Back to Dashboard</a>
            </section>      
        </form>
    </main>
</body>
</html>
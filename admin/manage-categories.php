<?php
    require_once __DIR__."/../bootstrap.php";
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
        $allCategories = Category::getAll();
    }catch(\Throwable $th){
        $error = $th->getMessage();
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories | Cardforge</title>
    <?php include_once __DIR__."/../includes/adminstylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/../includes/adminheader.inc.php";?>
    <main>
        <h1>Manage Categories</h1>
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
                        <th>Alias</th>
                        <th>Franchise</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allCategories as $category):?>
                        <?php 
                            $franchise = Franchise::getById($category['franchise_id']);
                            $franchise = $franchise['name'];
                        ?>
                        <tr>
                            <td><?=$category['name']?></td>
                            <td><?=$category['alias']?></td>
                            <td><?=$franchise?></td>
                            <td><?=$category['created']?></td>
                            <td><?=$category['updated']?></td>
                            <td class="table-actions">
                                <a href="./edit-category.php?id=<?=$category['id']?>" class="btn btn-small">Edit</a>
                                <a href="./delete-category.php?id=<?=$category['id']?>" class="btn btn--delete">Delete</a>
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
<?php
    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Franchise;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    try{
        $allFranchises = Franchise::getAll();
    }catch(\Throwable $th){
        $error = $th->getMessage();
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Franchises | Cardforge</title>
    <?php include_once __DIR__."/../includes/adminstylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/../includes/adminheader.inc.php";?>
    <main>
        <h1>Manage Franchises</h1>
        <?php if(isset($error)):?>
            <div class="error"><?=$error;?></div>
        <?php endif;?>
        <section class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Franchise Name</th>
                        <th>Franchise Logo</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($allFranchises as $franchise):?>
                        <tr>
                            <td><?=$franchise['name']?></td>
                            <td class="table-img"><img src="<?=$franchise['img']?>" alt="<?=$franchise['name']?>"></td>
                            <td><?=$franchise['created']?></td>
                            <td><?=$franchise['updated']?></td>
                            <td class="table-actions">
                                <a href="./edit-franchise.php?id=<?=$franchise['id']?>" class="btn btn-small">Edit</a>
                                <a href="./delete-franchise.php?id=<?=$franchise['id']?>" class="btn btn--delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
<?php

    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Franchise;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    if(!empty($_POST)){
        try{
            $franchise = new Franchise();
            $franchise->setName($_POST['name']);
            $franchise->setAlias($_POST['alias']);
            $franchise->setImage("placeholder");
            $result = $franchise->save();
    
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
                    <label for="name">Franchise Name<span>*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-wrap">
                    <label for="alias">Franchise Alias<span>*</span></label>
                    <input type="text" id="alias" name="alias" required>
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
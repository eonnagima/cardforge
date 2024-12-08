<?php
    require_once __DIR__."/bootstrap.php";

    if(empty($user)){
        header("Location: login.php");
    }

    if(!empty($_POST)){
        try{
            if(!empty($_POST['ammount'])){
                $user->topUpWallet($_POST['ammount']);
            }
            
            header("Location: myaccount.php");
        }catch(\Throwable $th){
            $error = $th->getMessage();
        }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/includes/header.inc.php";?>
    <main>
        <h1>Top Up Wallet</h1>
        <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
        <?php endif;?>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <section>
                <div>
                    <h3>Current Balance</h3>
                    <span>€<?=number_format(floatval($user->getWallet()),2)?></span>
                </div>
                <div class="input-wrap">
                    <label for="ammount">Choose ammount</label>
                    <input type="number" id="ammount" name="ammount">
                </div>
            </section>
            <div class="seperator"></div>
            <section>
                <input class="btn" type="submit" value="Top Up">
                <a class="btn btn--secondary" href="myaccount.php">Back to My Account</a>
            </section>      
        </form>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
</body>
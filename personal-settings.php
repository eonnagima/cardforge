<?php
    require_once __DIR__."/bootstrap.php";

    if(empty($user)){
        header("Location: login.php");
    }

    if(!empty($_POST)){
        try{
            if(!empty($_POST['first-name'])){
                $user->setFirst_name($_POST['first-name']);
            }
            if(!empty($_POST['last-name'])){
                $user->setLast_name($_POST['last-name']);
            }
            if(!empty($_POST['date-of-birth'])){
                $user->setDate_of_birth($_POST['date-of-birth']);
            }
            if(!empty($_POST['phone-number'])){
                $user->setPhone_number($_POST['phone-number']);
            }
            
            $user->update();
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
        <h1>Account Settings</h1>
        <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
        <?php endif;?>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <section>
                <div class="input-wrap">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" placeholder="<?=$user->getFirst_name()?>">
                </div>
                <div class="input-wrap">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" placeholder="<?=$user->getLast_name()?>">
                </div>
                <div class="input-wrap">
                    <label for="date-of-birth">Date of Birth</label>
                    <input type="date" id="date-of-birth" name="date-of-birth" value="<?=$user->getDate_of_birth()?>">
                </div>
                <div class="input-wrap">
                    <label for="phone-number">Phone Number</label>
                    <input type="tel" id="phone-number" name="phone-number" placeholder="<?=$user->getPhone_number()?>">
                </div>
            </section>
            <div class="seperator"></div>
            <section>
                <input class="btn" type="submit" value="save changes">
                <a class="btn btn--secondary" href="myaccount.php">Back to My Account</a>
            </section>      
        </form>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
</body>
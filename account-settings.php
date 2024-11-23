<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\User;

    if(empty($user)){
        header("Location: login.php");
    }

    if(!empty($_POST)){
        try{
            if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK){
                $filePath = $_FILES['avatar']['tmp_name'];
                $newAvatar = $userUpdate->imageUpload($filePath);
                $user->setAvatar($newAvatar);
                  
                //File Path Test Code
                // $destinationPath = __DIR__."/assets/test/".basename($_FILES['avatar']['name']);
                // if(move_uploaded_file($filePath, $destinationPath)){
                //     // Display the image from the new location
                //     $webPath = 'assets/test/' . basename($_FILES['avatar']['name']);
                //     echo "<img src='$webPath' alt='' style='width: 100px; height: 100px;'>";
                // }else{
                //     $error = "<img src='$webPath' alt='' style='width: 100px; height: 100px;'>";
                // }

            }
            if(!empty($_POST['email'])){
                $user->setEmail($_POST['email']);
            }
            if(!empty($_POST['password'])){
                $user->setPassword($_POST['password']);
                $user->updatePassword();
            }
            
            $user->update();
            //header("Location: myaccount.php");
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
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="<?=$user->getEmail()?>">
                </div>
                <div class="input-wrap password-toggle">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password">
                    <i id="toggle-icon" class="fas fa-eye toggle-icon" onclick="togglePasswordVisibility()"></i>
                </div>
                <div class="input-wrap">
                    <span class="label">Avatar</span>
                    <div class="input-image-wrap" style="background-image: url('<?=$user->getAvatar()?>')">
                        <label for="avatar" class=" img-label">
                            <i class="fas fa-image"></i>
                        </label>
                        <input type="file" id="avatar" name="avatar">
                    </div>
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
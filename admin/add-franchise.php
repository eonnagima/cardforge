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
            
            if(isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK){
                $filePath = $_FILES['logo']['tmp_name'];
                if(!$franchise->isImage($_FILES['logo']['type'])){
                    $error = "Please upload an image file";
                }
                $logoUrl = $franchise->imageUpload($filePath);
                $franchise->setImage($logoUrl);
            }else{
                $error = "Error uploading logo";
            }

            $result = $franchise->save();
    
            if($result){
                $success = "New franchise was added successfully";
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
            <div class="error"><?= $error;?></div>
        <?php endif;?>
        <?php if(isset($_GET['success'])): ?>
            <div class="success"><?= htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <section>
                <div class="input-wrap">
                    <label for="name">Franchise Name<span>*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-wrap">
                    <label for="alias">Franchise Alias<span>*</span></label>
                    <span class="instruction">Single word that refers to the Category</span>
                    <input type="text" id="alias" name="alias" required>
                </div>
                <div class="input-wrap">
                    <span class="label">Logo<span>*</span></span>
                    <div class="input-image-wrap input-image-wrap--product">
                        <label for="logo" class=" img-label">
                            <i class="fas fa-image"></i>
                        </label>
                        <input type="file" id="logo" name="logo" accept="image/*" class="input-image">
                    </div>
                </div>
            </section>

            <div class="seperator"></div>
            <section>
                <input class="btn" type="submit" value="ADD">
                <a class="btn btn--secondary" href="./dashboard.php">Back to Dashboard</a>
            </section>      
        </form>
    </main>
    <script src="./../js/imageFeedback.js"></script>
</body>
</html>
<?php

    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Franchise;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $franchiseId = intval($_GET['id']) ?? null;

    if(!empty($franchiseId)){

        $franchiseData = Franchise::getById(intval($franchiseId));

        if(!$franchiseData){
            header("Location: ./manage-franchises.php?error=Franchise not found");
            exit();
        }

        $franchise = new Franchise();
        $franchise->setName($franchiseData['name']);
        $franchise->setAlias($franchiseData['alias']);
        $franchise->setImage($franchiseData['img']);
    }else{
        header("Location: ./manage-franchises.php?error=Franchise not found");
        exit();
    }

    if(!empty($_POST) && isset($_POST['save-edit'])){
        try{           
            if(isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK){
                $filePath = $_FILES['logo']['tmp_name'];
                if(!$franchise->isImage($filePath)){
                    throw new \Exception("Please upload an image file");
                }
                $logoUrl = $franchise->imageUpload($filePath);
                $franchise->setImage($logoUrl);
            }
            if(!empty($_POST['name'])){
                $franchise->setName($_POST['name']);
            }
            if(!empty($_POST['alias'])){
                $franchise->setAlias($_POST['alias']);
            }

            $result = $franchise->update($franchiseId);
    
            if($result){
                $success = "Franchise ".urlencode($franchise->getName())." was edited succesfully";
                header("Location: ./manage-franchises.php?success=" . urlencode($success));
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
    <title>Edit Franchise <?=htmlspecialchars($franchise->getName())?> | Cardforge</title>
    <?php include_once __DIR__."/../includes/adminstylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/../includes/adminheader.inc.php";?>
    <main>
        <h1>Edit Franchise: <?=htmlspecialchars($franchise->getName())?></h1>
        <?php if(isset($error)):?>
            <div class="error"><?php echo $error;?></div>
        <?php endif;?>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <section>
                <div class="input-wrap">
                    <label for="name">Franchise Name<span>*</span></label>
                    <input type="text" id="name" name="name" value="<?=$franchise->getName()?>" required>
                </div>
                <div class="input-wrap">
                    <label for="alias">Franchise Alias<span>*</span></label>
                    <span class="instruction">Single word that refers to the Category</span>
                    <input type="text" id="alias" name="alias" value="<?=$franchise->getAlias()?>" required>
                </div>
                <div class="input-wrap">
                    <span class="label">Logo<span>*</span></span>
                    <div class="input-image-wrap input-image-wrap--product" style="background-image: url('<?=$franchise->getImage()?>')">
                        <label for="logo" class=" img-label">
                            <i class="fas fa-image"></i>
                        </label>
                        <input type="file" id="logo" name="logo" accept="image/*" class="input-image">
                    </div>
                </div>
            </section>

            <div class="seperator"></div>
            <section>
                <input class="btn" type="submit" value="SAVE EDITS" name="save-edit">
                <a class="btn btn--secondary" href="./dashboard.php">Back to Dashboard</a>
            </section>      
        </form>
    </main>
    <script src="./../js/imageFeedback.js"></script>
</body>
</html>
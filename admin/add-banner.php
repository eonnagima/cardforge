<?php

    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Banner;
    use Codinari\Cardforge\Franchise;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $allFranchises = Franchise::getAll();

    if(!empty($_POST)){
        try{
            $banner = new Banner();
            
            if(isset($_FILES['banner-image']) && $_FILES['banner-image']['error'] == UPLOAD_ERR_OK){
                $filePath = $_FILES['banner-image']['tmp_name'];
                if(!$banner->isImage($filePath)){
                    throw new \Exception("Please upload an image file");
                }
                $bannerUrl = $banner->imageUpload($filePath);
                $banner->setImg($bannerUrl);
            }else{
                throw new \Exception("Error uploading banner image: " . $_FILES['banner-image']['error']);
            }

            if(isset($_FILES['banner-logo']) && $_FILES['banner-logo']['error'] == UPLOAD_ERR_OK){
                $filePath = $_FILES['banner-logo']['tmp_name'];
                if(!$banner->isImage($filePath)){
                    throw new \Exception("Please upload an image file");
                }
                $logoUrl = $banner->imageUpload($filePath);
                $banner->setLogo($logoUrl);
            }else{
                throw new \Exception("Error uploading banner logo: " . $_FILES['banner-logo']['error']);
            }

            $banner->setFranchise($_POST['franchise']);
            $banner->setImageAlt($_POST['banner-alt']);
            $banner->setLogoAlt($_POST['logo-alt']);
            $banner->setActive(1);
            $result = $banner->save();
    
            if($result){
                $success = "New banner was added successfully";
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
    <title>Add Banner | Cardforge</title>
    <?php include_once __DIR__."/../includes/adminstylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/../includes/adminheader.inc.php";?>
    <main>
        <h1>Add New Banner</h1>
        <?php if(isset($error)):?>
            <div class="error"><?= $error;?></div>
        <?php endif;?>
        <?php if(isset($_GET['success'])): ?>
            <div class="success"><?= htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <section>
                <div class="input-wrap">
                    <span class="label">Banner Image<span>*</span></span>
                    <div class="input-image-wrap input-image-wrap--product">
                        <label for="banner-image" class=" img-label">
                            <i class="fas fa-image"></i>
                        </label>
                        <input type="file" id="banner-image" name="banner-image" accept="image/*" class="input-image">
                    </div>
                </div>
                <div class="input-wrap">
                    <label for="banner-alt">Banner Alt Text<span>*</span></label>
                    <input type="text" id="banner-alt" name="banner-alt" required>
                </div>
                <div class="input-wrap">
                    <span class="label">Banner Logo<span>*</span></span>
                    <div class="input-image-wrap input-image-wrap--product">
                        <label for="banner-logo" class=" img-label">
                            <i class="fas fa-image"></i>
                        </label>
                        <input type="file" id="banner-logo" name="banner-logo" accept="image/*" class="input-image">
                    </div>
                </div>
                <div class="input-wrap">
                    <label for="logo-alt">Logo Alt Text<span>*</span></label>
                    <input type="text" id="logo-alt" name="logo-alt" required>
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
            <div class="seperator"></div>
            </section>
            <section>
                <input class="btn" type="submit" value="ADD">
                <a class="btn btn--secondary" href="./dashboard.php">Back to Dashboard</a>
            </section>      
        </form>
    </main>
    <script src="./../js/imageFeedback.js"></script>
</body>
</html>
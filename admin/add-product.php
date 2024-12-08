<?php

    require_once __DIR__."/../bootstrap.php";
    use Codinari\Cardforge\Franchise;
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\Category;
    use Codinari\Cardforge\ProductImage;

    if(empty($user) || $user->getRole() !== "admin"){
        header("Location: ../index.php");
        exit();
    }

    $allFranchises = Franchise::getAllExceptEverything();
    $allCategories = Category::getAll();

    if(!empty($_POST)){
        try{
            $product = new Product();
            $product->setName($_POST['name']);
            $product->setDescription($_POST['description']);
            $product->setDetails($_POST['details']);
            $product->setAlias(null);
            $product->setPrice($_POST['price']);
            $product->setStock($_POST['stock']);
            $product->setFranchise($_POST['franchise']);
            $product->setCategory($_POST['category']); 
            $product->setSetName($_POST['setName']);
            $product->setReleaseDate($_POST['releaseDate']);    
            
            $result = $product->save();

            if(!$result){
                throw new \Exception("Error saving product");
            }

            if(isset($_FILES['primary-image']) && $_FILES['primary-image']['error'] == UPLOAD_ERR_OK){
                $image = new ProductImage();
                $filePath = $_FILES['primary-image']['tmp_name'];
                if(!$image->IsImage($filePath)){
                    throw new \Exception("Please upload an image file");
                }
                $imageUrl = $image->imageUpload($filePath);
                $image->setUrl($imageUrl);
                $image->setPrimaryImg(1);
                $image->setAlt($product->getName());
                $image->setProduct($product->getAlias());
                $image->save();
            }else {
                throw new \Exception("Error uploading primary image: " . $_FILES['primary-image']['error']);
            }

            if(isset($_FILES['images'])){
                foreach($_FILES['images']['error'] as $key => $error){
                    if($error == UPLOAD_ERR_OK){
                        $image = new ProductImage();
                        $filePath = $_FILES['images']['tmp_name'][$key];
                        if(!$image->IsImage($filePath)){
                            throw new \Exception("Please upload an image file");
                        }
                        
                        $imageUrl = $image->imageUpload($filePath);
                        $image->setUrl($imageUrl);
                        $image->setPrimaryImg(0);
                        $image->setAlt($product->getName());
                        $image->setProduct($product->getAlias());
                        $image->save();
                    } else {
                        // Handle file upload error
                        throw new \Exception("Error uploading image: " . $error);
                    }
                }
            }
    
            if($result){
                $success = "New product was added successfully";
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
            <div class="error"><?=$error;?></div>
        <?php endif;?>
        <?php if(isset($_GET['success'])): ?>
            <div class="success"><?= htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <h2>Product Info</h2>
            <section>
                <div class="input-wrap">
                    <label for="name">Product Name<span>*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-wrap">
                    <label for="description">Product Description<span>*</span></label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="input-wrap">
                    <label for="details">Product Details</label>
                    <textarea id="details" name="details"></textarea>
                </div>
                <div class="input-wrap">
                    <label for="franchise">Product Franchise<span>*</span></label>
                    <select id="franchise" name="franchise" required>
                        <option>Select Franchise</option>
                        <?php foreach($allFranchises as $franchise):?>
                            <option value="<?php echo $franchise['alias'];?>"><?php echo htmlspecialchars($franchise['name']);?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="input-wrap">
                    <label for="category">Product Category<span>*</span></label>
                    <select id="category" name="category" required>
                        <option>Select Category</option>
                        <?php foreach($allCategories as $category):?>
                            <option value="<?php echo $category['alias'];?>"><?php echo htmlspecialchars($category['name']);?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="input-wrap">
                    <label for="set-name">Set Name</label>
                    <input type="text" id="set-name" name="setName">
                </div>
                <!-- input release date -->
                <div class="input-wrap">
                    <label for="release-date">Release Date</label>
                    <input type="date" id="release-date" name="releaseDate">
                </div>
                <div class="input-wrap">
                    <label for="price">Product Price<span>*</span></label>
                    <input type="text" id="price" name="price" required>
                </div>
                <div class="input-wrap">
                    <label for="stock">Stock<span>*</span></label>
                    <input type="text" id="stock" name="stock" required>
                </div>         
            </section>
            <div class="seperator"></div>
            <h2>Product Images</h2>
            <section>
                <div class="input-wrap">
                    <span class="label">Primary Image<span>*</span></span>
                    <div class="input-image-wrap input-image-wrap--product">
                        <label for="primary-image" class=" img-label">
                            <i class="fas fa-image"></i>
                        </label>
                        <input type="file" id="primary-image" name="primary-image" accept="image/*" class="input-image"> 
                    </div>
                </div>
                <div class="input-wrap">
                    <span class="label">Images<span>*</span></span>
                    <span class="instruction">You can select more than one image. Make sure images aren't too big in filesize or to upload too many images at once. You can always add more images later.</span>
                    <div class="input-image-wrap input-image-wrap--product">
                        <label for="images" class=" img-label">
                            <i class="fas fa-image"></i>
                        </label>
                        <input type="file" name="images[]" id="images" accept="image/*" multiple>
                    </div>
                    <div class="uploaded-images"></div>
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
    <script>
        //after uploading images in id="images", for each image uploaded, display a small version of it in class="uploaded-images"
        const images = document.getElementById("images");
        const uploadedImages = document.querySelector(".uploaded-images");

        images.addEventListener("change", function(){
            uploadedImages.innerHTML = "";
            const files = images.files;
            for(let i = 0; i < files.length; i++){
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function(e){
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    uploadedImages.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
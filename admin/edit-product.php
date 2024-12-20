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

    $productId = intval($_GET['id']) ?? null;

    if(isset($_GET['error'])){
        $error = $_GET['error'];
    }

    if(!empty($productId)){
        $productData = Product::getById(intval($productId));

        if(!$productData){
            header("Location: ./manage-products.php?error=Product not found");
            exit();
        }

        $franchise = Franchise::getById($productData['franchise_id']);
        $category = Category::getById($productData['category_id']);

        $product = new Product();
        $product->setName($productData['name']);
        $product->setDescription($productData['description']);
        $product->setDetails($productData['details']);
        $product->setAlias($productData['alias']);
        $product->setPrice($productData['price']);
        $product->setStock($productData['stock']);
        $product->setFranchise($franchise['alias']);
        $product->setCategory($category['alias']);
        $product->setSetName($productData['set_name']);
        $product->setReleaseDate($productData['release_date']);
    }

    $allFranchises = Franchise::getAllExceptEverything();
    $allCategories = Category::getAll();

    // save edit of product

    if(!empty($_POST) && isset($_POST['save-edit'])){
        try{
            if(!empty($_POST['name'])){
                $product->setName($_POST['name']);
            }
            if(!empty($_POST['description'])){
                $product->setDescription($_POST['description']);
            }
            if(!empty($_POST['details'])){
                $product->setDetails($_POST['details']);
            }
            if(!empty($_POST['franchise'])){
                $product->setFranchise($_POST['franchise']);
            }
            if(!empty($_POST['category'])){
                $product->setCategory($_POST['category']);
            }
            if(!empty($_POST['setName'])){
                $product->setSetName($_POST['setName']);
            }
            if(!empty($_POST['releaseDate'])){
                $product->setReleaseDate($_POST['releaseDate']);
            }
            if(!empty($_POST['price'])){
                $product->setPrice($_POST['price']);
            }
            if(!empty($_POST['stock'])){
                $product->setStock($_POST['stock']);
            }

            $result = $product->update($productId);

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
                $success = "Product ".urlencode($product->getName())." was edited succesfully";
                header("Location: ./manage-products.php?success=" . urlencode($success));
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
    <title>Edit Product| Cardforge</title>
    <?php include_once __DIR__."/../includes/adminstylesheets.inc.php";?>
</head>
<body>
    <?php include_once __DIR__."/../includes/adminheader.inc.php";?>
    <main>
        <h1>Edit <?=htmlspecialchars($product->getName())?></h1>
        <?php if(isset($error)):?>
            <div class="error"><?=$error;?></div>
        <?php endif;?>
        <?php if(isset($_GET['success'])): ?>
            <div class="success"><?= htmlspecialchars($_GET['success']); ?></div>
        <?php endif;?>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <h2>Product Info</h2>
            <section>
                <div class="input-wrap">
                    <label for="name">Product Name<span>*</span></label>
                    <input type="text" id="name" name="name" value ="<?=$product->getName()?>" required>
                </div>
                <div class="input-wrap">
                    <label for="description">Product Description<span>*</span></label>
                    <textarea id="description" name="description" required>
                        <?=$product->getDescription()?>
                    </textarea>
                </div>
                <div class="input-wrap">
                    <label for="details">Product Details</label>
                    <textarea id="details" name="details">
                        <?=$product->getDetails()?>
                    </textarea>
                </div>
                <div class="input-wrap">
                    <label for="franchise">Product Franchise<span>*</span></label>
                    <select id="franchise" name="franchise" required>
                        <option>Select Franchise</option>
                        <?php foreach($allFranchises as $franchise):?>
                            <option value="<?= $franchise['alias']?>" <?php if($franchise['alias'] == $product->getFranchise()){echo "selected";}?>>
                                <?= htmlspecialchars($franchise['name']);?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="input-wrap">
                    <label for="category">Product Category<span>*</span></label>
                    <select id="category" name="category" required>
                        <option>Select Category</option>
                        <?php foreach($allCategories as $category):?>
                            <option value="<?php echo $category['alias'];?>" <?php if($category['alias'] == $product->getCategory()){echo "selected";}?>>
                                <?= htmlspecialchars($category['name'])?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="input-wrap">
                    <label for="set-name">Set Name</label>
                    <input type="text" id="set-name" name="setName" value="<?=$product->getSetName()?>">
                </div>
                <!-- input release date -->
                <div class="input-wrap">
                    <label for="release-date">Release Date</label>
                    <input type="date" id="release-date" name="releaseDate" value="<?=$product->getReleaseDate()?>">
                </div>
                <div class="input-wrap">
                    <label for="price">Product Price<span>*</span></label>
                    <input type="text" id="price" name="price" required value="<?=$product->getPrice()?>">
                </div>
                <div class="input-wrap">
                    <label for="stock">Stock<span>*</span></label>
                    <input type="text" id="stock" name="stock" required value="<?=$product->getStock()?>">
                </div>         
            </section>
            <div class="seperator"></div>
            <h2>Product Images</h2>
            <h3>Current Images</h3>
            <section class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Primary</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $productImages = ProductImage::getAllByProduct($product->getAlias());

                            foreach($productImages as $image):
                        ?>
                            <tr>
                                <td class="table-img"><img src="<?=$image['url']?>" alt="<?=$image['alt']?>"></td>
                                <td><?=$image['primary_image'] == 1 ? "True" : "False"?></td>
                                <td><?=$image['created']?></td>
                                <td>
                                    <a href="./make-primary-image.php?id=<?=$image['id']?>&product=<?=$image['product_id']?>" class="btn btn-small">Make Primary</a>
                                    <a href="./delete-product-image.php?id=<?=$image['id']?>&product=<?=$image['product_id']?>" class="btn btn--delete">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                </table>
            </section>
            <div class="seperator"></div>
            <h3>Add New Image(s)</h3>
            <section>
                <div class="input-wrap">
                    <span class="label">Images</span>
                    <span class="instruction">You can select more than one image</span>
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
                <input class="btn" type="submit" value="SAVE EDITS" name="save-edit">
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
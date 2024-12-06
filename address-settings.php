<?php
    require_once __DIR__."/bootstrap.php";

    if(empty($user)){
        header("Location: login.php");
    }

    use Codinari\Cardforge\CountryCodes;

    $countryCodes = new CountryCodes();
    $countryList = $countryCodes->getCountryList();

    if(!empty($_POST)){
        try{
            if(!empty($_POST['street'])){
                $user->setAdress_street($_POST['street']);
            }
            if(!empty($_POST['house_number'])){
                $user->setAdress_number($_POST['house_number']);
            }
            if(!empty($_POST['address_extra'])){
                $user->setAdress_extra($_POST['address_extra']);
            }
            if(!empty($_POST['city'])){
                $user->setAdress_city($_POST['city']);
            }
            if(!empty($_POST['zip'])){
                $user->setAdress_zip($_POST['zip']);
            }
            if(!empty($_POST['country'])){
                $user->setAdress_country($_POST['country']);
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
                    <label for="street">Street</label>
                    <input type="text" id="street" name="street" value="<?=$user->getAdress_street()?>">
                </div>
                <div class="input-wrap">
                    <label for="house_number">House Number</label>
                    <input type="text" id="house_number" name="house_number" value="<?=$user->getAdress_number()?>">
                </div>
                <div class="input-wrap">
                    <label for="address_extra">Extra</label>
                    <input type="text" id="address_extra" name="address_extra" value="<?=$user->getAdress_extra()?>">
                </div>
                <div class="input-wrap">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" value="<?=$user->getAdress_city()?>">
                </div>
                <div class="input-wrap">
                    <label for="zip">Zip Code</label>
                    <input type="text" id="zip" name="zip" value="<?=$user->getAdress_zip()?>">
                </div>
                <div class="input-wrap">
                    <label for="country">Country</label>
                    <select name="country" id="country">
                        <!-- nothing option -->
                        <option value="" default>-- Select a country -- </option>
                        <?php foreach($countryList as $code => $country):?>
                            <option value="<?=$code?>" <?php if($code == $user->getAdress_country()) echo "selected";?>><?=$country?></option>
                        <?php endforeach;?>
                    </select>
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
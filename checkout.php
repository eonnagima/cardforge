<?php
    require_once __DIR__."/bootstrap.php";
    use Codinari\Cardforge\Product;
    use Codinari\Cardforge\ProductImage;

    use Codinari\Cardforge\CountryCodes;

    $countryCodes = new CountryCodes();
    $countryList = $countryCodes->getCountryList();

    $cart = $_SESSION['cart'] ?? [];

    $products = [];
    $total = 0;

    foreach($cart as $item){ 
        $product = Product::getByAlias($item);
        $total += $product['price'];
        $products[] = $product;
    }

    //echo count($_SESSION['cart']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Cardforge</title>
    <?php include_once __DIR__."/includes/stylesheets.inc.php";?>
</head>
<body>
    <?php include_once(__DIR__."/includes/header.inc.php");?>
    <main>
        <h1>Checkout</h1>
        <?php if(empty($user)):?>
            <span>You're currently not logged in. <a href="login.php" class="btn btn--secondary">Sign up here</a> or continue as guest</span>
        <?php endif;?>
        <div>
            <section class="cart-items">
                <h2>My Cart</h2> 
                <?php if(empty($products)):?>
                    <p>Your cart is empty</p>
                <?php else:?>
                    <?php foreach($products as $product):?>
                        <section class="cart-item">
                            <img src="<?=ProductImage::getPrimaryByProduct($product['alias'])['url']?>" alt="" class="cart-img">
                            <span class="product-name"><?=$product['name']?></span>
                            <span class="price">€<?=$product['price']?></span>
                            <a href="" class="btn btn--remove" data-product-alias="<?=$product['alias']?>">-</a>
                        </section>
                    <?php endforeach;?>
                <?php endif;?>
            </section>
            <section class="order-wrap">
                <div class="seperator"></div>
                <section class="cart-total">
                    <h3>Total:</h3>
                    <span class="price">€<?=$total?></span>
                </section>
                <div class="seperator"></div>
                <h2>Shipping Information</h2>
                <form action="" method="post" class="form">
                    <?php if(empty($user)):?>
                        <section>
                            <div class="input-wrap">
                                <label for="email">First Name<span>*</span></label>
                                <input type="text" id="first-name" name="first-name" required placeholder="Jane">
                            </div>
                            <div class="input-wrap">
                                <label for="email">Last Name<span>*</span></label>
                                <input type="text" id="last-name" name="last-name" required placeholder="Doe">
                            </div>
                            <div class="input-wrap">
                                <label for="email">Email<span>*</span></label>
                                <input type="text" id="email" name="email" required placeholder="janedoe@email.com">
                            </div>
                            <div class="input-wrap">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" placeholder="+3212345678">
                            </div>
                        </section>
                        <section>
                            <div class="input-wrap">
                                <label for="street">Street</label>
                                <input type="text" id="street" name="street" placeholder="Kerkstraat">
                            </div>
                            <div class="input-wrap">
                                <label for="house_number">House Number</label>
                                <input type="text" id="house_number" name="house_number" placeholder="50">
                            </div>
                            <div class="input-wrap">
                                <label for="adress_extra">Extra</label>
                                <input type="text" id="adress_extra" name="adress_extra" placeholder="bus 3">
                            </div>
                            <div class="input-wrap">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" placeholder="Mechelen">
                            </div>
                            <div class="input-wrap">
                                <label for="zip">Zip Code</label>
                                <input type="text" id="zip" name="zip" placeholder="2800">
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
                    <?php else:?>
                        <section>
                            <div class="input-wrap">
                                <label for="email">First Name<span>*</span></label>
                                <input type="text" id="first-name" name="first-name" required placeholder="Jane" value="<?=$user->getFirst_name()?>">
                            </div>
                            <div class="input-wrap">
                                <label for="email">Last Name<span>*</span></label>
                                <input type="text" id="last-name" name="last-name" required placeholder="Doe" value="<?=$user->getLast_name()?>">
                            </div>
                            <div class="input-wrap">
                                <label for="email">Email<span>*</span></label>
                                <input type="text" id="email" name="email" required placeholder="janedoe@email.com" value="<?=$user->getEmail()?>">
                            </div>
                            <div class="input-wrap">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" placeholder="+3212345678" value="<?=$user->getPhone_number()?>">
                            </div>
                        </section>
                        <div class="seperator"></div>
                        <section>
                            <div class="input-wrap">
                                <label for="street">Street</label>
                                <input type="text" id="street" name="street" value="<?=$user->getAdress_street()?>" placeholder="Kerkstraat">
                            </div>
                            <div class="input-wrap">
                                <label for="house_number">House Number</label>
                                <input type="text" id="house_number" name="house_number" value="<?=$user->getAdress_number()?>" placeholder="50">
                            </div>
                            <div class="input-wrap">
                                <label for="adress_extra">Extra</label>
                                <input type="text" id="adress_extra" name="adress_extra" value="<?=$user->getAdress_extra()?>" placeholder="bus 3">
                            </div>
                            <div class="input-wrap">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" value="<?=$user->getAdress_city()?>" placeholder="Mechelen">
                            </div>
                            <div class="input-wrap">
                                <label for="zip">Zip Code</label>
                                <input type="text" id="zip" name="zip" value="<?=$user->getAdress_zip()?>" placeholder="2800">
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
                    <?php endif;?>
                    <div class="seperator"></div>
                    <section>
                        <a href="store.php" class="btn btn--secondary">Back</a>
                        <?php if (!empty($products)):?>
                            <input class="btn" type="submit" value="Finalize Purchase" name="finalize-purchase">
                        <?php endif;?>
                    </section>

                </form>
            </section>
        </div>
    </main>
    <?php include_once __DIR__."/includes/footer.inc.php";?>
    <script src="./js/pwToggle.js"></script>
    <script>
        //bubble on click event over btn--remove in cart-items
        
        document.querySelectorAll('.btn--remove').forEach(btn => {
            btn.addEventListener('click', function(e){
                e.preventDefault();
                const productAlias = this.getAttribute('data-product-alias');
                fetch('./ajax/remove_from_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_alias: productAlias,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if(data.error){
                        alert(data.error);
                    } else {
                    // Remove the product from the DOM
                    const cartItem = this.closest('.cart-item');
                    cartItem.remove();

                    // Update the total price
                    const totalPriceElement = document.querySelector('.cart-total .price');
                    totalPriceElement.textContent = `€${data.new_total}`;

                    // Update the cart count in the header
                    const cartCountElement = document.querySelector('#cart-count');
                    cartCountElement.textContent = data.cart_count;

                    // Display "no items in cart" message if cart is empty
                    if (data.cart_count === 0) {
                        const cartItemsSection = document.querySelector('.cart-items');
                        cartItemsSection.innerHTML = '<p>Your cart is empty</p>';
                    }
                    }
                });
            });
        });
    </script>
</body>
</html>
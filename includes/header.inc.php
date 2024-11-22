<header>
    <nav>
        <a href="index.php" class="logo"></a>
        <h2 class="app-name">cardforge</h2>
        <a href="#" class="header-avatar" style="background-image: url('./assets/img/user-avatar/default.jpg');"></a>
    </nav>
    <nav>
        <a href="cart/php" class="header-cart cart-icon"></a>
        <form class="search-bar" method="post" action="">
            <input type="text" name="search-request" placeholder="I'm looking for...">
            <input type="submit" value="" class="search-icon">
        </form>
    </nav>
    <nav class="account-nav">
        <?php if(empty($user)):?>
            <a class="btn" href="login.php">Login</a>
            <a class="btn btn--secondary" href="signup.php">Signup</a>
        <?php else:?>
            <a href="myaccount.php">My account</a>
            <a href="cart.php">Cart</a>
            <a href="orders.php">My orders</a>
            <a href="logout.php">Wishlist</a>
            <div class="seperator"></div>
            <a class="btn" href="logout.php">Logout</a>
        <?php endif;?>
    </nav>
    <script src="./js/accountNav.js"></script> <!--placed here so it's automatically included with the header-->
</header>

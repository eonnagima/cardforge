<header>
    <nav>
        <a href="index.php" class="logo"></a>
        <a href="index.php"><h2 class="app-name">cardforge</h2></a>
        <?php if(empty($user)):?>
            <a href="#" class="header-avatar" style="background-image: url('https://res.cloudinary.com/codinari/image/upload/v1732362678/rxtz6j9unmhj7wliqdya.jpg');"></a>
        <?php else:?>
            <a href="login.php" class="header-avatar" style="background-image: url('<?=$user->getAvatar()?>');"></a>
        <?php endif;?>
    </nav>
    <nav>
        <a href="./cart.php" class="header-cart cart-icon">
            <span id="cart-count"><?= count($_SESSION['cart'] ?? [])?></span>
        </a>
        <form class="search-bar" method="post" action="">
            <input type="text" name="search-request" placeholder="I'm looking for...">
            <input type="submit" name="search-btn" value="" class="search-icon" class="search-btn">
        </form>
    </nav>
    <nav class="account-nav">
        <?php if(empty($user)):?>
            <a class="btn" href="login.php">Login</a>
            <a class="btn btn--secondary" href="signup.php">Signup</a>
        <?php else:?>
            <?php if($user->getRole() === "admin"):?>
                <a href="admin/dashboard.php">Admin Dashboard</a>
            <?php endif;?>
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

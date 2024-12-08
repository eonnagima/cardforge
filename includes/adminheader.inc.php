<header>
    <nav>
        <a href="../index.php" class="logo"></a>
        <a href="../index.php"><h2 class="app-name">cardforge</h2></a>
        <?php if(empty($user)):?>
            <a href="#" class="header-avatar" style="background-image: url('https://res.cloudinary.com/codinari/image/upload/v1732362678/rxtz6j9unmhj7wliqdya.jpg');"></a>
        <?php else:?>
            <a href="login.php" class="header-avatar" style="background-image: url('<?=$user->getAvatar()?>');"></a>
        <?php endif;?>
    </nav>
    <nav class="account-nav">
        <a href="../index.php">Back to Home</a>
        <a href="./admin/dashboard.php">Admin Dashboard</a>
        <a href="../myaccount.php">My account</a>
        <div class="seperator"></div>
        <a class="btn" href="../logout.php">Logout</a>
    </nav>
    <script src="../js/accountNav.js"></script> <!--placed here so it's automatically included with the header-->
</header>
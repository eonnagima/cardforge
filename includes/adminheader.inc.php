<header>
    <nav class="mobile-nav desktop-nav">
        <a href="../index.php" class="logo"></a>
        <a href="../index.php"><h2 class="app-name">cardforge</h2></a>
        <a href="#" class="header-avatar header-avatar--mobile" style="background-image: url('<?=$user->getAvatar()?>');"></a>
    </nav>
    <nav class="account-nav">
        <a href="../index.php">Back to Home</a>
        <a href="./dashboard.php">Admin Dashboard</a>
        <a href="../myaccount.php">My account</a>
        <div class="seperator"></div>
        <a class="btn" href="../logout.php">Logout</a>
    </nav>
    <script src="../js/accountNav.js"></script> <!--placed here so it's automatically included with the header-->
</header>
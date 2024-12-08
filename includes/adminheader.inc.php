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
</header>
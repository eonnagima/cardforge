<footer>
    <section>
        <div>
            <h4>Account</h4>
            <a href="#" class="dropdown fas fa-caret-down fa-2x"></a>
        </div>
        <ul class="hidden">
            <?php if(!empty($user)): ?>
                <li><a href="account.php">My account</a></li>
                <li><a href="logout.php">Logout</a></li>
                <?php if($user->getRole() == "admin"): ?>
                    <li><a href="./admin/dashboard.php">Admin Dashboard</a></li>
                <?php endif; ?>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
            <?php endif; ?>
        </ul>
    </section>
    <section>
        <div>
            <h4>Get in touch</h4>
            <a href="#" class="dropdown fas fa-caret-down fa-2x"></a>
        </div>
        <ul class="hidden">
            <li><a href="#">Contact us</a></li>
            <li><a href="#">Return product</a></li>
            <li><a href="https://maps.app.goo.gl/FqBkrARLpRUCpY6N9" target="_blank">Raghenoplein 21 bis<br>2800 Mechelen België</a></li>
        </ul>
    </section>
    <section>
        <div>
            <h4>Our store</h4>
            <a href="#" class="dropdown fas fa-caret-down fa-2x"></a>
        </div>
        <ul class="hidden">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="store.php?f=everything">Shop all</a></li>
            <?php foreach($allFranchises as $franchise): ?>
                <li><a href="store.php?f=<?=htmlspecialchars($franchise['alias'])?>">Shop <?=htmlspecialchars($franchise['alias'])?></a></li>
            <?php endforeach;?>
        </ul>
    </section>
    <section>
        <div>
            <h4>Legal</h4>
            <a href="#" class="dropdown fas fa-caret-down fa-2x"></a>
        </div>
        <ul class="hidden">
            <li><a href="legal/terms.php">Terms & Conditions</a></li>
            <li><a href="legal/privacy.php">Privacy policy</a></li>
            <li><a href="legal/cookies.php">Cookies</a></li>
            <li><a href="legal/shipping.php">Shipping policy</a></li>
            <li><a href="legal/return.php">Return policy</a></li>
        </ul>
    </section>
    <section>
        <div>
            <h4>Follow us</h4>
            <a href="#" class="dropdown fas fa-caret-down fa-2x"></a>
        </div>
        <ul class="hidden">
            <li><a href="https://www.facebook.com/" target="_blank">Facebook</a></li>
            <li><a href="https://www.instagram.com/" target="_blank">Instagram</a></li>
            <li><a href="https://bsky.app/" target="_blank">Bluesky</a></li>
            <li><a href="https://www.twitter.com/" target="_blank">X</a></li>
        </ul>
    </section>
</footer>
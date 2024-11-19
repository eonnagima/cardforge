<?php
    session_start();
    session_destroy();
    //setcookie("login", "", 0); //set cookie with expiration date in the past
    header("Location: index.php");
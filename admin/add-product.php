<?php

    include_once("../classes/Db.php");
    include_once("../functions.php");

    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        // Redirect the user to the login page or display an error message
        header('Location: ../login.php');
        exit;
    }

    if(!checkAdmin($_SESSION['user'])){
        header('Location: ../index.php');
        exit;
    }

    echo "Welcome to the admin page!";
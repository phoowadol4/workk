<?php
session_start();

// Delete token and token expiration session variables
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['token']);
unset($_SESSION['token_expiration']);

    session_unset();
    
    // Destroy the session
    session_destroy();

    
    // Redirect the user to the login page or any other desired page
    header("Location: ../login/login_form.php"); // You might replace this with your actual login page URL
    exit();
 
    header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

?> 
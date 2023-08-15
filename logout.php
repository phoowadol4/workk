<?php
// Start a session
session_start();

// Check if the user is logged in
if (isset($username['username'])) {
    // Perform any necessary cleanup or actions before logging out
    
    // Clear session data
    session_unset();
    
    // Destroy the session
    session_destroy();
    
    // Redirect the user to the login page or any other desired page
    header("Location: login_form.php"); // You might replace this with your actual login page URL
    exit();
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: login_form.php");
    exit();
}
?> 
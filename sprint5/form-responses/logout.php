<?php
session_start();

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    // Clear session variables
    session_unset();
    
    // Destroy the session
    session_destroy();

    // Delete cookies by setting their expiration date to the past
    setcookie("permissions", "", time() - 3600, "/");
    setcookie("userId", "", time() - 3600, "/");

    // Redirect to the login page with a query parameter indicating the user has been logged out
    header("Location: ../pages/login.php?logged_out=true");
    exit; // Ensure no further execution of the script after redirect
} else {
    // If not logged in or redirection failed, output a message for debugging
    echo "Not logged in or redirection failed.";
    exit;
}
?>

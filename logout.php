<?php 
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Start a session
    session_start();
    // Destroy the session, effectively logging out the user
    session_destroy();

    // Redirect the user to the login page
    header("Location: login.php");
    // Exit the script to prevent further execution
    exit ;
}
?>

<?php
session_start(); // Start session

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check password length and pattern
    if (strlen($_POST['reg-password'] ) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long";
        header("Location: register.php");
        exit;
    } elseif (!preg_match("/[A-Za-z0-9]+/",$_POST['reg-password'] )) {
        $_SESSION['error'] = "Password must contain at least one letter and one number symbols or special-characters are not allowed";
        header("Location: register.php");
        exit;
    } elseif ($_POST['reg-password']  !== $_POST['re-password'] ) {
        $_SESSION['error'] = "Passwords don't match";
        header("Location: register.php");
        exit;
    }

    // Include database connection
    include "dbconnection.php";

    // Get username and password from form
    $username = $_POST['reg-username'];
    $password = $_POST['reg-password'];

    // Prepare and execute SQL query to insert new user
    $query = $conn->prepare("INSERT INTO users (USERNAME, PASSWORD) VALUES (?, ?)");
    $query->bind_param("ss", $username, $password);
    if ($query->execute()) {
        header("Location: login.php"); 
        $_SESSION['success'] = "Registered Successfully , Please login with the Registered Account to start !";
        exit;
    } else {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: register.php"); 
        exit;
    }
}
?>

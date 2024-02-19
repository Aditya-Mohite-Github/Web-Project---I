<?php
session_start(); // Start session

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if passwords match
    if ($_POST['reg-password'] !== $_POST['re-password']) {
        $_SESSION['error'] = "Passwords don't match";
        header("Location: register.php"); // Redirect back to registration page
        exit;
    }

    // Include database connection
    include "dbconnection.php";

    // Get username and password from form
    $username = $_POST['reg-username'];
    $password = $_POST['reg-password'];

    // Prepare and execute SQL statement to insert new user
    $query = $conn->prepare("INSERT INTO users (USERNAME, PASSWORD) VALUES (?, ?)");
    $query->bind_param("ss", $username, $password);
    if ($query->execute()) {
        header("Location: login.php"); // Redirect to login page
        $_SESSION['success'] = "Registered Successfully , Please login with the Registered Account to start !";
        exit;
    } else {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: register.php"); // Redirect back to registration page
        exit;
    }
}
?>
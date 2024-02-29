<?php
include "dbconnection.php";
// Start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (strlen($_POST['login_password']) < 8 || !preg_match("/[A-Za-z0-9]+/",$_POST['login_password'] )) {
        $_SESSION['error'] = "Invalid Password";
        header("Location: login.php");
        exit;
    }

    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    $query = "SELECT * FROM users WHERE USERNAME = '$username' ;";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (($username == $row["USERNAME"] && $password == $row["PASSWORD"]) ) {
            // Set session variable to indicate that the user is logged in
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row["USERNAME"];
            // Redirect to dashboard
            header("Location: expense.php");
            exit;
        } else {
            $_SESSION['error'] = "Incorrect Username or Password";
        }
    } else {
        $_SESSION['error'] = "Incorrect Username or Password";
    }
}

// Redirect to login page with error message
header("Location: login.php");
exit;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set document character set and viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set page title -->
    <title>Expense Tracker - Login</title>
    <!-- Link to external CSS stylesheet for login page styling -->
    <link rel="stylesheet" href="cssfiles\login.css">
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Header section -->
    <header class="header">
        <!-- Title of the application -->
        <h1>Expense Tracker</h1>
    </header>
    
    <!-- Main content section -->
    <main class="main">
        <!-- Center align content -->
        <center>
            <?php
            session_start();
            // Display success message if set in session
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>

<?php
            // Display error message if set in session
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>

<!-- Login form section -->
<section class="login-form">
    <!-- Title of the login form -->
    <h2>Login</h2>
    <br><br>
    <!-- Login form -->
    <form action="checklogin.php" method="post">
        <!-- Username input field -->
        <label for="login_username">Username:</label>
        <input type="text" id="login_username" name="login_username" required>
        
        <!-- Password input field -->
        <label for="login_password">Password:</label>
        <!-- Password field with toggle button for visibility -->
        <div class="password-field">
                        <input type="password" id="login_password" name="login_password" required>
                        <!-- Toggle button for password visibility -->
                        <span class="password-toggle" onclick="togglePasswordVisibility()">
                            <!-- Eye icon for password visibility toggle -->
                            <img src="eye-password-hide-svgrepo-com.svg" width="24px" height="24px" alt="eye-icon">
                        </span>
                    </div>
                    
                    <!-- Submit button for login form -->
                    <button type="submit">Login</button>
                </form>
                
                <br>
                <!-- Link to registration page -->
                <p> If you don't have an account, <a href="register.php">Register</a> now!</p>
            </section>
            
        </center>
    </main>
    <!-- Include Bootstrap JavaScript bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"> </script>
     <!-- Script for toggling password visibility -->
     <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("login_password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
        </script>
</body>

</html>

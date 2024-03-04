<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Register</title>
    <!-- Link to custom CSS file for styling -->
    <link rel="stylesheet" href="cssfiles\register.css">
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link to Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <h1>Expense Tracker</h1>
    </header>

    <main class="main">
        <?php
        // Check if there is an error message stored in the session
        if (isset($_SESSION['error'])) {
            // Display the error message
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
            // Unset the error message from the session to avoid displaying it again
            unset($_SESSION['error']);
        }
        ?>
        <center>
            <section class="register-form">
                <h2>Register</h2>
                <br>
                <!-- Form for user registration -->
                <form action="checkreg.php" method="post">
                    <!-- Input field for setting username -->
                    <label for="username">Set a Username:</label>
                    <input type="text" name="reg-username" id="username" required>
                    <br><br>
                    <!-- Input field for setting password -->
                    <label for="password">Set a Password:</label>
                    <input type="password" name="reg-password" id="password" placeholder="Numbers and Alphabets only"
                        required>
                    <br><br>
                    <!-- Input field for re-typing password -->
                    <label for="repassword">Re-type Password:</label>
                    <input type="password" name="re-password" id="repassword" placeholder="Re-Type Your Password"
                        required>
                    <br><br>
                    <!-- Button for submitting the registration form -->
                    <button type="submit">Register</button>
                </form>
                <br>
                <!-- Link for users who already have an account to go to the login page -->
                <p>Have an Account Aleardy ? <a href="login.php">Login...!</a></p>
            </section>
        </center>
    </main>
</body>

</html>

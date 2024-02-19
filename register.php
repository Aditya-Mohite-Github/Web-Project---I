<?php
session_start(); // Start session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Register</title>
    <link rel="stylesheet" href="expense.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <h1>Expense Tracker</h1>
    </header>

    <main class="main">
        <center>
            <section class="register-form">
                <h2>Register</h2>
                <br>
                <?php
                // Display error message if set
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']); // Unset the error message to prevent displaying it again
                }
                ?>
                <form action="checkreg.php" method="post">
                    <label for="username">Set a Username:</label>
                    <input type="text" name="reg-username" id="username" required>
                    <br><br>
                    <label for="password">Set a Password:</label>
                    <input type="password" name="reg-password" id="password" required>
                    <br><br>
                    <label for="repassword">Re-type Password:</label>
                    <input type="password" name="re-password" id="repassword" required>
                    <br><br>
                    <button type="submit">Register</button>
                </form>
            </section>
        </center>
    </main>
</body>

</html>
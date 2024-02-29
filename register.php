<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Register</title>
    <link rel="stylesheet" href="cssfiles\register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <h1>Expense Tracker</h1>
    </header>

    <main class="main">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <center>
            <section class="register-form">
                <h2>Register</h2>
                <br>
                <form action="checkreg.php" method="post">
                    <label for="username">Set a Username:</label>
                    <input type="text" name="reg-username" id="username" required>
                    <br><br>
                    <label for="password">Set a Password:</label>
                    <input type="password" name="reg-password" id="password" placeholder="Numbers and Alphabets only"
                        required>
                    <br><br>
                    <label for="repassword">Re-type Password:</label>
                    <input type="password" name="re-password" id="repassword" placeholder="Re-Type Your Password"
                        required>
                    <br><br>
                    <button type="submit">Register</button>
                </form>
                <br>
                <p>Have an Account Aleardy ? <a href="login.php">Login...!</a></p>
            </section>
        </center>
    </main>
</body>

</html>
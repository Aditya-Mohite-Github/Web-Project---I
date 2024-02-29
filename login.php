<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Login</title>
    <link rel="stylesheet" href="cssfiles\login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"> </script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <h1>Expense Tracker</h1>
    </header>

    <main class="main">
        <center>
            <?php
            session_start();
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>

            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>

            <section class="login-form">
                <h2>Login</h2>
                <br><br>
                <form action="checklogin.php" method="post">
                    <label for="login_username">Username:</label>
                    <input type="text" name="login_username" id="login_username" required>
                    <br><br>
                    <label for="login_password">Password:</label>
                    <input type="password" name="login_password" id="login_password" required>
                    <br><br>
                    <button type="submit">Login</button>
                </form>
                <br>
                <p> if you don't have account <a href="register.php"> Register </a> now !!!</p>
            </section>
        </center>
    </main>


</body>

</html>
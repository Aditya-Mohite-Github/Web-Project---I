<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include "dbconnection.php";
$query = $_POST["search"];
$user = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (preg_match("/\d{4}-\d{2}-\d{2}/", $query)) {
        $sql = "SELECT * FROM expenses WHERE TRANSACTION_DATE = '$query' AND USER = '$user';";
    } else {
        $sql = "SELECT * FROM expenses WHERE DESCRIPTION = '$query' AND USER = '$user';";
    }

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>";
            echo "Description: " . $row["DESCRIPTION"] . " | Amount: " . $row["AMOUNT"] . " | Date: " . $row["TRANSACTION_DATE"];
            echo "<button onclick=\"editRecord(" . $row["ID"] . ")\">Edit</button>";
            echo "<button onclick=\"deleteRecord(" . $row["ID"] . ")\">Delete</button>";
            echo "</li>";
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">
        No Records Founded.
    </div>';
    }

    // Free result set
    mysqli_free_result($result);
}

?>
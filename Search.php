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
        echo '<table class="table table-striped">';
        echo '<thead class="thead-dark">';
        echo '<tr><th>Description</th><th>Amount</th><th>Date</th></tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row["DESCRIPTION"] . '</td>';
            echo '<td>₹' . $row["AMOUNT"] . '</td>';
            echo '<td>' . $row["TRANSACTION_DATE"] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

    } else {
        echo '<div class="alert alert-warning" role="alert">
        No Records Founded.
    </div>';
    }

    // Free result set
    mysqli_free_result($result);
}

?>
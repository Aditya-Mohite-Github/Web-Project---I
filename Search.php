<?php
// Start the session
session_start();

// Check if the user is not logged in, redirect to login page if not
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection file
include "dbconnection.php";

// Get the search query from the POST request
$query = $_POST["search"];

// Get the username from the session
$user = $_SESSION['username'];

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the search query matches the date format (YYYY-MM-DD)
    if (preg_match("/\d{4}-\d{2}-\d{2}/", $query)) {
        // If it matches, construct a SQL query to search by transaction date for the logged-in user
        $sql = "SELECT * FROM expenses WHERE TRANSACTION_DATE = '$query' AND USER = '$user';";
    } else {
        // If it doesn't match the date format, construct a SQL query to search by description for the logged-in user
        $sql = "SELECT * FROM expenses WHERE DESCRIPTION = '$query' AND USER = '$user';";
    }

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if there are any rows returned from the query
    if (mysqli_num_rows($result) > 0) {
        // If there are rows, display them in a table
        echo '<table class="table table-striped" border="2">';
        echo '<thead class="thead-dark">';
        echo '<tr><th>Description</th><th>Amount</th><th>Date</th></tr>';
        echo '</thead>';
        echo '<tbody>';

        // Loop through the rows and display each record in a table row
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
        // If no records are found, display a message indicating so
        echo '<div class="alert alert-warning" role="alert">
                No Records Found.
            </div>';
    }

    // Free the result set
    mysqli_free_result($result);
}
?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); 
}
// Include database connection
include "dbconnection.php";
$user = $_SESSION['username'];
// Check if record ID is provided in the request
if (isset($_GET["id"])) {
    // Get the record ID from the request
    $recordId = $_GET["id"];

    // Prepare SQL statement to delete the record
    $stmt = $conn->prepare("DELETE FROM expenses WHERE ID = ? AND USER = '$user';");
    $stmt->bind_param("i", $recordId);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Deletion successful
        echo "Record deleted successfully.";
    } else {
        // Error occurred
        echo "Error deleting record.";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // No record ID provided in the request
    echo "No record ID provided.";
}

// Close the database connection
$conn->close();
?>

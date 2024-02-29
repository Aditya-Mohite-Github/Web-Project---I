<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: expense.php");
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
    $stmt = $conn->prepare("DELETE FROM expenses WHERE ID = ? AND USER = ?");
    $stmt->bind_param("is", $recordId, $user);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Deletion successful
        echo "Record deleted successfully.";
    } else {
        // Error occurred
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // No record ID provided in the request
    echo "No record ID provided.";
}

?>

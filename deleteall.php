<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Include database connection or any necessary dependencies
include "dbconnection.php";
$user = $_SESSION['username'];
// Function to delete all records from the expenses table
function deleteAllRecords($conn, $user)
{
    $sql = " DELETE FROM expenses WHERE USER = '$user';";
    if ($conn->query($sql) === TRUE) {
        // Return success message
        echo "All records deleted successfully.";
    } else {
        // Return error message
        echo "Error deleting records: " . $conn->error;
    }
}

// Call the function to delete all records
deleteAllRecords($conn, $user);

?>
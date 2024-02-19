<?php
// Include database connection
include "dbconnection.php";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST["record_id"];
    $description = $_POST["edit_description"];
    $amount = $_POST["edit_amount"];
    $date = $_POST["edit_date"];

    // Prepare SQL statement to update record
    $stmt = $conn->prepare("UPDATE expenses SET DESCRIPTION=?, AMOUNT=?, TRANSACTION_DATE=? WHERE ID=?");
    $stmt->bind_param("sdsi", $description, $amount, $date, $id);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record.";
    }

    // Close statement
    $stmt->close();
}
?>

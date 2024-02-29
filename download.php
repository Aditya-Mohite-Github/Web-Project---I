<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include your database connection file
include "dbconnection.php";

// Function to fetch expense records for the logged-in user
function fetchExpenseRecords($conn)
{
    $user = $_SESSION['username'];
    // Prepare SQL statement to fetch expense records for the user
    $stmt = $conn->prepare("SELECT * FROM expenses WHERE USER = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    // Fetch all expense records into an array
    $records = $result->fetch_all(MYSQLI_ASSOC);
    return $records;
}

// Fetch expense records for the logged-in user
$expenseRecords = fetchExpenseRecords($conn);

// Create a temporary file to store the expense records
$tempFile = tempnam(sys_get_temp_dir(), "expense_records_");

// Open the temporary file for writing
$fileHandle = fopen($tempFile, "w");

// Write heading with the user's name
fwrite($fileHandle, "Expense Records for User: " . $_SESSION['username'] . "\n\n");

// Write headers
$header = sprintf("%-10s %-60s %-20s %-20s\n", "ID", "Description", "Amount", "Transaction Date");
fwrite($fileHandle, $header);
fwrite($fileHandle , str_repeat('-' , 120) . "\n");

// Write expense records to the file
foreach ($expenseRecords as $record) {
    // Format each record
    $formattedRecord = sprintf("%-10s %-60s %-20s %-20s\n", $record['ID'], $record['DESCRIPTION'], $record['AMOUNT'], $record['TRANSACTION_DATE']);

    // Write the formatted record to the file
    fwrite($fileHandle, $formattedRecord);
}

// Close the file handle
fclose($fileHandle);


// Set the content type header to indicate that a text file is being downloaded
header('Content-Type: application/octet-stream');

// Set the Content-Disposition header to specify the filename and force the browser to download the file
header('Content-Disposition: attachment; filename="expense_records.txt"');

// Output the file contents
readfile($tempFile);

// Delete the temporary file
unlink($tempFile);
?>

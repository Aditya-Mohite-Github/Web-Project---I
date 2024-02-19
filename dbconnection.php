<?php
// Database connection parameters
$host = "localhost:3306"; 
$username = "Aditya_Mohite"; 
$password = "root";
$database = "expense_tracker"; 

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
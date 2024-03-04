
<?php
    // Include database connection
    include "dbconnection.php";

    // Check if the request method is POST
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $record_id = $_POST["record_id"];
        $description = $_POST["description"];
        $amount = $_POST["amount"];
        $date = $_POST["date"];

        // Prepare SQL statement to update record
        $stmt = $conn->prepare("UPDATE expenses SET DESCRIPTION = ?, AMOUNT = ? WHERE ID = ?");
        $stmt->bind_param("sdi", $description, $amount, $record_id);
        $stmt->execute();

        // Check if record was updated successfully
        if ($stmt->affected_rows > 0) {
            // Redirect to the main page with success message
            session_start();
            $_SESSION['message'] = "Record Updated successfully.";
            header("Location: expense.php");
            exit();
        } else {
            // Redirect to the main page with error message
            session_start();
            $_SESSION['updateerror'] = "Error while Updating Record.";
            header("Location: expense.php");
            exit();
        }
    } else {
        // If not a POST request, redirect to the main page
        header("Location: expense.php");
        exit();
    }
?>

<?php
    // Check if the ID parameter is present in the URL
    if(isset($_GET['id'])) {
        $record_id = $_GET['id'];
        // Redirect to the editrecord.php page with the record ID
        header("Location: edit-form.php?id=$record_id");
        exit();
    } else {
        // If ID parameter is not present, redirect to the main page
        header("Location: expense.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cssfiles/edit-form.css">
</head>

<body>
<header class="header">
        <div id="header">
            <h1 id="logo">Expense Tracker</h1>
        </div>
    </header>
    <div class="container mt-5">
        <h2>Edit Expense Record</h2>
        <?php
        // Check if the ID parameter is present in the URL
        if (isset($_GET['id'])) {
            // Include database connection and fetch record by ID
            include "dbconnection.php";
            $record_id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM expenses WHERE ID = ?");
            $stmt->bind_param("i", $record_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0)
                exit('No rows');
            $row = $result->fetch_assoc();
            // Display the edit form with pre-filled data
            echo '
                    <form action="update_record.php" method="post">
                        <input type="hidden" name="record_id" value="' . $row['ID'] . '">
                        <label for="description">Description:</label> 
                        <input type="text" id="description" name="description" class="form-control" value="' . $row['DESCRIPTION'] . '" required>
                        <label for="amount">Amount:</label>
                        <input type="number" id="amount" name="amount" class="form-control" value="' . $row['AMOUNT'] . '" required>
                        <input type="hidden" id="date" name="date" value="' . $row['TRANSACTION_DATE'] . '">
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                    </form>';
        } else {
            // If ID parameter is not present, redirect to the main page
            header("Location: expense.php");
            exit();
        }
        ?>
    </div>
</body>

</html>
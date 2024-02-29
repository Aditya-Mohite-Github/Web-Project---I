<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cssfiles\expense.css">
</head>

<body>
    <header class="header">
        <div id="header">
            <h1 id="logo">Expense Tracker</h1>
            <form action="logout.php" method="post">
                <button type="submit" class="btn btn-danger"> <span class ="glyphicon glyphicon-log-out"> </span> Logout </button>
            </form>
        </div>
    </header>

    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    echo '<div id="welcome" class="alert alert-success" role="alert"> <center> <b> Welcome, ' . $_SESSION['username'] . '! </b> </center> </div>';
    ?>
    <main class="main">
        <section class="expense-form">
            <h2>Add New Expense</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="description"> Description : </label>
                <input type="text" name="desc" id="descriptionInput" required>
                <br><br>
                <label for="amount"> Amount : </label>
                <input type="number" name="amt" id="amountInput" required>
                <br><br>
                <input type="hidden" name="date" id="currentDate" pattern="\d{4}-\d{2}-\d{2}" required>
                <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-plus"> </span>Add
                    Expense</button>
            </form>

            <br> <br>
            <?php
            include "dbconnection.php";

            // Function to add expense to the database
            function addExpense($conn, $description, $amount, $date)
            {
                $user = $_SESSION['username'];
                // Prepare SQL statement to insert expense
                $stmt = $conn->prepare("INSERT INTO expenses (DESCRIPTION , AMOUNT , TRANSACTION_DATE , USER)VALUES ('$description' , $amount , '$date' , '$user');");

                // Execute SQL statement
                $stmt->execute();

                // Check if expense was added successfully
                if ($stmt->affected_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            }

            // Check if form was submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get form data
                $description = $_POST["desc"];
                $amount = $_POST["amt"];
                $date = date("Y-m-d");

                // Add expense to the database
                $success = addExpense($conn, $description, $amount, $date);

                if ($success) {
                    echo '<div class="alert alert-success" role="alert">
                            Expense added successfully.
                        </div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert"> 
                        Error while adding Expense...
                        </div>';
                }
            }
            ?>

            <br> <br>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Expense</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm">
                                <input type="hidden" id="record_id">
                                <label for="edit_description">Description:</label>
                                <input type="text" name="edit_desc" id="edit_description" class="form-control" required>
                                <br>
                                <label for="edit_amount">Amount:</label>
                                <input type="number" name="edit_amt" id="edit_amount" class="form-control" required>
                                <input type="hidden" id="edit_date" name="edit_date">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="updateRecord()">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <section class="expense-list">
                <h2>Search Expense List:</h2>
                <div>
                    <!-- Search form -->
                    <form id="searchForm" method="post">
                        <input type="text" id="searchInput" name="search"
                            placeholder="Search Records by Date / Description " required>
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                    </form>
                </div>
                <br>
                <div id="searchResults" class="search-results">
                    <!-- Filtered records will be displayed here -->
                </div>

                <br> <br>

                <h2>Expense List:</h2>
                <button class="btn btn-danger" onclick="deleteAllRecords()" id="deleteall" data-bs-toggle="tooltip"
                    title="Delete all of Your Records !"> <span class="glyphicon glyphicon-trash"> </span> Delete All
                    Records</button>
                <button class="btn btn-danger" onclick="#" id="download" data-bs-toggle="tooltip"
                    title="Downloads a file of all Records"> <span class="glyphicon glyphicon-download-alt"> </span>
                    Download Records </button>
                <br><br>
                <ul id="expenseList">
                    <?php
                    if (isset($_SESSION['downloaderror'])) {
                        echo '<div id="welcome "class="alert alert-danger" role="alert"> <b>  ' . $_SESSION['downloaderror'] . ' </b> </div>';
                        unset($_SESSION['downloaderror']);
                    }
                    if (isset($_SESSION['downloadsuccess'])) {
                        echo '<div id="welcome "class="alert alert-success" role="alert"> <b> ' . $_SESSION['downloadsuccess'] . ' </b> </div>';
                        unset($_SESSION['downloadsuccess']);
                    }
                    include "expense_list.php";
                    ?>
                </ul>
            </section>
        </section>
    </main>

    <div style="position: fixed; bottom: 0; right: 0; font-family: 'Roboto', sans-serif;">
        <h5 align="right" style="font-size: 14px"> <u> &copy; Created By Aditya Mohite <br>
                All Rights Reserved </u>
        </h5>
    </div>
    <!-- JavaScript for AJAX -->
    <script>
        // JavaScript to handle form submission via AJAX
        document.getElementById("searchForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            var formData = new FormData(this); // Create FormData object from form

            // Make AJAX request
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById("searchResults").innerHTML = xhr.responseText; // Update searchResults div with filtered records
                    } else {
                        console.error("Error: " + xhr.status);
                    }
                }
            };
            xhr.open("POST", "Search.php", true);
            xhr.send(formData); // Send form data to Search.php
        });

        // Function to fetch record data using AJAX and display the edit modal
        function fetchRecordData(id) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse the JSON response
                        var recordData = JSON.parse(xhr.responseText);
                        // Call a function to populate the edit modal with record data
                        populateEditModal(recordData);
                    } else {
                        console.error("Error fetching record data: " + xhr.status);
                    }
                }
            };
            xhr.open("GET", "fetch_record.php?id=" + id, true);
            xhr.send();
        }

        // Function to populate the edit modal with record data
        function populateEditModal(recordData) {
            document.getElementById("record_id").value = recordData.id;
            document.getElementById("edit_description").value = recordData.description;
            document.getElementById("edit_amount").value = recordData.amount;
            document.getElementById("edit_date").value = recordData.date;
            // Show the edit modal
            var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
                keyboard: false
            });
            myModal.show();
        }

        // Function to update expense record
        function updateRecord() {
            var record_id = document.getElementById("record_id").value;
            var description = document.getElementById("edit_description").value;
            var amount = document.getElementById("edit_amount").value;
            var date = document.getElementById("edit_date").value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        loadExpenseList();
                        var myModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                        myModal.hide();
                        alert("Expense updated successfully.");
                    } else {
                        console.error("Error updating record: " + xhr.responseText);
                        alert("Error updating record.");
                    }
                }
            };
            xhr.open("POST", "update_record.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("id=" + record_id + "&desc=" + description + "&amt=" + amount + "&date=" + date);
        }

        // Function to handle record deletion
        function deleteRecord(id) {
                // Make AJAX request to delete.php
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, reload the expense list
                            loadExpenseList();
                        } else {
                            // If an error occurs, log the error message
                            console.error("Error deleting record: " + xhr.responseText);
                        }
                    }
                };
                xhr.open("GET", "delete.php?id=" + id, true);
                xhr.send();
            
        }

        // Function to load the expense list using AJAX
        function loadExpenseList() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update the expense list with the new data
                        var expenseList = document.getElementById("expenseList");
                        expenseList.innerHTML = xhr.responseText;
                    } else {
                        // Handle error while loading the expense list
                        console.error("Error loading expense list: " + xhr.status);
                    }
                }
            };
            xhr.open("GET", "expense_list.php", true);
            xhr.send();
        }


        function deleteAllRecords() {
            if (confirm("Are you sure you want to delete all records?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Handle successful deletion
                            loadExpenseList(); // Reload the expense list after deletion
                            var searchResults = document.getElementById("searchResults");
                            searchResults.innerHTML = ""; // Clear the search results
                            alert("All records deleted successfully.");
                        } else {
                            // Handle deletion failure
                            console.error("Error deleting records: " + xhr.responseText);
                            alert("Error deleting records.");
                        }
                    }
                };
                xhr.open("GET", "deleteall.php", true);
                xhr.send();
            }
        }

        document.getElementById("download").addEventListener("click", function () {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Create a blob from the response data
                        var blob = new Blob([xhr.response], { type: "text/csv" }); // Set the content type to "text/csv"
                        // Create a URL for the blob
                        var url = window.URL.createObjectURL(blob);
                        // Create a temporary anchor element
                        var a = document.createElement("a");
                        a.href = url;
                        a.download = "expense_records.csv"; // Set the filename with the .csv extension
                        // Append the anchor element to the body and click it programmatically to initiate the download
                        document.body.appendChild(a);
                        a.click();
                        // Remove the anchor element from the body
                        document.body.removeChild(a);
                        // Revoke the URL to release memory
                        window.URL.revokeObjectURL(url);
                    } else {
                        console.error("Error downloading records: " + xhr.status);
                    }
                }
            };
            xhr.responseType = "blob"; // Set the response type to "blob"
            xhr.open("GET", "download.php", true);
            xhr.send();
        });

    </script>
</body>

</html>
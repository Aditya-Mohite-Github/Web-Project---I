<?php

if (!isset($_SESSION['username'])) {
    echo '<div class="alert alert-warning" role="alert">
                            No Records Founded.
                        </div>';
    exit();
}

include "dbconnection.php";
$user = $_SESSION['username'];
function getUserExpense($conn, $user)
{
    $stmt = "SELECT * FROM expenses WHERE USER = '$user';";
    $result = mysqli_query($conn, $stmt);
    $totalexpense = 0;

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo '<thead class="thead-dark">';
        echo '<tr><th>Description</th><th>Amount</th><th>Date</th><th>Action</th></tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row["DESCRIPTION"] . '</td>';
            echo '<td>₹' . $row["AMOUNT"] . '</td>';
            echo '<td>' . $row["TRANSACTION_DATE"] . '</td>';
            echo '<td><button class="btn btn-primary" onclick="editRecord(' . $row["ID"] . ')">Edit</button>';
            echo '<button class="btn btn-danger" onclick="deleteRecord(' . $row["ID"] . ')">Delete</button></td>';
            echo '</tr>';

            $totalexpense += $row["AMOUNT"];
        }

        echo '</tbody>';
        echo '</table>';
        echo "<br><b>Total Expense: $" . number_format($totalexpense, 2) . "</b>"; // Print total expense with 2 decimal places

    } else {
        echo '<div id="norecords"class="alert alert-warning" role="alert">
                            No Records Founded.
                        </div>';
    }

    mysqli_free_result($result);
}



getUserExpense($conn, $user);

?>
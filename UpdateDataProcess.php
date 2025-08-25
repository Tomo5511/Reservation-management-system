<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table'] ?? '';
    $id = $_POST['id'] ?? '';

    if (!$table || !$id) {
        die("Invalid request.");
    }

    $primaryKeys = [
        'Guest' => 'Customer_ID',
        'Employee' => 'Employee_ID',
        'Room' => 'Room_ID',
        'Booking' => 'Booking_ID',
        'Payment' => 'Payment_ID',
        'Invoice' => 'Invoice_ID'
    ];

    if (!array_key_exists($table, $primaryKeys)) {
        die("Invalid table selected.");
    }

    $primaryKey = $primaryKeys[$table];

    // Build the UPDATE query dynamically
    $columns = array_keys($_POST);
    $updateQuery = "UPDATE $table SET ";
    $values = [];

    foreach ($columns as $column) {
        if ($column !== 'table' && $column !== 'id' && $column !== $primaryKey) {
            $escapedValue = $conn->real_escape_string($_POST[$column]);
            $updateQuery .= "$column = '$escapedValue', ";
        }
    }

    $updateQuery = rtrim($updateQuery, ', ') . " WHERE $primaryKey = '$id'";

    // Execute the query
    if ($conn->query($updateQuery) === TRUE) {
        echo "Record updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<br>
<a href="ReadData.php" class="btn btn-primary" style="text-decoration: none; padding: 10px 20px; background-color: blue; color: white; border-radius: 5px;">Go Back</a>
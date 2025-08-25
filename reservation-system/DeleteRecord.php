<?php
require 'connection.php';

$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? '';

if (!$table || !$id) {
    die("Invalid request.");
}

// Map table names to their primary key columns
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

// Delete the record
$sql = "DELETE FROM $table WHERE $primaryKey = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Record deleted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect back to ReadData.php
header("Location: ReadData.php?table=$table");
exit();
?>
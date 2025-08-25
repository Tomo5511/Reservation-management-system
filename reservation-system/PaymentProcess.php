<?php 
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentID = $conn->real_escape_string($_POST['paymentID']);
    $paymentMethod = $conn->real_escape_string($_POST['paymentMethod']);
    $paymentDate = $conn->real_escape_string($_POST['paymentDate']);
    $amount = $conn->real_escape_string($_POST['amount']);
    $paymentStatus = $conn->real_escape_string($_POST['paymentStatus']);

    // Validate inputs
    if (empty($paymentID) || empty($paymentMethod) || empty($paymentDate) || empty($amount) || empty($paymentStatus)) {
        die("All fields are required.");
    }

    if (!is_numeric($paymentID)) {
        die("Payment ID must be a valid number.");
    }

    if (!is_numeric($amount) || $amount <= 0) {
        die("Amount must be a positive number.");
    }

    // Construct the query dynamically
    $sql = "INSERT INTO Payment (Payment_ID, Payment_Method, Date, Amount, Payment_Status) 
            VALUES ('$paymentID', '$paymentMethod', '$paymentDate', '$amount', '$paymentStatus')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Payment recorded successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

<a href="logout.php">Again</a>

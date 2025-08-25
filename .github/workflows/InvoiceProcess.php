<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $invoice_date = $_POST['invoice_date'];
    $customer_id = $_POST['customer_id'];
    $booking_id = $_POST['booking_id'];
    $room_number = $_POST['room_number'];
    $payment_id = $_POST['payment_id'];
    $tax_amount = $_POST['tax_amount'];
    $max_amount = $_POST['max_amount'];

    $stmt = $conn->prepare("INSERT INTO invoices (invoice_date, customer_id, booking_id, room_number, payment_id, tax_amount, max_amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siissss", $invoice_date, $customer_id, $booking_id, $room_number, $payment_id, $tax_amount, $max_amount);

    if ($stmt->execute()) {
        header("Location: success.php");
    } else {
        header("Location: error.php");
    }

    $stmt->close();
    $conn->close();
}
?>

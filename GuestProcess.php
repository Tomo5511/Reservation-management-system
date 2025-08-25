<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, trim($_POST["name"]));
    $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
    $contact = mysqli_real_escape_string($conn, trim($_POST["contact"]));
    $address = mysqli_real_escape_string($conn, trim($_POST["address"]));

    // Construct the query dynamically
    $sql = "INSERT INTO Guest (Name, Email, Contact, Address) 
            VALUES ('$name', '$email', '$contact', '$address')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
    
    header("location:BookingForm2.php");

    $conn->close();
}
?>

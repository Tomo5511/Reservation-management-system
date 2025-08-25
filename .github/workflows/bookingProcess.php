<?php
session_start();
require 'connection.php'; // Ensure the connection file is included

// Get form data with proper validation
$customerName = mysqli_real_escape_string($conn, $_POST['customerName'] ?? '');
$customerEmail = mysqli_real_escape_string($conn, $_POST['customerEmail'] ?? '');
$customerPhone = mysqli_real_escape_string($conn, $_POST['customerPhone'] ?? '');
$customerAddress = mysqli_real_escape_string($conn, $_POST['customerAddress'] ?? '');

$roomType = mysqli_real_escape_string($conn, $_POST['roomType'] ?? '');
$floorNumber = mysqli_real_escape_string($conn, $_POST['floorNumber'] ?? '');
$roomNumber = mysqli_real_escape_string($conn, $_POST['roomNumber'] ?? '');

$checkInDate = mysqli_real_escape_string($conn, $_POST['checkInDate'] ?? '');
$checkOutDate = mysqli_real_escape_string($conn, $_POST['checkOutDate'] ?? '');
$price = mysqli_real_escape_string($conn, $_POST['price'] ?? '');

$paymentMethod = mysqli_real_escape_string($conn, $_POST['paymentMethod'] ?? '');
$totalAmount = mysqli_real_escape_string($conn, $_POST['totalAmount'] ?? '');
$paymentStatus = mysqli_real_escape_string($conn, $_POST['paymentStatus'] ?? 'Completed');
$paymentDate = mysqli_real_escape_string($conn, $_POST['paymentDate'] ?? '');

// Validate required fields
if (empty($customerName) || empty($customerEmail) || empty($customerPhone)  || empty($roomType) || empty($price) ||
    empty($checkInDate) || empty($checkOutDate) || empty($paymentMethod)) {
    header("Location: bookingErr.php");
    exit();
} else {
    // Start transaction
    mysqli_begin_transaction($conn);
    
    try {
        // Insert guest information
        $sql = "INSERT INTO Guest (Name, Email, Contact, Address) 
                VALUES ('$customerName', '$customerEmail', '$customerPhone', '$customerAddress')";
        $query = mysqli_query($conn, $sql);
        
        if (!$query) {
            echo "Error inserting guest information: " . mysqli_error($conn);
        }
        
        $Customer_ID = mysqli_insert_id($conn);
        
        // Insert room information
        $sql1 = "INSERT INTO Room (Room_Type, Floor_Number, Room_Number) 
                VALUES ('$roomType', '$floorNumber', '$roomNumber')";
        $query1 = mysqli_query($conn, $sql1);
        
        if (!$query1) {
            echo "Error inserting room information: " . mysqli_error($conn);
        }

        $Room_ID = mysqli_insert_id($conn);
        
        $Payment_ID = mysqli_insert_id($conn);
        // Insert booking information
        $sql2 = "INSERT INTO Booking (Customer_ID, Room_ID, CheckIn_Date, CheckOut_Date, Price, Room_Type, Room_Number, Date) 
        VALUES ('$Customer_ID', '$Room_ID', '$checkInDate', '$checkOutDate', '$price', '$roomType', '$roomNumber', '$paymentDate')";
        $query2 = mysqli_query($conn, $sql2);
        
        if (!$query2) {
            echo "Error inserting booking information: " . mysqli_error($conn);
        }
        
        $Booking_ID = mysqli_insert_id($conn);
        
        // Insert payment information
        $sql3 = "INSERT INTO Payment (Customer_ID, Booking_ID, Payment_Method, Date, Amount) 
                VALUES ('$Customer_ID', '$Booking_ID', '$paymentMethod', '$paymentDate', '$totalAmount')";
        $query3 = mysqli_query($conn, $sql3);
        
        if (!$query3) {
           echo "Error inserting payment information: " . mysqli_error($conn);
        }
        
        // Commit the transaction
        mysqli_commit($conn);
        
        // Calculate nights for display
        $checkIn = new DateTime($checkInDate);
        $checkOut = new DateTime($checkOutDate);
        $nights = $checkIn->diff($checkOut)->days;
        
        // Generate booking ID and customer ID
        $bookingID = $_POST['bookingID'] ?? 'BK' . date('YmdHis') . rand(100, 999);
        $customerID = $_POST['customerID'] ?? rand(1000, 9999);
        
        // Save booking information to session
        if (!isset($_SESSION['bookings'])) {
            $_SESSION['bookings'] = [];
        }
        
        $_SESSION['bookings'][] = [
            'bookingID' => $bookingID,
            'customerID' => $customerID,
            'customerName' => $customerName,
            'customerEmail' => $customerEmail,
            'customerPhone' => $customerPhone,
            'customerAddress' => $customerAddress,
            'roomType' => $roomType,
            'floorNumber' => $floorNumber,
            'price' => $price,
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
            'totalAmount' => $totalAmount,
            'paymentMethod' => $paymentMethod,
            'paymentStatus' => $paymentStatus,
            'status' => 'Confirmed'
        ];
        
        // Display confirmation
        echo "<div class='container py-4'>";
        echo "<div class='card shadow'>";
        echo "<div class='card-body'>";
        echo "<h2 class='text-success'>Booking Confirmed!</h2>";
        echo "<div class='alert alert-success'>";
        echo "<p><strong>Booking ID:</strong> $bookingID</p>";
        echo "<p><strong>Customer:</strong> $customerName</p>";
        echo "<p><strong>Room:</strong> ($roomType) on floor $floorNumber</p>";
        echo "<p><strong>Stay Duration:</strong> $checkInDate to $checkOutDate ($nights nights)</p>";
        echo "<p><strong>Total Amount:</strong> $$totalAmount</p>";
        echo "<p><strong>Payment Method:</strong> $paymentMethod</p>";
        echo "<p><strong>Payment Status:</strong> $paymentStatus</p>";
        echo "</div>";
        echo "<a href='bookingForm2.php' class='btn btn-primary'>Make Another Booking</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        mysqli_rollback($conn);
        
        // Display error message (for debugging, remove in production)
        echo "<div class='container py-4'>";
        echo "<div class='card shadow'>";
        echo "<div class='card-body'>";
        echo "<h2 class='text-danger'>Error Processing Booking</h2>";
        echo "<div class='alert alert-danger'>";
        echo "<p>" . $e->getMessage() . "</p>";
        echo "</div>";
        echo "<a href='bookingForm.php' class='btn btn-primary'>Try Again</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}

    header("location:Homepage.php");

?>
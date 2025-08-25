<?php
session_start();
require 'connection.php';

// Handle form submission
$bookingData = null;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = trim($_POST['customer_id'] ?? '');
    $email = trim($_POST['email'] ?? '');
    if ($customerId && $email) {
        // Validate guest
        $stmt = $conn->prepare("SELECT * FROM Guest WHERE Customer_ID = ? AND Email = ?");
        $stmt->bind_param("is", $customerId, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            // Fetch booking data
            $stmt2 = $conn->prepare("SELECT * FROM Booking WHERE Customer_ID = ?");
            $stmt2->bind_param("i", $customerId);
            $stmt2->execute();
            $bookingData = $stmt2->get_result();
            $stmt2->close();
        } else {
            $error = 'Invalid Customer ID or Email.';
        }
        $stmt->close();
    } else {
        $error = 'Please enter both Customer ID and Email.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Booking View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2d224c 0%, #23213a 100%);
            color: #e6e6fa;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .form-container {
            margin: 40px auto;
            background: #23213a;
            padding: 24px 18px;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(44, 34, 76, 0.18);
            max-width: 500px;
        }
        .table-container {
            margin: 40px auto;
            background: #23213a;
            padding: 24px 18px;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(44, 34, 76, 0.18);
            max-width: 700px;
        }
        .table {
            background: #23213a;
            color: #e6e6fa;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th, .table td {
            background: #23213a;
            color: #e6e6fa;
            border-color: #b8a6e8;
            font-size: 1rem;
            padding: 10px 12px;
        }
        .table-dark {
            background: #4b3c6e;
            color: #e6e6fa;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="mb-4 text-center">View Your Bookings</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer ID</label>
                <input type="number" class="form-control" id="customer_id" name="customer_id" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">View Bookings</button>
        </form>
    </div>
    <?php if ($bookingData && $bookingData->num_rows > 0): ?>
        <div class="table-container">
            <h3 class="mb-3 text-center">Your Booking Records</h3>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Booking ID</th>
                        <th>Room ID</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Room Type</th>
                        <th>Room Number</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $bookingData->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['Booking_ID']) ?></td>
                            <td><?= htmlspecialchars($row['Room_ID']) ?></td>
                            <td><?= htmlspecialchars($row['CheckIn_Date']) ?></td>
                            <td><?= htmlspecialchars($row['CheckOut_Date']) ?></td>
                            <td><?= htmlspecialchars($row['Room_Type']) ?></td>
                            <td><?= htmlspecialchars($row['Room_Number']) ?></td>
                            <td><?= htmlspecialchars($row['Date']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php elseif ($bookingData): ?>
        <div class="table-container">
            <div class="alert alert-info text-center">No bookings found for this guest.</div>
        </div>
    <?php endif; ?>
</body>
</html>

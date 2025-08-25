<?php
require 'connection.php';

$sql = "SELECT Room.Room_ID, Room.Room_Number, Booking.CheckIn_Date, Booking.CheckOut_Date 
        FROM Room 
        LEFT JOIN Booking ON Room.Room_ID = Booking.Room_ID";
$result = $conn->query($sql);

$rooms = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Status</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2d224c 0%, #23213a 100%);
            color: #e6e6fa;
            font-family: 'Segoe UI', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin: 32px 0 18px 0;
            color: #b8a6e8;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .table-container {
            margin: 0 auto;
            margin-top: 18px;
            background: #23213a;
            padding: 24px 18px;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(44, 34, 76, 0.18);
            max-width: 700px;
        }
        .table {
            margin-top: 10px;
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
        .alert {
            background: #2d224c;
            color: #e6e6fa;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(44, 34, 76, 0.12);
            border: 1px solid #b8a6e8;
        }
        ::-webkit-scrollbar {
            width: 8px;
            background: #23213a;
        }
        ::-webkit-scrollbar-thumb {
            background: #4b3c6e;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>Room Status</h1>
    <?php if (!empty($rooms)): ?>
        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Room ID</th>
                        <th>Room Number</th>
                        <th>Check-In Date</th>
                        <th>Check-Out Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td><?= htmlspecialchars($room['Room_ID']) ?></td>
                            <td><?= htmlspecialchars($room['Room_Number']) ?></td>
                            <td><?= htmlspecialchars($room['CheckIn_Date'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($room['CheckOut_Date'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-4">
            <p>No room data available.</p>
        </div>
    <?php endif; ?>
</body>
</html>
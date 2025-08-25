<?php
session_start();
// Only allow access if logged in and user is employee (not admin)
if (!isset($_SESSION['username']) || $_SESSION['username'] === 'admin') {
    header('Location: loginn.php');
    exit();
}
require 'connection.php';

$result = $conn->query("SELECT Employee_ID, Name, Email, Contact, Position FROM Employee");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2d224c 0%, #23213a 100%);
            color: #e6e6fa;
            font-family: 'Segoe UI', 'Arial', sans-serif;
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
    <div class="table-container">
        <h2 class="mb-4 text-center">Employee Records</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['Employee_ID']) ?></td>
                            <td><?= htmlspecialchars($row['Name']) ?></td>
                            <td><?= htmlspecialchars($row['Email']) ?></td>
                            <td><?= htmlspecialchars($row['Contact']) ?></td>
                            <td><?= htmlspecialchars($row['Position']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No employee records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

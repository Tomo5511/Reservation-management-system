<?php
session_start();
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: whitesmoke;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f8f8;
        }
    </style>
</head>
<body>
    <h1>Invoice Form</h1>
    <form action="format_process.php" method="post">
        <div class="form-group">
            <label for="invoice_date">Invoice Date:</label>
            <input type="date" id="invoice_date" name="invoice_date" required>
        </div>

        <div class="form-group">
            <label for="customer_id">Customer ID:</label>
            <input type="number" id="customer_id" name="customer_id" required>
        </div>

        <div class="form-group">
            <label for="booking_id">Booking ID:</label>
            <input type="number" id="booking_id" name="booking_id" required>
        </div>

        <div class="form-group">
            <label for="room_id">Room Number:</label>
            <input type="number" id="room_number" name="room_id" required>
        </div>

        <div class="form-group">
            <label for="payment_id">Payment ID:</label>
            <input type="number" id="payment_id" name="payment_id" required>
        </div>

        <div class="form-group">
            <label for="tax_amount">Tax Amount:</label>
            <input type="text" id="tax_amount" name="tax_amount" required>
        </div>

        <div class="form-group">
            <label for="max_amount">Max Amount:</label>
            <input type="text" id="max_amount" name="max_amount" required>
        </div>

        <button type="submit">Submit</button>
    </form>

    <h2>Invoice Table</h2>
    <table>
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Invoice Date</th>
                <th>Customer ID</th>
                <th>Booking ID</th>
                <th>Room Number</th>
                <th>Payment ID</th>
                <th>Tax Amount</th>
                <th>Max Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM invoices"; 
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['invoice_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['invoice_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['booking_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['room_number']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['payment_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tax_amount']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['max_amount']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No invoices found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 500px; 
            margin: 0 auto;
            background: white;
            padding: 40px; 
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #4a69dd;
            color: white;
            padding: 15px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px; 
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 12px; 
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #4a69dd;
            color: white;
            border: none;
            padding: 14px 24px; 
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            width: 100%;
        }
        .btn:hover {
            background-color: #3a59cd;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
        <h2>Payment Details</h2>
        </div>
        <form method="POST" action="PaymentProcess.php">
            <div class="form-group">
                <label for="paymentID">Payment ID</label>
                <input type="number" id="paymentID" name="paymentID" required>
            </div>

            <div class="form-group">
                <label for="paymentMethod">Payment Method</label>
                <select id="paymentMethod" name="paymentMethod" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="paymentDate">Date</label>
                <input type="date" id="paymentDate" name="paymentDate" required>
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="paymentStatus">Payment Status</label>
                <select id="paymentStatus" name="paymentStatus" required>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Failed">Failed</option>
                </select>
            </div>

            <input type="submit" class="btn" name="submit" value="Submit Payment">
        </form>

        <?php 
        if (isset($_POST['submit'])) {
            $paymentID = trim($_POST['paymentID']);
            $paymentMethod = trim($_POST['paymentMethod']);
            $paymentDate = trim($_POST['paymentDate']);
            $amount = trim($_POST['amount']);
            $paymentStatus = trim($_POST['paymentStatus']);

           
            if (empty($paymentID) || empty($paymentMethod) || empty($paymentDate) || empty($amount) || empty($paymentStatus)) {
                echo "<p class='error'>All fields are required!</p>";
            }
           
            elseif (!is_numeric($paymentID)) {
                echo "<p class='error'>Payment ID must be a valid number!</p>";
            }
            
            elseif (!is_numeric($amount) || $amount <= 0) {
                echo "<p class='error'>Amount must be a positive number!</p>";
            }
            
            else {
                $_SESSION['paymentID'] = $paymentID;
                $_SESSION['paymentMethod'] = $paymentMethod;
                $_SESSION['paymentDate'] = $paymentDate;
                $_SESSION['amount'] = $amount;
                $_SESSION['paymentStatus'] = $paymentStatus;

                header("Location: Processform.php");
                exit();
            }
        }
        ?>
    </div>
</body>
</html>

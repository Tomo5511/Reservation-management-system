<?php
session_start();
require 'connection.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if ($username && $password) {
        // Check if user is admin
        $sqlAdmin = "SELECT * FROM Users WHERE Username = ? AND Password = ? AND Username = 'admin'";
        $stmtAdmin = $conn->prepare($sqlAdmin);
        $stmtAdmin->bind_param("ss", $username, $password);
        $stmtAdmin->execute();
        $resultAdmin = $stmtAdmin->get_result();
        if ($resultAdmin->num_rows === 1) {
            $_SESSION['username'] = $username;
            header('Location: DASHBOARDBS.php');
            exit();
        }
        $stmtAdmin->close();

        // Check if user is employee
        $sqlEmp = "SELECT * FROM Employee WHERE Email = ? AND Password = ?";
        $stmtEmp = $conn->prepare($sqlEmp);
        $stmtEmp->bind_param("ss", $username, $password);
        $stmtEmp->execute();
        $resultEmp = $stmtEmp->get_result();
        if ($resultEmp->num_rows === 1) {
            $_SESSION['username'] = $username;
            header('Location: EmployeeView.php');
            exit();
        }
        $stmtEmp->close();

        $error = 'Invalid username or password.';
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2d224c 0%, #23213a 100%);
            color: #e6e6fa;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .card, .modal-content {
            background: #23213a;
            color: #e6e6fa;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(44, 34, 76, 0.18);
            border: 1px solid #b8a6e8;
        }
        .form-label {
            color: #b8a6e8;
            font-weight: 600;
        }
        .form-control {
            background: #2d224c;
            color: #e6e6fa;
            border: 1px solid #b8a6e8;
            border-radius: 10px;
        }
        .form-control:focus {
            border-color: #e6e6fa;
            box-shadow: 0 0 0 2px #b8a6e8;
        }
        .btn-primary {
            background: #b8a6e8;
            color: #23213a;
            border: none;
            border-radius: 10px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: #e6e6fa;
            color: #23213a;
        }
        .form-container {
            background: #23213a;
            border: 1.5px solid #b8a6e8;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(44, 34, 76, 0.18);
            padding: 24px;
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
<div class="register-container">
    <h2>Log In</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Log In</button>
    </form>
    <hr>
    <a href="GuestView.php" class="btn btn-secondary w-100 mt-2">Guest Login (Temporary)</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
        .table-container, .alert {
            background: #2d224c;
            color: #e6e6fa;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(44, 34, 76, 0.12);
        }
        .table th, .table td {
            background: #23213a;
            color: #e6e6fa;
            border-color: #b8a6e8;
        }
        .table-dark {
            background: #4b3c6e;
            color: #e6e6fa;
        }
        .modal-header, .modal-footer {
            background: #2d224c;
            color: #b8a6e8;
            border-bottom: 1px solid #b8a6e8;
            border-top: 1px solid #b8a6e8;
        }
        .modal-content {
            border: 1px solid #b8a6e8;
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
        body {
            background-color: lightgrey;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: lightblue;
            border: 2px solid blue;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            color: blue;
        }
        input[type="text"], input[type="email"], input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid blue;
            border-radius: 5px;
            background-color: white;
            color: black;
        }
        input[type="submit"] {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
        Employee
    </button>

    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Employee Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                        <h1>EMPLOYEE</h1>
                        <form method="POST" enctype="multipart/form-data" action="EmployeeProcess.php">
                            <label>Name:</label>
                            <input type="text" name="fullname" minlength="2" maxlength="100" required>
                            <br><br>

                            <label>Email:</label>
                            <input type="email" name="email" minlength="2" maxlength="100" required>
                            <br><br>

                            <label>Contact Number:</label>
                            <input type="text" name="contact" required pattern="\d{11}" title="Must be exactly 11 digits">
                            <br><br>

                            <label>Position:</label>
                            <input type="text" name="position" minlength="4" maxlength="50" required>
                            <br><br>

                            <label>Upload File:</label>
                            <input type="file" name="photo" required>
                            <br><br>

                            <input type="submit" name="submit" value="Submit">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Form</title>
    <style>
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
        }
        input[type="text"], input[type="email"] {
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
    <div class="form-container">
        <h1>GUEST</h1>
        <form action="GuestProcess.php" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" maxlength="100" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" maxlength="100" required>
            
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" maxlength="15" required>
            
            <label for="address">Address</label>
            <input type="text" id="address" name="address" maxlength="300" required>
            
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
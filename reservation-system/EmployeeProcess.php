<?php
require 'connection.php';

if (isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    $fullname = mysqli_real_escape_string($conn, trim($_POST['fullname']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $contact = mysqli_real_escape_string($conn, trim($_POST['contact']));
    $position = mysqli_real_escape_string($conn, trim($_POST['position']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit();
    }

    if (!preg_match('/^\d{11}$/', $contact)) {
        echo "Contact number must be exactly 11 digits!";
        exit();
    }

    if (strlen($position) < 4 || strlen($position) > 50) {
        echo "Position must be between 4 and 50 characters!";
        exit();
    }

    if (strlen($password) < 4) {
        echo "Password must be at least 4 characters!";
        exit();
    }

    // Handle file upload
    $photoPath = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $newFileName = uniqid() . '.' . $fileExtension;
            $photoPath = $uploadDir . $newFileName;

            if (!move_uploaded_file($fileTmpPath, $photoPath)) {
                echo "Failed to upload photo.";
                exit();
            }
        } else {
            echo "Only valid image files (jpg, jpeg, png, gif, webp) are allowed.";
            exit();
        }
    }

    // Insert data into the Employee table (ID is auto-incremented)
    $sql = "INSERT INTO Employee (Name, Email, Contact, Position, Password) 
            VALUES ('$fullname', '$email', '$contact', '$position', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Employee added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
<a href="EmployeeForm.php">Go Back</a>
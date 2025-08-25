<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Reservation_DB";


$conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {

        $conn->select_db($dbname);
    } else {
        die("Error creating database: " . $conn->error);
}


echo "Connected successfully to the database" . "<br>";


?>
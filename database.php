<?php
// Connect to MySQL server without specifying a database
$conn = new mysqli('localhost', 'root', '');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS Reservation_DB";
if ($conn->query($sql) === TRUE) {
    echo "Database checked/created successfully.<br>";
} else {
    echo "Failed to create database: " . $conn->error;
    exit;
}

// Now connect to the Reservation_DB database
$conn->select_db('Reservation_DB');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Create Guest table
$sql = "CREATE TABLE IF NOT EXISTS Guest (
    Customer_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Email VARCHAR(100),
    Contact VARCHAR(15),
    Address VARCHAR(300)
)";
$conn->query($sql);

// Create Employee table
$sql = "CREATE TABLE IF NOT EXISTS Employee (
    Employee_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Email VARCHAR(100),
    Contact VARCHAR(15),
    Position VARCHAR(50),
    Password VARCHAR(255)
)";
$conn->query($sql);

// Create Room table
$sql = "CREATE TABLE IF NOT EXISTS Room (
    Room_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Room_Number INT NOT NULL,
    Room_Type VARCHAR(50),
    Floor_Number INT
)";
$conn->query($sql);

// Create Booking table
$sql = "CREATE TABLE IF NOT EXISTS Booking (
    Booking_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Date DATE,
    Room_ID INT,
    Price DECIMAL(10, 2),
    Room_Type VARCHAR(50),
    CheckIn_Date DATE,
    CheckOut_Date DATE,
    Availability_Status VARCHAR(20),
    Customer_ID INT NOT NULL,
    Room_Number INT,
    FOREIGN KEY (Room_ID) REFERENCES Room(Room_ID),
    FOREIGN KEY (Customer_ID) REFERENCES Guest(Customer_ID)
)";
$conn->query($sql);

// Create Payment table
$sql = "CREATE TABLE IF NOT EXISTS Payment (
    Payment_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Payment_Method VARCHAR(50),
    Booking_ID INT NOT NULL,
    Customer_ID INT NOT NULL,
    Date DATE,
    Amount DECIMAL(10, 2),
    Payment_Status VARCHAR(20),
    FOREIGN KEY (Customer_ID) REFERENCES Guest(Customer_ID)
)";
$conn->query($sql);

// Create Invoice table
$sql = "CREATE TABLE IF NOT EXISTS Invoice (
    Invoice_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Invoice_Date DATE,
    Customer_ID INT,
    Booking_ID INT,
    Room_Number INT,
    Payment_ID INT,
    Tax_Amount DECIMAL(10,2),
    Max_Amount DECIMAL(10,2),
    FOREIGN KEY (Payment_ID) REFERENCES Payment(Payment_ID)
)";
$conn->query($sql);

$conn->close();
?>
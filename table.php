<?php 
require 'connection.php';

$conn->select_db('Reservation_DB');

$sql = "CREATE TABLE IF NOT EXISTS Guest (
    Customer_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Email VARCHAR(100),
    Contact VARCHAR(15),
    Address VARCHAR(300)
)"; $conn->query($sql);

if ($conn) {
    echo "Success";
} else {
    echo "Fail";
}
$sql = "CREATE TABLE IF NOT EXISTS Employee (
    Name VARCHAR(100),
    Email VARCHAR(100),
    Employee_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Contact VARCHAR(15),
    Position VARCHAR(50)
)"; $conn->query($sql);

if ($conn) {
    echo "Success";
} else {
    echo "Fail";
}
$sql = "CREATE TABLE IF NOT EXISTS Room (
    Room_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Room_Number INT NOT NULL,
    Room_Type VARCHAR(50),
    Floor_Number INT
)";
$conn->query($sql);

if ($conn) {
    echo "Success <br>";
} else {
    echo "Fail";
}

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
    FOREIGN KEY (Room_ID) REFERENCES Room(Room_ID),
    FOREIGN KEY (Customer_ID) REFERENCES Guest(Customer_ID)
)";
 $conn->query($sql);

if ($conn->query($sql)) {
  echo "Success creating table<br>"; 
} else {
  echo "Fail: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS Payment (
    Payment_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Payment_Method VARCHAR(50),
    Booking_ID INT NOT NULL,
    Customer_ID INT NOT NULL,
    Date DATE,
    Amount DECIMAL(10, 2),
    Payment_Status VARCHAR(50),
    FOREIGN KEY (Booking_ID) REFERENCES Booking(Booking_ID),
    FOREIGN KEY (Customer_ID) REFERENCES Guest(Customer_ID)
)"; $conn->query($sql);

if ($conn->query($sql)) {
  echo "Success creating table<br>"; 
} else {
  echo "Fail: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS Invoice (
    Invoice_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Customer_ID INT NOT NULL,
    Booking_ID INT NOT NULL,
    Room_ID INT NOT NULL,
    Room_Number INT NOT NULL,
    Payment_ID INT NOT NULL,
    Max_Amount VARCHAR(50),
    Tax_Amount VARCHAR(50),
    Invoice_Date DATE,
    FOREIGN KEY (Customer_ID) REFERENCES Guest(Customer_ID),
    FOREIGN KEY (Booking_ID) REFERENCES Booking(Booking_ID),
    FOREIGN KEY (Room_ID) REFERENCES Room(Room_ID),
    FOREIGN KEY (Payment_ID) REFERENCES Payment(Payment_ID)
)"; $conn->query($sql);

if ($conn->query($sql)) {
  echo "Success creating table<br>"; 
} else {
  echo "Fail: " . $conn->error . "<br>";
}

$sql = "ALTER TABLE Booking ADD Room_Number INT";
if ($conn->query($sql)) {
    echo "Column added successfully<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

$sql = "ALTER TABLE Room DROP COLUMN Occupancy_Limit";
if ($conn->query($sql)) {
    echo "Column dropped successfully<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

?>
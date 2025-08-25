<?php
require 'connection.php'; // Ensure this file contains the database connection logic

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $RoomType = $conn->real_escape_string(trim($_POST["RoomTp"]));
    $RoomNumber = $conn->real_escape_string(trim($_POST["RoomNm"]));
    $FloorNumber = $conn->real_escape_string(trim($_POST["FlrNm"]));
    $Occupancy = $conn->real_escape_string(trim($_POST["OccLm"]));

    if (empty($RoomType) || empty($RoomNumber) || empty($FloorNumber) || empty($Occupancy)) {
        echo "<p style='color: red;'>* All fields are required</p>";
    } elseif (!preg_match('/^\d+$/', $RoomNumber)) {
        echo "<p style='color: red;'>* Room Numbers must only contain digits</p>";
    } elseif (!preg_match('/^\d+$/', $FloorNumber)) {
        echo "<p style='color: red;'>* Floor Numbers must only contain digits</p>";
    } elseif (!preg_match('/^\d+$/', $Occupancy)) {
        echo "<p style='color: red;'>* Occupancy must only contain digits</p>";
    } else {
        // Construct the query dynamically
        $sql = "INSERT INTO Room (Room_Type, Room_Number, Floor_Number) 
                VALUES ('$RoomType', '$RoomNumber', '$FloorNumber')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            $roomId = $conn->insert_id; // Get the inserted Room_ID
            $_SESSION['roomID'] = $roomId; // Store in session for later use
            echo "<p style='color: green;'>Room added successfully!</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
        }
    }

    $conn->close();
}
?>

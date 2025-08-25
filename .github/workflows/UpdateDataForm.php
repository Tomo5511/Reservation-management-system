<?php
require 'connection.php';

$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? '';

if (!$table || !$id) {
    die("Invalid request.");
}

// Map table names to their primary key columns
$primaryKeys = [
    'Guest' => 'Customer_ID',
    'Employee' => 'Employee_ID',
    'Room' => 'Room_ID',
    'Booking' => 'Booking_ID',
    'Payment' => 'Payment_ID',
    'Invoice' => 'Invoice_ID'
];

if (!array_key_exists($table, $primaryKeys)) {
    die("Invalid table selected.");
}

$primaryKey = $primaryKeys[$table];

// Fetch the record to update
$id = $conn->real_escape_string($id);
$sql = "SELECT * FROM $table WHERE $primaryKey = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $record = $result->fetch_assoc();
} else {
    die("Record not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
</head>
<body>
    <h1>Update Record in <?= htmlspecialchars($table) ?></h1>

    <form method="POST" action="UpdateDataProcess.php">
        <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <?php foreach ($record as $column => $value): ?>
            <label for="<?= $column ?>"><?= htmlspecialchars($column) ?>:</label>
            <?php if ($column === $primaryKey): ?>
                <input type="text" id="<?= $column ?>" name="<?= $column ?>" value="<?= htmlspecialchars($value) ?>" readonly>
            <?php else: ?>
                <input type="text" id="<?= $column ?>" name="<?= $column ?>" value="<?= htmlspecialchars($value) ?>">
            <?php endif; ?>
            <br><br>
        <?php endforeach; ?>
        <button type="submit">Update</button>
    </form>
</body>
</html>
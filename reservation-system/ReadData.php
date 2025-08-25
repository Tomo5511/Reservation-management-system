<?php
require 'connection.php';

$tables = ['Guest', 'Employee', 'Room', 'Booking', 'Payment', 'Invoice'];

$selectedTable = $_GET['table'] ?? '';
$records = [];
if ($selectedTable && in_array($selectedTable, $tables)) {
    $sql = "SELECT * FROM $selectedTable";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2d224c 0%, #23213a 100%);
            color: #e6e6fa;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .header-card {
            background: linear-gradient(90deg, #4b3c6e 0%, #23213a 100%);
            color: #e6e6fa;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(44, 34, 76, 0.2);
        }
        .card, .modal-content {
            background: #23213a;
            color: #e6e6fa;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(44, 34, 76, 0.18);
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
        ::-webkit-scrollbar {
            width: 8px;
            background: #23213a;
        }
        ::-webkit-scrollbar-thumb {
            background: #4b3c6e;
            border-radius: 8px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        .btn {
            margin: 5px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .table-container {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            margin-top: 20px;
        }
        .btn-update {
            background-color: #28a745;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-table {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Manage Data</h1>
    <div class="d-flex justify-content-center flex-wrap">
        <?php foreach ($tables as $table): ?>
            <a href="?table=<?= $table ?>" class="btn btn-table"><?= $table ?></a>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($records)): ?>
        <div class="table-container">
            <h2>Records in <?= htmlspecialchars($selectedTable) ?></h2>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <?php foreach (array_keys($records[0]) as $column): ?>
                            <th><?= htmlspecialchars($column) ?></th>
                        <?php endforeach; ?>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <?php foreach ($record as $value): ?>
                                <td><?= htmlspecialchars($value) ?></td>
                            <?php endforeach; ?>
                            <td>
                                <a href="UpdateDataForm.php?table=<?= $selectedTable ?>&id=<?= $record[array_keys($record)[0]] ?>" 
                                   class="btn btn-update">Update</a>
                                <a href="DeleteRecord.php?table=<?= $selectedTable ?>&id=<?= $record[array_keys($record)[0]] ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif ($selectedTable): ?>
        <div class="alert alert-warning mt-4">
            <p>No records found in <?= htmlspecialchars($selectedTable) ?>.</p>
        </div>
    <?php endif; ?>
</body>
</html>
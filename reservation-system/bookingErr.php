<?php
echo "<div class='container py-4'>";
echo "<div class='card shadow'>";
echo "<div class='card-body'>";
echo "<h2 class='text-danger'>Error: Incomplete Booking Data</h2>";
echo "<div class='alert alert-danger'>";
echo "<p>Please fill out all required fields in the booking form.</p>";
echo "<p>Missing fields may include:</p>";
echo "<ul>";
echo "<li>Guest information (name, email, phone)</li>";
echo "<li>Room details (number, type)</li>";
echo "<li>Booking dates</li>";
echo "<li>Payment method</li>";
echo "</ul>";
echo "</div>";
echo "<a href='bookingForm.php' class='btn btn-primary'>Return to Booking Form</a>";
echo "</div>";
echo "</div>";
echo "</div>";
?>
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
</style>
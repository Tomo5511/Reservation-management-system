<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Booking System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    .status-available { color: #28a745; }
    .status-unavailable { color: #dc3545; }
    .modal-body { max-height: 70vh; overflow-y: auto; }
    .required:after { content: " *"; color: red; }
    @media (max-width: 768px) {
      .modal-dialog { margin: 0.5rem auto; }
    }
  </style>
</head>
<body class="bg-light">
  <div class="container py-4">
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
          <h2 class="mb-0">Hotel Booking System</h2>
          <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#bookingModal">
            <i class="bi bi-plus-circle"></i> Create New Booking
          </button>
        </div>
      </div>
      
      <div class="card-body">
        <h3 class="mb-3">Current Bookings</h3>
        <?php
        require 'connection.php';
        $result = $conn->query("SELECT * FROM Booking ORDER BY CheckIn_Date DESC");
        if ($result && $result->num_rows > 0): ?>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-light">
                <tr>
                  <th>Booking ID</th>
                  <th>Customer ID</th>
                  <th>Room ID</th>
                  <th>Check-In</th>
                  <th>Check-Out</th>
                  <th>Room Type</th>
                  <th>Room Number</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($booking = $result->fetch_assoc()): ?>
                  <tr>
                    <td><?= htmlspecialchars($booking['Booking_ID']) ?></td>
                    <td><?= htmlspecialchars($booking['Customer_ID']) ?></td>
                    <td><?= htmlspecialchars($booking['Room_ID']) ?></td>
                    <td><?= htmlspecialchars($booking['CheckIn_Date']) ?></td>
                    <td><?= htmlspecialchars($booking['CheckOut_Date']) ?></td>
                    <td><?= htmlspecialchars($booking['Room_Type']) ?></td>
                    <td><?= htmlspecialchars($booking['Room_Number']) ?></td>
                    <td class="status-available">Confirmed</td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
          <div class="alert alert-info">No bookings yet. Create your first booking!</div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="bookingModalLabel">New Booking & Payment</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <form method="POST" action="bookingProcess.php">
            <input type="hidden" name="bookingID" value="BK<?= date('YmdHis') . rand(100, 999) ?>">
            <input type="hidden" name="customerID" value="<?= rand(1000, 9999) ?>">
            
            <div class="mb-4">
              <h4 class="border-bottom pb-2">Guest Information</h4>
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="customerName" class="form-label required">Full Name</label>
                  <input type="text" class="form-control" id="customerName" name="customerName" required>
                </div>
                <div class="col-md-6">
                  <label for="customerEmail" class="form-label required">Email</label>
                  <input type="email" class="form-control" id="customerEmail" name="customerEmail" required>
                </div>
                <div class="col-md-6">
                  <label for="customerPhone" class="form-label required">Phone</label>
                  <input type="tel" class="form-control" id="customerPhone" name="customerPhone" required>
                </div>
                <div class="col-md-6">
                  <label for="customerAddress" class="form-label">Address</label>
                  <input type="text" class="form-control" id="customerAddress" name="customerAddress">
                </div>
              </div>
            </div>
            
            <div class="mb-4">
              <h4 class="border-bottom pb-2">Room Details</h4>
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="roomType" class="form-label required">Room Type</label>
                  <select class="form-select" id="roomType" name="roomType" required>
                    <option value="">Select Type</option>
                    <option value="Standard Single" data-price="100">Standard Single</option>
                    <option value="Standard Double" data-price="150">Standard Double</option>
                    <option value="Deluxe Double" data-price="250">Deluxe Double</option>
                    <option value="Suite" data-price="400">Suite</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="price" class="form-label required">Price/Night (₱)</label>
                  <input type="number" step="0.01" class="form-control" id="price" name="price" readonly required>
                </div>
                <div class="col-md-6">
                  <label for="floorNumber" class="form-label">Floor Number</label>
                  <input type="number" class="form-control" id="floorNumber" name="floorNumber" readonly>
                </div>
                <div class="col-md-6">
                  <label for="roomNumber" class="form-label required">Room Number</label>
                  <select class="form-select" id="roomNumber" name="roomNumber" required>
                    <option value="">Select Room Number</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="mb-4">
              <h4 class="border-bottom pb-2">Booking Dates</h4>
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="checkInDate" class="form-label required">Check-In</label>
                  <input type="date" class="form-control" id="checkInDate" name="checkInDate" required>
                </div>
                <div class="col-md-6">
                  <label for="checkOutDate" class="form-label required">Check-Out</label>
                  <input type="date" class="form-control" id="checkOutDate" name="checkOutDate" required>
                </div>
              </div>
            </div>
            
            <div class="mb-4">
              <h4 class="border-bottom pb-2">Payment Information</h4>
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="paymentMethod" class="form-label required">Payment Method</label>
                  <select class="form-select" id="paymentMethod" name="paymentMethod" required>
                    <option value="">Select Method</option>
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="totalAmount" class="form-label required">Total Amount (₱)</label>
                  <input type="number" step="0.01" class="form-control" id="totalAmount" name="totalAmount" readonly required>
                </div>
                <input type="hidden" name="paymentStatus" value="Completed">
              </div>
            </div>

            <div class="form-group">
                <label for="paymentDate">Payment Date: </label>
                <input type="date" id="paymentDate" name="paymentDate" step="0.01" class="form-control" required readonly>
               
                <script type="text/javascript">
                    document.addEventListener('DOMContentLoaded', function() {
                      const today = new Date();
                      const year = today.getFullYear();
                      const month = String(today.getMonth() + 1).padStart(2, '0');
                      const day = String(today.getDate()).padStart(2, '0');
                      const formattedDate = `${year}-${month}-${day}`;
                      
                      document.getElementById('paymentDate').value = formattedDate;
                    });
                </script>
            </div>

            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Confirm Booking & Payment</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('bookingModal').addEventListener('show.bs.modal', function() {
      const today = new Date().toISOString().split('T')[0];
      document.getElementById('checkInDate').min = today;
      
      document.getElementById('checkInDate').addEventListener('change', function() {
        document.getElementById('checkOutDate').min = this.value;
        if (document.getElementById('checkOutDate').value < this.value) {
          document.getElementById('checkOutDate').value = '';
        }
        calculateTotal();
      });
      
      document.getElementById('checkOutDate').addEventListener('change', calculateTotal);
    });

    document.getElementById('roomType').addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const price = selectedOption.getAttribute('data-price');
      document.getElementById('price').value = price;
      
      const roomType = this.value;
      let floorNumber = '';
      
      if (roomType === 'Standard Single') {
        floorNumber = '2';
      } else if (roomType === 'Standard Double') {
        floorNumber = '3';
      } else if (roomType === 'Deluxe Double') {
        floorNumber = '4';
      } else if (roomType === 'Suite') {
        floorNumber = '5';
      }
      
      document.getElementById('floorNumber').value = floorNumber;
      calculateTotal();
    });

    document.getElementById('roomType').addEventListener('change', function () {
  const selectedOption = this.options[this.selectedIndex];
  const price = selectedOption.getAttribute('data-price');
  const roomType = this.value;
  
  document.getElementById('price').value = price;

  let floorNumber = '';
  let roomStart = 0;
  let roomEnd = 0;

  switch (roomType) {
    case 'Standard Single':
      floorNumber = '2';
      roomStart = 200;
      roomEnd = 210;
      break;
    case 'Standard Double':
      floorNumber = '3';
      roomStart = 300;
      roomEnd = 310;
      break;
    case 'Deluxe Double':
      floorNumber = '4';
      roomStart = 400;
      roomEnd = 410;
      break;
    case 'Suite':
      floorNumber = '5';
      roomStart = 500;
      roomEnd = 510;
      break;
  }

  document.getElementById('floorNumber').value = floorNumber;

  // Populate Room Numbers
  const roomSelect = document.getElementById('roomNumber');
  roomSelect.innerHTML = '<option value="">Select Room Number</option>'; // Reset
  for (let i = roomStart; i <= roomEnd; i++) {
    const option = document.createElement('option');
    option.value = i;
    option.text = i;
    roomSelect.appendChild(option);
  }

  calculateTotal(); // Recalculate in case user changed room type
});

    function calculateTotal() {
      const price = parseFloat(document.getElementById('price').value) || 0;
      const checkIn = new Date(document.getElementById('checkInDate').value);
      const checkOut = new Date(document.getElementById('checkOutDate').value);
      
      if (checkIn && checkOut && checkIn < checkOut) {
        const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        const total = price * nights;
        document.getElementById('totalAmount').value = total.toFixed(2);
      } 
    }
  </script>
</body>
</html>
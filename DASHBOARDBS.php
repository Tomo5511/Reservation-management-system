<?php
session_start();
// If not logged in or not admin, redirect to login
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: loginn.php');
    exit();
}
?>
<style>
/* Compact dashboard layout */
body {
    background: linear-gradient(135deg, #2d224c 0%, #23213a 100%);
    color: #e6e6fa;
    font-family: 'Segoe UI', 'Arial', sans-serif;
}
.header-card {
    background: linear-gradient(90deg, #4b3c6e 0%, #23213a 100%);
    color: #e6e6fa;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(44, 34, 76, 0.12);
    padding: 10px 16px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
.nav-tabs {
    margin-bottom: 8px;
    flex-wrap: wrap;
    gap: 2px;
}
.nav-tabs .nav-link {
    color: #b8a6e8 !important;
    background: transparent;
    border-radius: 6px 6px 0 0;
    margin-right: 2px;
    font-weight: 600;
    font-size: 0.92rem;
    padding: 4px 10px;
    min-width: 70px;
    transition: background 0.2s;
}
.nav-tabs .nav-link.active {
    background: #23213a;
    color: #e6e6fa !important;
    border-color: #b8a6e8 #b8a6e8 #23213a;
}
.btn-custom {
    background: linear-gradient(90deg, #4b3c6e 0%, #23213a 100%);
    color: #e6e6fa;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(44, 34, 76, 0.10);
    font-weight: 600;
    border: none;
    margin-bottom: 8px;
    font-size: 0.92rem;
    padding: 6px 12px;
    transition: background 0.2s, box-shadow 0.2s;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.btn-custom img {
    width: 22px;
    height: 22px;
}
.btn-custom:hover {
    background: #b8a6e8;
    color: #23213a;
    box-shadow: 0 4px 12px rgba(44, 34, 76, 0.16);
}
.card, .modal-content {
    background: #23213a;
    color: #e6e6fa;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(44, 34, 76, 0.10);
    border: 1px solid #b8a6e8;
    margin-bottom: 10px;
    padding: 10px 12px;
}
.form-label {
    color: #b8a6e8;
    font-weight: 600;
    font-size: 0.92rem;
}
.form-control {
    background: #2d224c;
    color: #e6e6fa;
    border: 1px solid #b8a6e8;
    border-radius: 6px;
    font-size: 0.92rem;
    padding: 6px 10px;
}
.form-control:focus {
    border-color: #e6e6fa;
    box-shadow: 0 0 0 2px #b8a6e8;
}
.btn-primary {
    background: #b8a6e8;
    color: #23213a;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.92rem;
    padding: 6px 12px;
}
.btn-primary:hover {
    background: #e6e6fa;
    color: #23213a;
}
.table-container, .alert {
    background: #2d224c;
    color: #e6e6fa;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(44, 34, 76, 0.08);
    padding: 8px 10px;
}
.table th, .table td {
    background: #23213a;
    color: #e6e6fa;
    border-color: #b8a6e8;
    font-size: 0.92rem;
    padding: 6px 8px;
}
.table-dark {
    background: #4b3c6e;
    color: #e6e6fa;
}
.modal-header, .modal-footer {
    background: #2d224c;
    color: #b8a6e8;
    border-bottom: 1px solid #b8a6e8;
    border-top: 1px solid #b8a6e8;
    padding: 6px 10px;
}
.modal-content {
    border: 1px solid #b8a6e8;
    padding: 8px 10px;
}
.form-container {
    background: #23213a;
    border: 1.5px solid #b8a6e8;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(44, 34, 76, 0.10);
    padding: 10px 12px;
    margin-bottom: 10px;
}
::-webkit-scrollbar {
    width: 8px;
    background: #23213a;
}
::-webkit-scrollbar-thumb {
    background: #4b3c6e;
    border-radius: 8px;
}
@media (max-width: 768px) {
    .header-card, .card, .modal-content, .form-container, .table-container {
        padding: 6px 4px;
        margin-bottom: 6px;
    }
    .nav-tabs .nav-link, .btn-custom, .btn-primary, .form-control, .form-label, .table th, .table td {
        font-size: 0.88rem;
        padding: 5px 6px;
    }
}
/* Compact grid for dashboard buttons */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 10px;
    margin-bottom: 10px;
}
</style>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
      body {
        background-color: lightgrey;
      }


       .header-card {
            background-color: rgb(43, 180, 234);
            position: relative;
        }

       .header-title {
            position: absolute;
            left: 10px;
            top: 5px;
            color: white;
        }

        .Gmail {
        	width: 170px;
        	height: 60px;
        	border-radius: 20px;
        	
        	background-color: white;
        	color: black;
        	font-weight: bold;
        	display: flex;
        	align-items: center;
        	justify-content: center;
        	gap: 5px;
        }

        .header-form-img {
        	width: 30px;
        	height: 30px;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            margin-right: 20px;
        }

        .btn-img {
        	width: 10vh;
        }

        .btn-custom {
        	width: 50vh;
            border-radius: 10px;

        }

        .btn-reservation {
        	 background-color: rgb(84, 35, 245);
        }
        .btn-room-status {
            background-color: rgb(63, 192, 218);
        }
        .btn-assign-room {
            background-color: rgb(43, 55, 132);
        }



        @media (max-width: 804px) {
            .Gmail {
                width: 100%; /* Full width on small screens */
                position: relative; /* Change position for responsiveness */
                margin-bottom: 10px; /* Add margin for spacing */
            }

            .nav {
                flex-direction: column; /* Stack nav items vertically */
                align-items: center; /* Center align items */
            }

            .nav-link {
                margin: 5px 0; /* Add vertical spacing between links */
            }

            .btn-custom {
            	width: 100%;
            }
        }

        @media (max-width: 1400px) {
        	.btn-custom {
        		width: 100%;
        		height: 100%;
        	}
        }

        .nav-tabs .nav-link {
            color: #6f42c1;
        }
        .nav-tabs .nav-link.active {
            background-color: darkblue;
            border-color: white;
        }
        .date-input {
            border-radius: 0.25rem; 
        }

       

        @media (max-width: 576px) {
        .nav-tabs {
            flex-direction: row; /* Make tabs horizontal on small screens */
        }

        .tab-content {
            display: flex;
            flex-direction: column; /* Stack content vertically */
        }

        .alert {
            width: 100%; /* Ensure alert takes full width on small screens */
        }

        .form-control {
            width: 100%; /* Full width input on small screens */
        }
    }


    </style>
	<title>Navbar Example</title>
</head>
<body>

	<div class="container-fluid p-3 header-card">
		
        <!-- Gmail Button -->
		<button class="Gmail">
			<img src="https://i.ibb.co/zWXcWvbF/people.png" class="header-form-img"> Gmail.com
		</button>

        <!-- Navigation Menu -->
     <div class="row justify-content-center">
        <nav class="mt-2 col-auto">
            <ul class="nav nav-tabs d-flex justify-content-center w-100" style="float:none;">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="Homepage.php">Home</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">RESERVATION</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">HOUSEKEEPING</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">CALENDAR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">REPORT</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#employeeModal">Employee</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#roomModal">Assign Room</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#readDataModal">Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Log Out</a>
                </li>
            </ul>
        </nav>
     </div>
	</div><br>

	<div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
          <button type="button" class="btn-custom btn-reservation" id="showBooking"><img src="https://i.ibb.co/8TMf8yW/folder.png">CREATE BOOKING</button>
        </div>
      </div>
      <div id="dashboardContent" class="mt-3"></div>
    </div>
<script>
document.getElementById('showBooking').onclick = function() {
    fetch('BookingForm2.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('dashboardContent').innerHTML = html;
        });
};
document.getElementById('showRoomStatus').onclick = function() {
    fetch('RoomStatus.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('dashboardContent').innerHTML = html;
        });
};
</script>

	<!-- Employee Modal -->
	<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="employeeModalLabel">Employee Form</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="EmployeeProcess.php" method="POST">
						<div class="mb-3">
							<label for="fullname" class="form-label">Full Name</label>
							<input type="text" class="form-control" id="fullname" name="fullname" required>
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" id="email" name="email" required>
						</div>
						<div class="mb-3">
							<label for="contact" class="form-label">Contact</label>
							<input type="text" class="form-control" id="contact" name="contact" required>
						</div>
						<div class="mb-3">
							<label for="position" class="form-label">Position</label>
							<input type="text" class="form-control" id="position" name="position" required>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
						<button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Room Modal -->
	<div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="roomModalLabel">Assign Room</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?php include 'RoomForm.php'; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- ReadData Modal -->
	<div class="modal fade" id="readDataModal" tabindex="-1" aria-labelledby="readDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="readDataModalLabel">Table Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="ReadData.php" style="width:100%;height:70vh;border:none;"></iframe>
            </div>
        </div>
    </div>
</div>

    <!-- <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Booking Source Distribution</h5>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Phone Reservation</span>
                        <span>4</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 40%; background-color: #17a2b8;"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Online</span>
                        <span>6</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 60%; background-color: #17a2b8;"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>E-mail</span>
                        <span>1</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 10%; background-color: #17a2b8;"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Onsite</span>
                        <span>10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%; background-color: #17a2b8;"></div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="dd/mm/yyyy">
                </div>
                <small class="text-muted">*Data shown is based on check-in dates. Only checked-in bookings are recognized.</small>
            </div>
        </div>
    </div> -->

    <!-- <div class="container mt-5">
    <ul class="nav nav-tabs flex-column flex-sm-row">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#arrival">Arrival</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#departure">Departure</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#inHouse">In-House</a>
        </li>
    </ul>

   <div class="tab-content row flex-row flex-wrap" style="background-color: white;">
        <div id="arrival" class="tab-pane col-12 col-sm-4 active show" style="background-color: white;">
            <div class="alert alert-info mt-3" style="background-color: lightgrey; border-color: black;">
                0 guest arriving today
            </div>
            <input type="text" class="form-control date-input" 
                   style="background-color: lightgrey; border-color: black; margin-top: 10px;" 
                   id="arrivalDate" placeholder="dd/mm/yyyy">
        </div>
    
    </div> -->
</div>



    

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SSS Inn</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <style>
    body {
      background: linear-gradient(135deg, #2d224c 0%, #23213a 100%);
      color: #e6e6fa;
      font-family: 'Segoe UI', 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    .header-card {
      background: linear-gradient(90deg, #4b3c6e 0%, #23213a 100%);
      color: #e6e6fa;
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(44, 34, 76, 0.2);
    }

    .fa {
      padding: 15px;
      font-size: 24px;
      width: 40px;
      text-align: center;
      border-radius: 50%;
      margin: 5px;
    }

    .fa-facebook { background: white; color: #3B5998; }
    .fa-twitter { background: white; color: #55ACEE; }
    .fa-google { background: white; color: indianred; }
    .fa-linkedin { background: white; color: #007bb5; }
    .fa-youtube { background: white; color: darkred; }

    img {
      border-radius: 20px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5); /* darker shadow */
    }

    img:hover {
      transform: scale(1.03) translateY(-5px);
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.6);
    }

    .floating-img {
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    .feature-img {
      height: 250px;
      object-fit: cover;
      width: 100%;
    }

    .shadow-deep {
      box-shadow: 0 10px 50px rgba(0, 0, 0, 1) !important;
    }

    .btn-bordered {
      border: 2px solid #ffffff;
      transition: all 0.3s ease;
      background-color: transparent;
    }

    .btn-bordered:hover {
      background-color: #ffffff;
      color: #000000;
      border-color: #ffffff;
    }

    .nav-tabs .nav-link {
      color: #b8a6e8 !important;
      background: transparent;
      border-radius: 12px 12px 0 0;
      margin-right: 8px;
      font-weight: 600;
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
      border-radius: 16px;
      box-shadow: 0 2px 12px rgba(44, 34, 76, 0.15);
      font-weight: 600;
      border: none;
      margin-bottom: 16px;
      transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-custom:hover {
      background: #b8a6e8;
      color: #23213a;
      box-shadow: 0 4px 24px rgba(44, 34, 76, 0.25);
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
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Hotel Management System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto text-center">
        <li class="nav-item"><a class="nav-link" href="GuestForm.php">Book Now</a></li>
          <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
          <li class="nav-item">
            <a class="btn btn-bordered text-white" href="loginn.php">Log in 👥</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="container my-4 text-center">
    <img src="pms.png" class="img-fluid rounded floating-img" alt="Hotel Image">
  </div>

  <!-- Features Section -->
  <div class="container text-center">
    <div class="row g-4">
      <div class="col-md-4 col-sm-6">
        <img src="PMS2.jpeg" class="img-fluid feature-img rounded" alt="Efficiency">
        <h3 class="mt-2">Boost Your Operational Efficiency</h3>
        <p>Manage check-ins, housekeeping, and more from an intuitive dashboard.</p>
      </div>
      <div class="col-md-4 col-sm-6">
        <img src="PMS3.jpg" class="img-fluid feature-img rounded" alt="Ease of Use">
        <h3 class="mt-2">Ease of Use and Training</h3>
        <p>Quick to implement with a user-friendly interface.</p>
      </div>
      <div class="col-md-4 col-sm-12">
        <img src="PMS4.jpg" class="img-fluid feature-img rounded" alt="Support">
        <h3 class="mt-2">24/7 Customer Support</h3>
        <p>Reliable support to keep your business running smoothly.</p>
      </div>
    </div>
  </div>

  <!-- Video & Map Section -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-6 mb-4 mb-md-0">
        <iframe class="w-100 rounded shadow-deep" height="300" src="https://www.youtube.com/embed/9Jz689rY7uo" allowfullscreen></iframe>
      </div>
      <div class="col-md-6">
        <iframe class="w-100 rounded shadow-deep" height="300" src="https://maps.google.com/maps?q=Guinsiliban%20Camiguin&t=&z=14&ie=UTF8&iwloc=B&output=embed"></iframe>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-4">
    <h4>HMS</h4>
    <div>
      <a href="#" class="fa fa-facebook"></a>
      <a href="#" class="fa fa-twitter"></a>
      <a href="#" class="fa fa-google"></a>
      <a href="#" class="fa fa-linkedin"></a>
      <a href="#" class="fa fa-youtube"></a>
    </div>
    <p>Contact Us: +639 65700 980 | SSSInn@outlook.com</p>
    <p>&copy; 2013-2024 SSS Inn. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

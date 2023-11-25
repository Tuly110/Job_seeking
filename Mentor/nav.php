<?php
  session_start();
  include "../Mentor/forms/connect.php";
  // unset($_SESSION['user']);
  $user = !empty($_SESSION['user'])?$_SESSION['user']:'';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto "><a class="text-decoration-none" href="index.html">SEARCH</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="text-decoration-none" href="index.php">Home</a></li>
          <li><a class="text-decoration-none" href="jobs.php">Job</a></li>
          <li><a class="text-decoration-none" href="courses.html">Address</a></li>
          <li><a class="text-decoration-none" href="trainers.html">Profile and CV</a></li>
          <li class="nav-item dropdown pe-3">
            <?php
              if(isset( $_SESSION['user']))
              {  
            ?>
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <span class="d-none d-md-block dropdown-toggle ps-2">
                <?=  $user['email']?>
              </span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li>
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="logout.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Log out</span>
                </a>
              </li>
            </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
        
        <?php } 
        else 
        {?>
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <span class="d-none d-md-block dropdown-toggle ps-2">
                  Register
              </span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li>
                <a class="dropdown-item d-flex align-items-center" href="forms/form_register_user.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Job candidate</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li>
                <a class="dropdown-item d-flex align-items-center" href="forms/form_register_admin.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Employer</span>
                </a>
              </li>
  
            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->
          <li><a href="forms/form_login.php" class="text-decoration-none" >Login</a></li>

        <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
<!-- 
      <a href="courses.html" >Get Started</a> -->

    </div>
</header><!-- End Header -->
</body>
</html>
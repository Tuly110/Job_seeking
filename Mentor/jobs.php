<?php
//   session_start();
//   include "../Mentor/forms/connect.php";
  include "../Mentor/nav.php";

  $error = [];

  $sql_jobs = "SELECT * FROM jobs";
  $request_jobs = mysqli_query($conn,$sql_jobs);
  
  if(isset($_GET['category_id'])){
    $sql_jobs = "SELECT * FROM jobs WHERE id_category = ".$_GET['category_id'];
    $request_jobs = mysqli_query($conn,$sql_jobs);
  }

  if(isset($_GET['search_like'])){
    if(isset($_POST['btn_search'])){
      $input = trim($_POST['job_search']);
      if(!empty($input)){
        $kq = mysqli_query($conn, "SELECT * FROM jobs WHERE Name_Job LIKE '%$input%'");

        if(mysqli_num_rows($kq) <= 0){
          $error['notification'] = '<div class="mt-3 py-2 fw-5 rounded-3 mx-2 text-center" style="background-color: #eee;">
                        The job you are looking for is not available
                    </div>';
        }
      }

    }
  }

  //   phân trang

  $num_page = mysqli_num_rows($request_jobs);
  $limit = 9;
  $total_page = ceil($num_page/$limit);

  $current_page = isset($_GET['page'])?$_GET['page']:1;

  if($current_page > $total_page){
      $current_page = $total_page;
  }else if($current_page < 1){
      $current_page = 1;
  }

  $start = (($current_page -1 )  * $limit);
  
  if(isset($_GET['category_id'])){
    $kq = mysqli_query($conn, "SELECT * FROM jobs WHERE id_category = ".$_GET['category_id']." LIMIT $start,$limit");
  }

  if(!isset($_GET['category_id']) && !isset($_GET['search_like']) || !empty(mysqli_num_rows($kq) <= 0)){
    
      $kq = mysqli_query($conn, "SELECT * FROM jobs LIMIT $start,$limit");
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>JOBS</h2>
        <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">
        <div class="row mb-4">
            <div class=" col-lg-3 col-md-6 d-sm-none d-md-block">
                <form action="jobs.php?search_like" method="post">
                  <div class="w-10 search_jobs">
                    <div>
                      <input type="text" name="job_search" id="" class="w-100 float-end" placeholder="Job Search">
                    </div>
                    <button type="submit" name="btn_search" id="btn_search"><i class="fa-solid fa-magnifying-glass " style="color: darkgray;"></i></button>
                  </div>
                </form>
            </div>
            <div class="col-lg-9 col-md-6 col-sm-12 mt-sm-3 mt-md-0 d-flex justify-content-md-end align-content-center justify-content-sm-center" >
              <div class="search_icon_jobs ">
                <div class="icon icon_prev">
                    <span ><i class="fa-solid fa-chevron-left"></i></span>
                </div>
                <div class="category_search">
                  <div class="slider_category">
                    <?php
                      $request_category = mysqli_query($conn,"SELECT * FROM category");
                      while($rows = mysqli_fetch_array($request_category)){
                    ?>
                      <div class="bussiness py-sm-2 py-md-auto active ">
                        <a href="jobs.php?category_id=<?=$rows['id'] ?>"><?=$rows['category_name']?></a>
                      </div>
                    <?php
                      }
                    ?>
                      
                  </div>
                </div>
              
                <div class="icon icon_next">
                    <span><i class="fa-solid fa-chevron-right"></i></span>
                 </div>
              </div>
            </div>
            <div class="row ">
              <div class="col-lg-4 d-inline-block">
                <?= !empty($error['notification'])?$error['notification']:''  ?>
              </div>
            </div>
        </div>

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          <?php
            while($row_jobs = mysqli_fetch_array($kq)){
            ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch p-2">
                <div class="course-item w-100">
                    <div class="box_jobs">
                      <div class="img_jobs">
                        <img src="../NiceAdmin/assets/img/<?= $row_jobs['image'] ?>" class="img-fluid " alt="...">
                      </div>
                      <div>
                        <div aria-hidden="true" class="course-content">
                            <h3><a href="job_details.php?id_jobs=<?= $row_jobs['id'] ?>"><?= $row_jobs['Name_Job'] ?></a></h3>
                            <h4><?= $row_jobs['Name_company'] ?></h4>
                        </div>
                      </div>
                    </div>
                    <div class="p-2 d-flex justify-content-between">
                        <div class="salary_level"><?= $row_jobs['Salary_Level'] ?></div>
                        <div class = "" style="color: darkgray;">
                          <i class="fa-regular fa-heart"></i>
                        </div>
                    </div>
                </div>
            </div> 
        <?php
            }
          ?>
          
          <!-- End Course Item-->

        </div>
        <div class="row">
            <div class="Paging" id="Paging">
                <?php 

                    if($current_page > 2 && $current_page > 1){
                        $prev = $current_page -1;
                        echo '<a href="jobs.php?page='.$prev.'"><i class="fa-solid fa-angle-left"></i></a>';

                    }

                    if(!empty($total_page)){
                        for ($i=1; $i <= $total_page ; $i++) { 
                            if($i != $current_page){
                                if($i > $current_page -2 && $i < $current_page + 2){
                                    echo '<a href="jobs.php?page='.$i.'">'.$i.'</a>';
                                }
                            }else if($total_page > 1){
                                echo '<a href="jobs.php">'.$i.'</a>';
                            }
                            
                        }
                    }

                    if($current_page < $total_page-1 && $total_page > 1){
                        $next_page = $current_page + 1;
                        echo '<a href="jobs.php?page='.$next_page.'"><i class="fa-solid fa-angle-right"></i></a>';
                    }
                ?>
            </div>
        </div>

      </div>
    </section><!-- End Courses Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Mentor</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Mentor</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/form_login.js"></script>

</body>

</html>
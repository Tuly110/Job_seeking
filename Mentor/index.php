<?php
  // session_start();
  include "../Mentor/forms/connect.php";
  include "../Mentor/nav.php";

  $error = [];
  $sql_category = "SELECT *FROM category";
  $request_category= mysqli_query($conn,$sql_category);

  $kq = mysqli_query($conn, "SELECT * FROM jobs ORDER BY RAND() LIMIT 0,6");

  function category_id($id,$start,$limit,$conn){
    $sql_category = "SELECT * FROM jobs WHERE id_category = $id  ORDER BY RAND() LIMIT $start,$limit";
    $request= mysqli_query($conn,$sql_category);
    return $request;
  }

  if(isset($_GET['category_id'])){
    $kq = category_id($_GET['category_id'],0,6,$conn); 
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
          $kq = mysqli_query($conn, "SELECT * FROM jobs ORDER BY RAND() LIMIT 0,6");
        }
      }

    }
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

  <!-- ======= Header ======= -->


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1 >JOB SEEKING</h1>
      <a href="courses.html" class="btn-get-started">JOB</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"></span>
            <p>Employee</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1" class="purecounter"></span>
            <p>Intern</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1" class="purecounter"></span>
            <p>Manager</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
            <p>CEO</p>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="content col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
            <div class="row w-100">
              <div class="m-auto text-sm-center">
                <div class="my-sm-auto my-md-0">
                  <h3>TOP COMPANIES.</h3>
                  <div class="text-center">
                    <a href="about.html" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-lg-4 col-md-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4  w-100">
                    <div class="icon-box_img">
                      <img class="w-100" src="../NiceAdmin/assets/img/logo_fpt.jpg" alt="">
                    </div>
                    <h4>FPT Software</h4>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4  w-100">
                    <div class="icon-box_img">
                      <img class="w-100" src="../NiceAdmin/assets/img/logo_BIDV.jpg" alt="">
                    </div>
                    <h4>BIDV Bank</h4>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4  w-100">
                    <div class="icon-box_img">
                      <img class="w-100" src="../NiceAdmin/assets/img/logo_bk.png" alt="">
                    </div>
                    <h4 class="">HCM City Polytechnic University</h4>
                  </div>
                </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->



    <!-- ======= Popular Courses Section ======= -->
    <section id="popular-courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="section-title container">
          <div class="row ">
            <h2>JOBS</h2>
            <p>Popular jobs</p>
            <div class="d-flex justify-content-between">
              <div class="d-sm-none d-md-block w-100" style="max-width: 50%;">
                  <form action="index.php?search_like" method="post" class="w-100">
                    <div class="w-100 search_jobs">
                      <div>
                        <input type="text" name="job_search" id="" class="w-100 float-end" placeholder="Job Search">
                      </div>
                      <button type="submit" name="btn_search" id="btn_search"><i class="fa-solid fa-magnifying-glass " style="color: darkgray;"></i></button>
                    </div>
                  </form>
              </div>
              <div class="mt-sm-3 mt-md-0 d-inline-block" >
                <div class="search_icon_jobs ">
                  <div class="icon icon_prev">
                        <span ><i class="fa-solid fa-chevron-left"></i></span>
                    </div>
                  <div class="category_search">
                    <div class="slider_category">
                      <?php
                        while($rows = mysqli_fetch_array($request_category)){
                      ?>
                        <div class="bussiness py-sm-2 py-md-auto active ">
                          <a href="index.php?category_id=<?=$rows['id'] ?>"><?=$rows['category_name']?></a>
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
            </div>
          </div>
          <div class="row d-inline-block">
            <?= !empty($error['notification'])?$error['notification']:''  ?>
          </div>
        </div>
        

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <?php
             
             while($row_jobs = mysqli_fetch_array($kq)){
          ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch p-2 position-relative">
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
                <!-- <div class="jobs_hot">
                  <img class="w-100" src="../NiceAdmin/assets/img/icon-flash.webp" alt="">
                </div> -->
            </div> 
          <?php
             }
          ?>
           <!-- End Course Item-->

        </div>

      </div>
    </section><!-- End Popular Courses Section -->

    <!-- ======= Trainers Section ======= -->
    <section id="trainers" class="trainers">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Walter White</h4>
                <span>Web Development</span>
                <p>
                  Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/trainer-2.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Sarah Jhinson</h4>
                <span>Marketing</span>
                <p>
                  Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/trainer-3.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>William Anderson</h4>
                <span>Content</span>
                <p>
                  Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Trainers Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Address</h3>
            <p>
              480 Tran Dai Nghia <br>
              Ngu Hanh Son, Da Nang<br>
              <strong>Phone:</strong> +84 201103107<br>
              <strong>Email:</strong> LK02@gmail.com<br>
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
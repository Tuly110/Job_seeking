<?php 
// session_start();
    include 'nav_admin.php';
    // include "../Mentor/forms/connect.php";

    include 'sidibar.php';

    $num = 0;
    if(isset($_SESSION['user_admin'])){
      // echo $user['ID']; exit();
      $sql = "SELECT * FROM jobs WHERE id_user =".$user['ID']."";
      $required_job = mysqli_query($conn,$sql);

      //Phân trang
      $num_job = mysqli_num_rows($required_job);
      $limit = 3;
      $total_page = ceil($num_job/$limit);

      $current_page = isset($_GET['page'])?$_GET['page']:1;

      if($current_page > $total_page){
        $current_page = $total_page;
      }else if($current_page < 1){
        $current_page = 1;
      }

      $start = (($current_page-1) * 3);

      $kq = mysqli_query($conn, "SELECT * FROM jobs WHERE id_user =".$user['ID']." LIMIT $start,$limit");

      if(!empty('search_jobs_admin')){
        if(isset($_POST['submit'])){
          echo "SELECT * FROM jobs WHERE id_user = ".$user['ID']." AND Name_Job LIKE '%".$_POST['query']."%'";
          $kq = mysqli_query($conn, "SELECT * FROM jobs WHERE id_user = ".$user['ID']." AND Name_Job LIKE '%".$_POST['query']."%'");

          
        }
      }
    }


?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                <div class="table_job">
                    <div class="thread_job" style="padding: 10px 20px;">
                        <div scope="col" style="text-align: center;">STT</div>
                        <div scope="col" class="hight_job_thread">Job Name</div>
                        <div scope="col" class="hight_job_thread">Company Name</div>
                        <div scope="col" class="hight_job_thread">Salary</div>
                        <div scope="col" class="hight_job_thread">Adress</div>
                        <div scope="col" class="hight_job_thread">Job Description</div>
                        <div scope="col" class="hight_job_thread">Job Requirements</div>
                        <div scope="col" class="hight_job_thread">Job Benefits</div>
                    </div>
                    <div class="tbody_job">
                    <?php 
                        if(!empty($kq)){
                          while($row = mysqli_fetch_array($kq)){
                            $start++
                    ?>
                    <a class= "job_detail" style="padding: 10px 20px;" href="update-inf.php?id_jobs=<?= $row['id'] ?>">
                        <div class="STT" scope="row" style="font-weight: bolder;"><?= $start ?></div>
                        <div class="hight_job"><?= $row['Name_Job'] ?></div>
                        <div class="hight_job"><?= $row['Name_company'] ?></div>
                        <div class="hight_job"><?= $row['Salary_Level'] ?></div>
                        <div class="hight_job"><?= $row['Adress'] ?></div>
                        <div>
                            <div class="hight_job">
                                <?= $row['Job_Description'] ?>
                            </div>
                        </div>

                        <div>
                            <div class="hight_job">
                                <?= $row['Job_Requirement'] ?>
                            </div>
                        </div>
                        <div class="hight_job">
                            <div>
                                <?= $row['Job_Benifits'] ?>
                            </div>    
                        </div>
                    </a>
                    <?php 
                      } 
                    }
                    ?>
                    </div>
                  </div>
              
              <!-- End Table with stripped rows -->

            </div>
          </div>
        </div>
        <div class="Paging" id="Paging">
          <?php
            if(mysqli_num_rows($kq) > 2){
              if(!empty($_SESSION['user_admin'])){
              
                if($current_page > 2 && $total_page > 1){
                  $prev_page = $current_page - 1;
                  echo '<a href="data.php?page='.$prev_page.'"><i class="fa-solid fa-angle-left"></i></a>';
                }
  
                if(!empty($total_page)){
                  
                  for ($i=1; $i <= $total_page; $i++) { 
                    if($i != $current_page){
                      if($i > $current_page -2 && $i < $current_page + 2){
                        echo "<a href='data.php?page=$i'>$i</a>";
                      }
                    }else{
                      echo "<a href='data.php?'>$i</a>";
                    }
                  }
                }
  
                if($current_page < $total_page - 1 && $total_page > 1){{
                  $next_page = $current_page + 1;
                  echo '<a href="data.php?page='.$next_page.'"><i class="fa-solid fa-angle-right"></i></a>';
                }}
              }
            }
          ?>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
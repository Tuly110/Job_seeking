<?php
    ob_start();
    include 'nav_admin.php' ;
    include 'sidibar.php';
    $request = mysqli_query($conn, "SELECT `name`, `sdt`, `apply_time`, `email`, `CV`, `apply_status` FROM `apply`");
?>

<?php 
// session_start();
    include 'nav_admin.php';
    // include "../Mentor/forms/connect.php";

    include 'sidibar.php';

    
    $num = 0;
    if(isset($_SESSION['user_admin'])){
      // echo $user['ID']; exit();
      $sql = "SELECT `name`, `sdt`, `apply_time`, `email`, `CV`, `apply_status` FROM `apply`";
      $required_job = mysqli_query($conn,$sql);

      //Phân trang
      $num_job = mysqli_num_rows($required_job);
      $limit = 6;
      $total_page = ceil($num_job/$limit);

      $current_page = isset($_GET['page'])?$_GET['page']:1;

      if($current_page > $total_page){
        $current_page = $total_page;
      }else if($current_page < 1){
        $current_page = 1;
      }

      $start = (($current_page-1) *  $limit);

      $kq = mysqli_query($conn, "SELECT `id`,`name`, `sdt`, `apply_time`, `email`, `apply_status` 
      FROM `apply`"." LIMIT $start,$limit");
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
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Time </th>
                    <th scope="col">Email adress</th>
                    <th scope="col">Apply status</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                      if(!empty($kq)){
                      while($row = mysqli_fetch_array($kq)){
                        $start++
                    ?>
                  <tr>
                    
                    <th scope="row"><?= $start ?></th>
                    <td ><?= $row['name'] ?></td>
                    <td><?= $row['sdt'] ?></td>
                    <td ><?=  date("Y-m-d H:i:s",$row['apply_time'] ) ?></td>
                    <td><?= $row['email'] ?></td>
                    <td>
                      <?php 
                        if($row['apply_status']==1)
                        {
                      ?>
                          <a href="inf_apply.php?apply_status=0&id_apply=<?= $row['id'] ?>">
                            Processing
                          </a> 
                      <?php 
                        } else
                        {
                            echo "<span style='color:red' >Processed</span>";
                        }
                      ?>
                      
                    </td>
                    </tr>
                    <?php 
                      } 
                    }
                    ?>

                  
                </tbody>
              </table>
               
              
              <!-- End Table with stripped rows -->

            </div>
          </div>
        </div>
        <div class="Paging" id="Paging">
          <?php
            // if(mysqli_num_rows($kq) > 2){
              if(!empty($_SESSION['user_admin'])){
              
                if($current_page > 2 && $total_page > 1){
                  $prev_page = $current_page - 1;
                  echo '<a href="list_apply.php?page='.$prev_page.'"><i class="fa-solid fa-angle-left"></i></a>';
                }
  
                if(!empty($total_page)){
                  
                  for ($i=1; $i <= $total_page; $i++) { 
                    if($i != $current_page){
                      if($i > $current_page -2 && $i < $current_page + 2){
                        echo "<a href='list_apply.php?page=$i'>$i</a>";
                      }
                    }else{
                      echo "<a href='list_apply.php?page=$i'>$i</a>";
                    }
                  }
                }
  
                if($current_page < $total_page - 1 && $total_page > 1){{
                  $next_page = $current_page + 1;
                  echo '<a href="list_apply.php?page='.$next_page.'"><i class="fa-solid fa-angle-right"></i></a>';
                }}
              }
            // }
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
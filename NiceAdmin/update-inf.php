<?php 
// include "../Mentor/forms/connect.php";  
ob_start();
  include 'nav_admin.php' ;
  include 'sidibar.php';
  
  // if(isset($_GET['id_jobs'])){
    $id_jobs = $_GET['id_jobs'];

    $request_update = mysqli_query($conn, "	SELECT * FROM `jobs` WHERE `id`=".$id_jobs );
    $data = mysqli_fetch_assoc($request_update);

    if(isset($_POST['update']))
    {  
        $id_jobs = $_GET['id_jobs'];
        $name_job = trim($_POST['job']);
        $company_job = trim($_POST['company']);
        $salary_job = trim($_POST['salary']);
        $address_job = trim($_POST['address']);
        $job_requirement = trim($_POST['job_requirement']);
        $job_description= trim($_POST['job_description']);
        $tinymce_benifits = trim($_POST['tinymce-editor']);

        $img = $_FILES['fileImg']['name'];
        $image_tmp_name = $_FILES['fileImg']['tmp_name'];

        $update = "UPDATE `jobs` SET  `Name_Job`='$name_job',
                                      `Name_company`='$company_job', `Adress`='$address_job',
                                      `Salary_Level`='$salary_job ', `Job_Description`=' $job_description',
                                      `Job_Requirement`='$job_requirement',`Job_Benifits`='$tinymce_benifits',
                                      `createDate`='".time()."',`image`='".$img."' WHERE `id`=".$id_jobs;

        $result = mysqli_query($conn,$update);
        
        $founder = "/img";
        $element = $founder .basename($image_tmp_name);

        if(!file_exists($element)){
            move_uploaded_file($image_tmp_name, 'assets/img/'.$img);
        }  
        if($result == true)
        {
          header('location:data.php');
        }
    }

    if(isset($_POST['delete']))
    {
      $delete = "DELETE FROM `jobs` WHERE `id`=". $id_jobs;
      $request_delete = mysqli_query($conn, $delete);
      if($request_delete)
      {
        header("location:data.php");
      }

    }
  // }

  ob_end_flush();
  
?>

<form action="update-inf.php?id_jobs=<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
  <main id="main" class="main">
<!-- TIÊU ĐỀ -->
    <div class="pagetitle">
      
      <h1>Update information</h1>
      <nav>
        <!-- <a href=""></a> -->
      </nav>
    </div><!-- End Page Title -->
<!-- <a href=""></a> -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body p-2">
              <h5 class="card-title">Job requirements</h5>
              

              <!-- Quill Editor Default -->
              <textarea class="Job_requirements" id="Job_requirements"  name="job_requirement" value="">
                <?= $data['Job_Requirement'] ?>
              </textarea>
              <!-- End Quill Editor Default -->

            </div>
          </div>

          <div class="card ">
            <div class="card-body p-2">
              <h5 class="card-title ">Information</h5>

              <!-- Quill Editor Bubble -->
              <table>
                <tr >
                    <td class="card-title">Job:</td>
                    <td>
                        <input type="text" name="job" value="<?= $data['Name_Job'] ?>">
                    </td>
                </tr>
                <tr >
                    <td class="card-title">Company:</td>
                    <td>
                        <input type="text" name="company" value="<?= $data['Name_company'] ?>">
                    </td>
                </tr>
                <tr >
                    <td class="card-title">Salary:</td>
                    <td>
                        <input type="text" name="salary" value="<?= $data['Salary_Level'] ?>">
                    </td>
                </tr>
                <tr >
                    <td class="card-title">Address:</td>
                    <td>
                        <input type="text" name="address" value="<?= $data['Adress'] ?>">
                    </td>
                </tr>
            </table>
              <!-- End Quill Editor Bubble -->

            </div>
          </div>

          <div class="card p-2">
            <div class="card-body ">
              <h5 class="card-title ">Job description</h5>

              <textarea  id="job_description" name="job_description" value="">
                <?= $data['Job_Description'] ?>  
              </textarea>
              <!-- End Quill Editor Full -->

            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body card_image p-2">
              <h5 class="card-title">Update Image Company</h5>

              <!-- Quill Editor Default -->
              <div class="into-image">
                  <!-- <input type="file"  name="hinhanh"> -->
                  <input type="hidden" name="id" id="" value = "">
                  <div class=upload>
                      <img src="./assets/img/Choose_Image.jpg<?= $data['image'] ?>" id="image" alt="">
                      
                      <div class="rightRound" id="upload">
                          <input type="file" name="fileImg" id="fileImg"  >
                          <!-- <span class='fa'>+</span> -->
                      </div>
                  </div>
                  
              </div>
              <!-- End Quill Editor Default -->

            </div>
          </div>
          <div class="card">
            <div class="card-body p-2">
              <h5 class="card-title ">Job benifits</h5>

               <!-- TinyMCE Editor -->
               <textarea class="tinymce-editor" name="tinymce-editor" value="">
                <?= $data['Job_Benifits'] ?>
               </textarea><!-- End TinyMCE Editor -->

            </div>
          </div>
            <div class="btn border-0" id="btn_job">
              <button type="submit" id="btn_submit" name="update">Update</button>
              <!-- <button type="submit" id="btn_submit" name="update">Update</button> -->
            </div>
            <div class="btn border-0" id="btn_job">
              <button type="submit" id="btn_submit" name="delete">Delete</button>
            </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
</form>

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
  <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>


<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<!-- <script src="assets/vendor/ckeditor5-40.0.0-e3m34ynynuma/build/ckeditor.js"></script> -->
<script src="assets/js/add_info.js"></script>


</body>

</html>
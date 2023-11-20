<?php 
ob_start();
  include 'nav_admin.php' ;
  include 'sidibar.php';

?>
<?php
    // include '../../Mentor/forms/connect.php';

    $error = [];
    $required_fields = ['job','company','salary', 'address', 'job_requirement', 'job_description','tinymce-editor','professions'];

    if(isset($_POST['btn_submit'])){
        $name_job = trim($_POST['job']);
        $company_job = trim($_POST['company']);
        $salary_job = trim($_POST['salary']);
        $address_job = trim($_POST['address']);
        $job_requirement = trim($_POST['job_requirement']);
        $job_description= trim($_POST['job_description']);
        $tinymce_benifits = trim($_POST['tinymce-editor']);
        $id_category = trim($_POST['professions']);
        // Image
        $image_company =$_FILES['fileImg']['name'];;
        $image_tmp_name = $_FILES['fileImg']['tmp_name'];

        foreach ($required_fields as $value) {
            if(empty($_POST[$value])){
                $error[$value] = "Not be empty!";
            }
          }

        if(empty($image_company = $_FILES['fileImg']['name'])){
          $error['fileImage'] = "Not be empty!";
        }


        if(empty($error)){
            $sql = "INSERT INTO `jobs`(`id_user`, `Name_Job`, `Name_company`, `Adress`, `Salary_Level`, `Job_Description`, `Job_Requirement`, `Job_Benifits`, `createDate`,`image`,`id_category`) 
                                VALUES ('".$user['ID']."','$name_job','$company_job','$address_job','$salary_job','$job_description','$job_requirement','$tinymce_benifits', '".time()."','$image_company','$id_category')";

            mysqli_query($conn,$sql);

            $founder = "/img";
            $element = $founder .basename($image_tmp_name);

            if(! file_exists($element)){
              move_uploaded_file($image_tmp_name, 'assets/img/'.$image_company);
            }
              header('location:data.php');

        }

    }


?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add information</h1>
      <nav>
        <!-- <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Editors</li>
        </ol> -->
      </nav>
    </div><!-- End Page Title -->

    <section class="section" id="session_add">
      <form action="add_inf.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-6 ">

            <div class="card">
              <div class="card-body p-2">
                <h5 class="card-title">Job Requirements <span style="color: red;"><?= !empty($error['job_requirement'])?$error['job_requirement']:''  ?></span></h5>

                <!-- Quill Editor Default -->
                <textarea class="Job_requirements" id="Job_requirements"  name="job_requirement">
                </textarea>
                <!-- End Quill Editor Default -->

              </div>
            </div>

            <div class="card">
              <div class="card-body p-2">
                <h5 class="card-title">Information</h5>

                <!-- Quill Editor Bubble -->
                <table>
                  <tr>
                      <td> <span style="color:red"><?= !empty($error['job'])?$error['job']:''?></span> </td>
                  </tr>
                  <tr >
                      <td class="card-title">Job:</td>
                      <td>
                          <input type="text" name="job">
                      </td>
                  </tr>
                  <tr>
                      <td> <span style="color:red"><?= !empty($error['job'])?$error['company']:''?></span> </td>
                  </tr>
                  <tr >
                      <td class="card-title">Company:</td>
                      <td>
                          <input type="text" name="company">
                      </td>
                  </tr>
                  <tr>
                      <td> <span style="color:red"><?= !empty($error['job'])?$error['salary']:''?></span> </td>
                  </tr>
                  <tr >
                      <td class="card-title">Salary:</td>
                      <td>
                          <input type="text" name="salary">
                      </td>
                  </tr>
                  <tr>
                      <td> <span style="color:red"><?= !empty($error['job'])?$error['address']:''?></span> </td>
                  </tr>
                  <tr >
                      <td class="card-title">Address:</td>
                      <td>
                          <input type="text" name="address">
                      </td>
                  </tr>
                  <tr >
                      <td class="card-title">Professions:</td>
                      <td>
                          <select name="professions" id="professions">
                            <option value="1" name ="">Business/Sales</option>
                            <option value="2">IT Software</option>
                            <option value="3">Education / Training</option>
                            <option value="4">Marketing / Communications</option>
                            <option value="5">Administration / Office</option>
                          </select>
                      </td>
                  </tr>
              </table>
                <!-- End Quill Editor Bubble -->

              </div>
            </div>

            <div class="card">
              <div class="card-body p-2">
                <h5 class="card-title">Job Description <span style="color: red;"><?= !empty($error['job_description'])?$error['job_description']:''  ?></span></h5>

                <textarea  id="job_description" name="job_description">
                
                </textarea>
                <!-- End Quill Editor Full -->

              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <div class="card">
                <div class="card-body card_image p-2">
                  <h5 class="card-title">Update Image Company <span style="color: red;"><?= !empty($error['fileImage'])?$error['fileImage']:''  ?></span></h5>

                  <!-- Quill Editor Default -->
                  <div class="into-image">
                      <!-- <input type="file"  name="hinhanh"> -->
                      <input type="hidden" name="id" id="" value = "<?php !empty($_SESSION['user_admin'])?$user['ID']:'' ?>)">
                      <div class=upload>
                          <img src="assets/img/Choose_Image.jpg" id="image" alt="">

                          <div class="rightRound" id="upload">
                              <input type="file" name="fileImg" id="fileImg" accept=".jpg, .jpeg, .png">
                              <!-- <span class='fa'>+</span> -->
                          </div>
                      </div>
                      
                  </div>
                  <!-- End Quill Editor Default -->

                </div>
              </div>

            <div class="card">
              <div class="card-body p-2">
                <h5 class="card-title">Job Benifits <span style="color: red;"><?= !empty($error['tinymce-editor'])?$error['tinymce-editor']:''  ?></span></h5>

                <!-- TinyMCE Editor -->
                <textarea class="tinymce-editor" name="tinymce-editor">
                </textarea><!-- End TinyMCE Editor -->

              </div>
            </div>
            <div class="btn border-0" id="btn_job">
              <button type="submit" id="btn_submit" name="btn_submit">Submit</button>
            </div>

          </div>
        </div>
      </form>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <scrip src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

<?php ob_end_flush();?>
</body>

</html>
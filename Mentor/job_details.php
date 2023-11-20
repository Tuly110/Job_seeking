<?php
    session_start();
    include "./forms/connect.php";
    // include "../Mentor/nav.php";
    $job_details = mysqli_query($conn, "SELECT * FROM `jobs` WHERE `id`=".$_GET['id_jobs']);
    $row= mysqli_fetch_assoc($job_details);
    $user = !empty($_SESSION['user'])?$_SESSION['user']:'';

    $id_job=$_GET['id_jobs'];
    $request_apply = mysqli_query($conn, "SELECT * FROM `jobs` WHERE `id`=".$_GET['id_jobs']);
    $data= mysqli_fetch_assoc($request_apply);
    $err='';
    if(isset($_POST['finish']))
    {
        if(empty($_POST['name']) ||empty($_POST['email'])||empty($_POST['sdt']) )
        {
            $err="Please fill in all information!";
        }
        else
        {
            $cv = $_FILES['CV']['name'];
            // echo $cv; exit();
            // Lấy dường dẫn hình ảnh
            $cv_tmp_name = $_FILES['CV']['tmp_name'];
            move_uploaded_file($cv_tmp_name, '../Mentor/assets/CV/'.$cv);
            $name= $_POST['name'];
            $email=$_POST['email'];
            $sdt=$_POST['sdt'];
            // echo "INSERT INTO `apply`( `id_job`, `id_user`, `name`, `sdt`, `apply_time`, `email`)
            // VALUES (' $id_job','".$user['ID']."','$name',' $sdt','".time()."',' $email')"; exit();
            $finish = mysqli_query($conn, "INSERT INTO `apply`( `id_job`, `id_user`, `name`, `sdt`, `apply_time`, `email`, `CV`)
             VALUES (' $id_job','".$user['ID']."','$name',' $sdt','".time()."',' $email', '$cv ')");
            if($finish)
            {
                header("location:../Mentor/index.php");
            }
        }
        
    }

?>
<!doctype html>
<html lang="en">
    <!-- <a href="../Mentor/index.php"></a> -->
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <a href="./forms/form_login.php"></a> -->
    <link rel="stylesheet" href="./assets/css/style_apply.css">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Chi tiết công việc</title>
  </head>
  <body class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <div style="margin-top: 100px;" class="row ">
            <!-- <h1>CHI TIẾT CÔNG VIỆC</h1> -->
            <div class=" inf col-md-7 col-sm-12">
                <div class="job_name d-flex justify-content-evenly mb-2">
                    <h3 class="text-success"><?= $row['Name_Job'] ?></h3>
                </div>
                <div class="mo_ta d-flex justify-content-around">
                    <div class="img_jobs">
                        <img src="../NiceAdmin/assets/img/<?php echo $row['image']  ?>" alt="" width="100px" height="100px">
                    </div> 
                    <div class="salary d-flex justify-content-between">
                        <span class="icon_details" style="margin-right: 10px;"><i class="fa-solid fa-comments-dollar text-white"></i></span>
                        <div class="luong d-flex flex-column bd-highlight mb-3">
                            <b>Mức lương:</b>
                            <?= $row['Salary_Level'] ?>
                        </div>    
                    </div>
                    <div class="address d-flex justify-content-between">
                        <span class="icon_address" style="margin-right: 10px;"><i class="fa-solid fa-location-dot text-white"></i></span>
                        <div class="luong d-flex flex-column bd-highlight mb-3">
                            <b> Địa chỉ:</b>
                            <?= $row['Adress'] ?>
                        </div>    
                    </div>               
                </div>
                <div class="ung_tuyen d-flex justify-content-center">
                    <button type="button" class="submit" value="Apply now" name="apply" data-bs-toggle="modal" data-bs-target="#modalId">
                        Apply now
                    </button>
                    <!-- <input class="submit" type="submit" value="Apply now" name="apply" data-bs-toggle="modal" data-bs-target="#modalId" > -->
                </div>
                
                
                <!-- Modal Body -->
                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <h4>Apply to <span class="text-success"><?= $data['Name_Job']?></span></h4>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                
                            </div>
                            
                            <div class="modal-body">
                                <div >
                                    <div class="">
                                        <i class="fa-solid fa-camera text-success mb-4"></i> Choose CV to upload
                                    </div>
                                    <form action="job_details.php" method="POST">
                                        <div class="table">
                                            <div class="upload">
                                                <div>
                                                    <i class="fa-solid fa-cloud-arrow-up text-success"></i>
                                                    Upload CV from your computer or drag and drop
                                                </div>
                                                <div>          
                                                    <input class="d-flex justify-content-center" type="file" value="Upload here" name="CV">
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="if_details">
                                            <b class="text-success"> Enter detailed information: </b>
                                                <div class="name">   
                                                    <span class="err">*<?= $err; ?></span>                   
                                                    <input class="input" type="text" name="name" placeholder="Enter your name">
                                                </div>
                                                <div class="email">
                                                    <span class="err">*<?= $err; ?></span>  
                                                    <input class="input" type="email" name="email" placeholder="Enter your email">
                                                </div>
                                                <div class="email">
                                                    <span class="err">*<?= $err; ?></span>  
                                                    <input class="input" type="text" name="sdt" placeholder="Enter your phone number">
                                                </div>
                                            </div>
                                            <div class=" d-flex justify-content-center">
                                                <input type="submit" class= " mt-4 finish " value="Apply" name="finish">
                                            </div>
                                    
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 
            </div>  
            <div class=" company col-md-4 col-sm-12">
                <div class="d-flex justify-content-between">
                    <div class="img_jobs">
                        <img style="margin-right: 20px;" src="../NiceAdmin/assets/img/<?php echo $row['image']  ?>" alt="" width="100px" height="100px">
                    </div> 
                    <div class="company_name">
                        <h4 class="text-success"> <?= $row['Name_company'] ?></h4>
                    
                    </div>
                </div>
                <div>
                    <b>Địa chỉ làm việc: </b><?= $row['Adress'] ?>
                </div>
            </div>
            <div class=" inf col-md-7 col-sm-12 mt-3">
                <h2>Yêu cầu công việc</h2>
                <div class="mota mb-2">
                    <b>Mô tả công việc:</b><?= $row['Job_Description'] ?>
                </div>
                <!-- <div class="yeucau d-flex justify-content-between"> -->
                <div class="yeucau">
                    <b>Yêu cầu:</b><?= $row['Job_Requirement'] ?>
                </div> 
                <div class="loiich">
                    <b>Lợi ích:</b><?= $row['Job_Benifits'] ?>
                </div>
                <div class="noi_lam">
                    <b>Địa điểm làm việc: </b> <?= $row['Adress'] ?>
                </div>
            </div>
            <div class=" company col-md-4 col-sm-12 mt-3">
                <div class="warning">
                    <i style="font-size: 20px;" class="fa-solid fa-triangle-exclamation text-danger"></i>
                    <span style="color: red;text-shadow: 1px 1px 50px pink, 0 0 25px pink, 0 0 5px red; font-size: 20px;"><b>Warning:</b> <br>Job seeking LK</span>
                    <div class="text">
                    Advises all of you to always be careful during the job search process and proactively
                    research company information and job positions before applying.
                    Candidates need to be responsible for their application behavior.
                    If you encounter recruitment news or receive suspicious contact from an employer,
                    please immediately report <a href="#">Jobseeking2LK@gmail.com</a> to us via email for timely support.
                    </div>
                </div>
                <a></a>
            </div>
        </div>
    </form>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>
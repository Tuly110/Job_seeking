<?php
    // session_start();
    include "./forms/connect.php";
    include "../Mentor/nav.php";

    $user = !empty($_SESSION['user'])?$_SESSION['user']:'';

    // số lượt like
    function getLikes($comment_id){
        global $conn;

        $sql = "SELECT COUNT(*) FROM rating_info
                WHERE comment_id = $comment_id AND rating_action = 'like'";

        $res = mysqli_query($conn,$sql);
        $result = mysqli_fetch_array($res);

        return $result[0];
    }

    // số lượt dislike
    function getDisLikes($comment_id){
        global $conn;

        $sql = "SELECT COUNT(*) FROM rating_info
                WHERE comment_id = $comment_id AND rating_action = 'dislike'";

        $res = mysqli_query($conn,$sql);
        $result = mysqli_fetch_array($res);
        
        return $result[0];
    }

    // Kiểm tra người dùng thật sự tồn tại để post hay ko
    function userLiked($comment_id){
        global $conn;
        global $user;

        $user_id = isset($user['ID'])?$user['ID']:'0';

        $sql = "SELECT *FROM rating_info 
                WHERE user_id = ".$user_id ." AND comment_id = $comment_id AND rating_action = 'like'";
        
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    function userDisLiked($comment_id){
        global $conn;
        global $user;

        $user_id = isset($user['ID'])?$user['ID']:'0';

        $sql = "SELECT *FROM rating_info 
                WHERE user_id = ".$user_id." AND comment_id = $comment_id AND rating_action = 'dislike'";
        
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    $job_details = mysqli_query($conn, "SELECT * FROM `jobs` WHERE `id`=".$_GET['id_jobs']);
    $row= mysqli_fetch_assoc($job_details);

    $sql_comment = 'SELECT comments.*, user.name
                    FROM comments INNER JOIN user
                    ON comments.id_user = user.ID
                    WHERE comments.id_jobs ='.$_GET['id_jobs'];
    $request_comments = mysqli_query($conn,$sql_comment);



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/style_apply.css">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Chi tiết công việc</title>
  </head>
  <body>
    <!-- <form action="" method="POST" enctype="multipart/form-data"> -->
    <div class="container-lg container-fluid">
        <div style="margin-top: 100px;" class="row">
            <!-- <h1>CHI TIẾT CÔNG VIỆC</h1> -->
            <div class="inf col-lg-7 col-md-12 col-sm-12">
                <div class="job_name d-flex justify-content-evenly mb-2">
                    <h3 class="text-success"><?= $row['Name_Job'] ?></h3>
                </div>
                <div class="mo_ta d-md-flex justify-content-between align-items-center d-sm-block">
                    <div class="img_jobs d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; margin: auto;" >
                        <div class="w-100 d-md-block">
                            <img class="w-100 m-auto" src="../NiceAdmin/assets/img/<?php echo $row['image']  ?>" alt="" >
                        </div>
                    </div> 
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="salary">
                            <div class="w-100  d-flex justify-content-md-between justify-content-sm-center align-items-center">
                                <span class="icon_details" style="margin-right: 10px;"><i class="fa-solid fa-comments-dollar text-white"></i></span>
                                <div class="luong d-flex flex-column bd-highlight mb-3">
                                    <b>Salary Level:</b>
                                    <?= $row['Salary_Level'] ?>
                                </div> 
                            </div>   
                        </div>
                        <div class="address ">
                            <div class="w-100  d-flex justify-content-md-between justify-content-sm-center align-items-center">
                                <span class="icon_address" style="margin-right: 10px;"><i class="fa-solid fa-location-dot text-white"></i></span>
                                <div class="luong d-flex flex-column bd-highlight mb-3">
                                    <b>Address:</b>
                                <h6> <?= $row['Adress'] ?></h6>
                                </div> 
                            </div>   
                        </div> 
                    </div>              
                </div>
                <div class="ung_tuyen d-flex justify-content-center">

                    <button type="button" class="submit text-white fw-0" value="Apply now" name="apply" data-bs-toggle="modal" data-bs-target="#modalId">
                        <i class="fa-regular fa-paper-plane"></i> Apply now
                    </button>
                    
                    <!-- <input class="submit" type="submit" value="Apply now" name="apply" data-bs-toggle="modal" data-bs-target="#modalId" > -->
                </div>
                
                
                <!-- Modal Body -->
                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <h4>Apply to <span class="text-success"><?= $row['Name_Job']?></span></h4>

                                <button type="button" class="btn-close border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                                    <!-- <i class="fa-solid fa-xmark"></i> -->
                                </button>
                                
                            </div>
                            
                            <div class="modal-body">
                                <div >
                                    <div class="">
                                        <i clasclasss="fa-solid fa-camera text-success mb-4"></i> Choose CV to upload
                                    </div>
                                    <form class="form_job_detail" action="" enctype="multipart/form-data">
                                        <div class="table">
                                            <div class="upload">
                                                <div>
                                                    <i class="fa-solid fa-cloud-arrow-up text-success"></i>
                                                    Upload CV from your computer or drag and drop
                                                </div>
                                                <div>          
                                                    <input class="d-flex justify-content-center" type="file" value="Upload here" name="CV" id='CV'>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="if_details">
                                            <b class="text-success"> Enter detailed information: </b>
                                                <input type="hidden" name="id_jobs" id="id_jobs" value="<?=$_GET['id_jobs']  ?>">
                                                <div class="name">   
                                                    <span class="err text-danger">*</span>                   
                                                    <input class="input form_job_input" value=""  type="text" name="name" placeholder="Enter your name">
                                                </div>
                                                <div class="email">
                                                    <span class="err text-danger">*</span>  
                                                    <input class="input form_job_input" value="" type="email" name="email" placeholder="Enter your email">
                                                </div>
                                                <div class="email">
                                                    <span class="err text-danger">*</span>  
                                                    <input class="input form_job_input" value="" type="text" name="sdt" placeholder="Enter your phone number">
                                                </div>
                                            </div>
                                            <div class=" d-flex justify-content-center">
                                                <input type="submit" class= "mt-4 finish text-center" value="Apply" id="btn_appy"  name="finish">
                                            </div>
                                    
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="company col-lg-4 col-md-12 col-sm-12 mt-lg-0 ms-lg-3 mt-md-3 ms-md-0 ms-sm-0 mt-sm-3" style="margin-top: 10px;">
                <div class="w-100">
                    <div class="d-flex ">
                        <div class="img_jobs_apply">
                            <img class="border border-1 p-1" style="margin-right: 20px;" src="../NiceAdmin/assets/img/<?php echo $row['image']  ?>" alt="">
                        </div> 
                        <div class="company_name ms-3 mt-3 text-success">
                            <h4 style="font-weight: 600;"  class=""><?= $row['Name_company'] ?></h4>
                        
                        </div>
                    </div>
                    <div>
                        <b>Business Address: </b><?= $row['Adress'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="inf col-md-7 col-sm-12 mt-3">
                <div class="row">
                    <div class="col-12">
                        <h2>Job Requirements</h2>
                        <div class="mota mb-2">
                            <b>Job Description:</b><?= $row['Job_Description'] ?>
                        </div>
                        <!-- <div class="yeucau d-flex justify-content-between"> -->
                        <div class="yeucau">
                            <b>Request:</b><?= $row['Job_Requirement'] ?>
                        </div> 
                        <div class="loiich">
                            <b>Benefit:</b><?= $row['Job_Benifits'] ?>
                        </div>
                        <div class="noi_lam">
                            <b>Business Address: </b> <?= $row['Adress'] ?>
                        </div>
                    </div>
                    <div class="comment col-12 mt-5">
                        <h5 class=" mb-4 "><i class="fa-regular fa-comment "></i> Comments</h5>
                        <div class="input_comments">
                            <input type="text" name="enter_comment" id="enter_comment" class="enter_comment"  placeholder="Enter comments...">
                            <input type="hidden" name="" id="nick_name" value="<?=!empty($user['name'] )?$user['name'] :'' ?>">
                            <!-- <input type="submit" name="Send" id="btn_send_coment"> -->
                            <div class="under_coment"></div>
                        </div>
                        <div class="show_comments ms-3">
                        <?php 
                            while($post_comment = mysqli_fetch_array($request_comments)){
                        ?>
                                <div class="comments_user mt-3">
                                    <div class="user_info">
                                        <input type="hidden" name="" id="id_comment" class="id_comment" value="<?= $post_comment['id']  ?>">
                                        <span class="span_name fw-bold"><?=$post_comment['name']?></span>
                                        <small><?= $post_comment['create_time'] ?></small>
                                    </div>
                                    <div class="user_content my-2">
                                        <label style="text-indent: 10px;"><?= $post_comment['comment'] ?></label>
                                    </div>
                                    <div class="like_or_dislike">
                                        <div class="post-info">
                                            <!-- if user likes post, style button differently -->
                                            <i <?php if (userLiked($post_comment['id'])){ ?>
                                                    class="fa-solid fa-thumbs-up like-btn"
                                            <?php }else{ ?>
                                                    class="fa-regular fa-thumbs-up like-btn"
                                            <?php } ?>
                                            data-id="<?php echo $post_comment['id'] ?>"></i>
                                            <span class="num_likes"><?php echo getLikes($post_comment['id']); ?></span>
                                            
                                            &nbsp;&nbsp;&nbsp;&nbsp;

                                                <!-- if user dislikes post, style button differently -->
                                            <i 
                                            <?php if (userDisliked($post_comment['id'])){ ?>
                                                    class="fa-solid fa-thumbs-down dislike-btn"
                                            <?php }else{ ?>
                                                    class="fa-regular fa-thumbs-down dislike-btn"
                                            <?php } ?>
                                            data-id="<?php echo $post_comment['id'] ?>"></i>
                                            <span class="num_dislikes"><?php echo getDislikes($post_comment['id']); ?></span>
                                        </div> 
                                          
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="company col-md-4 col-sm-12 mt-3 ms-sm-0 ms-md-3">
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
    </div>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>        
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/job_detail.js"></script>

  </body>
</html>
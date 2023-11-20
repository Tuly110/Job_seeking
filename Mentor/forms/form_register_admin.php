<?php
    session_start();
    include "connect.php";
    $nameE = $mailE = $sdtE = $passE = $passAGE = $passErr = $name_ctyE = $vitriE = $noilamE =$gender_E='';
    $notification = '';
    if(isset($_POST['dang_ki']))
    {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $pass = trim($_POST['pass']);
        $passAG = trim($_POST['passAG']);
        $name_cty = trim($_POST['ten_cty']);
        $sdt = trim($_POST['sdt']);  
        $vitri = trim($_POST['vi_tri']);
        $noilam = trim($_POST['noi_lam']);
        // name
        if (empty($_POST['name']))
        {
            $nameE=' Not be empty!';
        }
        else
        {
            $name = trim($_POST['name']);           
        }
        // mail
        if (empty($_POST['email']))
        {
            $mailE= 'Not be empty!';
        }
        else
        {
            $email = trim($_POST['email']);
        }
        // pass
        if (empty($_POST['pass']))
        {
            $passE= 'Not be empty!';
        }
        else
        {
            $pass = trim($_POST['pass']);
        } 
        // pass again
        if (empty($_POST['passAG']))
        {
            $passAGE= 'Not be empty!';
        }
        else
        {
            $passAG = trim($_POST['passAG']);
        } 
        // so sánh 2 pass word
        if($pass != trim( $passAG) )
        {
            $passErr="Mật khẩu nhập lại không đúng!";
        }
        // name of company
        if (empty($_POST['ten_cty']))
        {
            $name_ctyE= 'Not be empty!';
        }
        else
        {
            $name_cty = trim($_POST['ten_cty']);
        } 
         // vị trí làm
         if (empty($_POST['vi_tri'])) {
            $vitriE = 'Not be empty!';

        } else {
            $vitri = trim($_POST['vi_tri']);
            echo $vitri; // Display the trimmed input
        }
          // nơi làm
        if (empty($_POST['noi_lam']))
        {
            $noilamE= 'Not be empty!';
        }
        else
        {
            $noilam = trim($_POST['noi_lam']);
        } 
        // sdt
        if (empty($_POST['sdt']))
        {
            $sdtE= 'Not be empty!';
        }
        else
        {
            $sdt = trim($_POST['sdt']);
        } 
        // gender
        if (empty($_POST['gender']))
        {
            $gender_E= 'Not be empty!';
        }
        else
        {
            $gender = trim($_POST['gender']);
        } 


        if(empty( $nameE || $mailE || $sdtE || $passE || $passAGE || $passErr || $name_ctyE || $vitriE || $noilamE))
        {
            $pass_admin = password_hash($pass,INPUT_POST);
            
            $sql_email= "SELECT * FROM user WHERE email ='".$email."'";
            $request_email_user = mysqli_query($conn,$sql_email);

            if(mysqli_num_rows($request_email_user) == 1){
                $notification = '* Account already exists';

            }else{
                $sql =" INSERT INTO `user`(`ID`, `name`, `email`, `sdt`, `password`, `ten_cty`, `vi_tri`, `noi_lam`, `role`)
                VALUES (NULL,'$name','$email','$sdt','$pass_admin','$name_cty','$vitri',' $noilam','admin');";
                $query = mysqli_query($conn,$sql);  
                if($query)
                {
                    header("location:form_login.php");
                }
            }
        }
    }   


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style_form_admin.css">
<title>Title</title>
</head>
<body>
    <form action="form_register_admin.php" method="POST">
    <div class="form_register_admin w-100">
        <div class="w-100">
            <form action="">
                <div class="con_admin container">
                    <div class="py-3" style="margin-left: 50px; ">
                        <h3 class="fw-bold" style="color: #203d6e" >Register for a Employer Account</h3>
                        <p class="ps-3" style="color: red;"><?= $notification ?></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 form_left-input border-end pe-5">
                            <div>
                                <h3 class="fw-bold ps-2" style="color: #203d6e; border-left:5px solid #203d6e ;">Account</h3>
                                <div class="form_field">
                                    <div class="row">
                                        <div class="col-lg-7 col-sm-12 float-sm-start">
                                            <label  class="form_lable" for="">Username <span class="text-danger">*
                                                <?= $nameE;  ?>
                                            </span> </label>
                                            <div class="form-input-two">
                                                <label for=""><i class="fa-regular fa-user"></i></label>
                                                <input type="text" class="form_input" name="name" id="" placeholder="Username">
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-5 col-sm-12">
                                            <label for="" class="form_lable">Gender <span class="text-danger">*
                                                <?= $gender_E ?>
                                            </span> </label>
                                            <div class="d-flex justify-content-between  py-2 align-items-center">
                                                <div>
                                                    <input type="radio" name="gender" id=""> <label for="">Male</label>
                                                </div>
                                               <div>
                                                <input type="radio" name="gender" class=""> <label for="">Female</label>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_field">
                                    <label  class="form_lable" for="">E-mail <span class="text-danger">*
                                        <?= $mailE; ?>
                                    </span> </label>
                                    <div class="form-input-two">
                                        <label for=""><i class="fa-regular fa-envelope"></i></label>
                                        <input type="email" class="form_input" name="email" id="" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="form_field">
                                    <label  class="form_lable" for="">Password <span class="text-danger">*
                                        <?= $passE; ?>
                                    </span> </label>
                                    <div class="form-input-two">
                                        <label for=""><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form_input" name="pass" id="" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form_field">
                                    <label  class="form_lable" for="">Password again <span class="text-danger">*
                                        <?= $passAGE; $passErr ?>
                                    </span> </label>
                                    <div class="form-input-two">
                                        <label for=""><i class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form_input" name="passAG" id="" placeholder="Enter the password">
                                    </div>
                                </div>
      
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form_right-input " style="padding-right: 50px;">
                            <div>
                                <h3 class="fw-bold ps-2" style="color: #203d6e; border-left:5px solid #203d6e ;">Employer Information</h3>
                                <div class="form_field">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label  class="form_lable" for="">Company name<span class="text-danger">*
                                                <?= $name_ctyE ?>
                                            </span> </label>
                                            <div class="form-input-two">
                                                <label for=""><i class="fa-regular fa-building"></i></label>
                                                <input type="text" class="form_input" name="ten_cty" id="" placeholder="Company name">
                                            </div>
                                            <small class="small_under"></small>
                                        </div>
                                        <div class="col-lg-6">
                                            <label  class="form_lable" for="">Phone Number<span class="text-danger">*
                                                <?= $sdtE ?>
                                            </span> </label>
                                            <div class="form-input-two">
                                                <label for=""><i class="fa-solid fa-phone"></i></label>
                                                <input type="text" class="form_input" name="sdt" id="" placeholder="Phone Number">
                                            </div>
                                            <small class="small_under"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_field">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label  class="form_lable" for="">Position<span class="text-danger">*
                                                <?= $vitriE ?>
                                            </span> </label>
                                            <div class="select_form">
                                                <select name="vi_tri" id="vi_tri" class=" w-100">
                                                    <option value=""></option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="CEO">CEO</option>
                                                    <option value="Deputy director">Deputy director</option>
                                                </select>
                                            </div>
                                            <small class="small_under"></small>
                                        </div>
                                        <div class="col-lg-6">
                                            <label  class="form_lable" for="">Work location<span class="text-danger">*
                                                <?= $noilamE ?>
                                            </span> </label>
                                            <div class="form-input-two">
                                                <label for=""><i class="fa-solid fa-map-location-dot"></i></label>
                                                <input type="text" class="form_input" name="noi_lam" id="" placeholder="Work location">
                                            </div>
                                            <small class="small_under"></small>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form_field check_box_field">
                                    <input type="checkbox" name="" id="" checked>
                                    <label for="">I agree with you <span class="dieukhoan">Terms of Service </span> of LK</label>
                                </div>

                                <div class="w-100">
                                    <input class="btn_dangki" type="submit" name="dang_ki" value="Register">
                                </div>
                                <div class="changer-page d-flex justify-content-between w-100">
                                    <span style="color: #999;">Do you already have an account ?</span>
                                    <a href="form_login.php" class="link">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </form>
</body>
</html>
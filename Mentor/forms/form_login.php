<?php 
    session_start();
    include 'connect.php';
    
    $error = [];
    if(isset($_POST['login'])){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if(empty($email) && empty($password)){
            $error['notification'] = 'Not be empty!';
        }else{
            if(empty($email)){
                $error['email'] = 'E-mail is required';
            }else if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error['email'] = 'E-mail invalidate';
            }
    
            if(empty($password)){
                $error['password'] = 'Password is required';
            }
        }

        if(empty($error)){
            $request_login = mysqli_query($conn, "SELECT  *FROM `user` WHERE `email` = '".$email."'");

            if(mysqli_num_rows($request_login) == 1){
                $request_data = mysqli_fetch_assoc($request_login);

                $test_pass = password_verify($password, $request_data['password']);

                
                if($test_pass == true){
                    if($request_data['role'] == 'admin'){
                        $_SESSION['user_admin'] = $request_data;
                        header('location:../../NiceAdmin/index_admin.php');
                    }else if($request_data['role'] == 'user'){
                        $_SESSION['user'] = $request_data;
                        header('location:../index.php');
                    }
                }else if($test_pass == false){
                    $error['notification'] = "Wrong Password";
                }
            }else{
                $error['notification'] = "Account Doesn't Exist";
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style_form_user.css">
<title>Title</title>
</head>
<body>
    <div class="form_register d-inline-block">
        <div class="">
            <div class="form_left-input">
                <form action="form_login.php" method="post">
                    <h3 class="text-center fw-bold" style="color: #203d6e;">Login</h3>
                    <span class='notification text-danger ps-3 pb-3'> <?= !empty($error['notification'])?$error['notification']:''  ?></span>
                    <div>
                        <div class="form_field">
                            <input type="email" class="form_input" name="email" id="" placeholder=" ">
                            <label for="" class="form_label">E-mail</label>
                            <small class="small_under"></small>
                        </div>
                        <div class="error"><?= !empty($error['email'])?$error['email']:''  ?></div>
                    </div>
                    <div>
                        <div class="form_field">
                            <input type="password" class="form_input" name="password" id="" placeholder=" ">
                            <label for="" class="form_label">Password</label>
                            <small class="small_under"></small>
                        </div>
                        <div class="error"><?= !empty($error['password'])?$error['password']:''  ?></div>
                    </div>
                    <div class="w-100">
                        <button name="login" class="btn_dangki">Login</button>
                    </div>
                    
                </form>
                <div class="change_register">
                    <span style="color: #999">You don't have an account yet?</span>
                    <button class="btn_change">Register</button>
                </div>
            </div>
        </div>
    </div>
    <div class="LuaChon_form hide">
        <div class="con-lua-form container">
            <div class="row header-select">
                <h4>Welcome</h4>
                <p>Welcome to LK Job seeking !</p>
            </div>
            <div class="row border-top border-2 rounded-3 py-3">
                <div class="col-12 trainghiem">
                    <p>For the best experience, please choose the group that best suits you</p>
                </div>
                <div class="col-6">
                    <div class="luachon_img">
                        <img class="w-100" src="../assets/img/banner/bussiness.webp" alt="">
                    </div>
                    <a href="form_register_admin.php">Employer</a>
                </div>
                <div class="col-6" class="luachon_img">
                    <div class="luachon_img">
                        <img class="w-100" src="../assets/img/banner/student.webp" alt="">
                    </div>
                    <a href="form_register_user.php">Job Candidate</a>
                </div>
            </div>
        </div>
        <div class="lua_chon_mo"></div>
    </div>
</body>
<script src="../assets/js/form_login.js"></script>
</html>
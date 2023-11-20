<?php
    session_start();
    include "connect.php";
    
    $error = [];
    if(isset($_POST['register']))
    {
        $username = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['sdt']);
        $password = trim($_POST['password']);
        $passAGE = trim($_POST['passAG']);

        if(empty($username) && empty($email) && empty($phone) && empty('password') && empty($passAGE)){
            $error['notification'] = 'Not be empty!';
        }else{
            if(empty($username)){
                $error['username'] = 'Not be empty!';
            }
    
            if(empty($email)){
                $error['email'] = 'Not be empty!';
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error['email'] = 'Email invalidate';
            }
    
            if(empty($phone)){
                $error['phone'] = 'Phone is required';
            }else if(strlen($phone) < 0 && strlen($phone) > 11){
                $error['phone'] = 'Phone invalidate';
            }
    
            if(empty($password)){
                $error['password'] = 'Not be empty!';
            }
    
            if($passAGE != $password){
                $error['passAGE'] = 'The re-entered password does not match';
            }
        }

        if(empty($error)){
            $request_email = mysqli_query($conn,"SELECT *FROM user WHERE email = '".$email."'");

            if(mysqli_num_rows($request_email) > 0 ){
                $error['notification'] = 'Account already exists';
            }else{
                $pass = password_hash($password, INPUT_POST);
                $sql_register = "INSERT INTO `user`( `name`, `email`, `sdt`, `password`, `role`)
                                 VALUES ('$username','$email','$phone','$pass','user')";
                $request_user = mysqli_query($conn,$sql_register);
                header("location:form_login.php");
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
    <form action="form_register_user.php" method="POST">
    <div class="form_register d-inline-block">
        <div class="">
            <div class="form_left-input">
                <form action="">
                    <h3 class="text-center fw-bold" style="color: #203d6e;">Register</h3>
                    <span class='notification text-danger ps-3 pb-3'> <?= !empty($error['notification'])?$error['notification']:''  ?></span>
                    <div>
                        <div class="form_field">
                            <input type="text" class="form_input" name="name" placeholder=" ">
                            <label for="" class="form_label">Username</label>
                            <small class="small_under"></small>
                        </div>
                        <div class="error">
                        <?= !empty($error['username'])?$error['username']:''  ?>
                        </div>
                    </div>
                    <div>
                        <div class="form_field">
                            <input type="email" class="form_input" name="email" placeholder=" ">
                            <label for="" class="form_label">E-mail</label>
                            <small class="small_under"></small>
                        </div>
                        <div class="error">
                        <?= !empty($error['email'])?$error['email']:''  ?>
                        </div>
                    </div>
                    <div>
                        <div class="form_field">
                            <input type="text" class="form_input" name="sdt" placeholder=" ">
                            <label for="" class="form_label">(+84)</label>
                            <small class="small_under">
                               
                            </small>
                        </div>
                        <div class="error">
                            <?= !empty($error['phone'])?$error['phone']:''  ?>
                        </div>
                    </div>
                    <div>
                        <div class="form_field">
                            <input type="password" class="form_input" name="password" placeholder=" " >
                            <label for="" class="form_label">Password</label>
                            <small class="small_under"></small>
                        </div>
                        <div class="error">
                        <?= !empty($error['password'])?$error['password']:''  ?>
                        </div>
                    </div>
                    <div>
                        <div class="form_field">
                            <input type="password" class="form_input" name="passAG" placeholder=" ">
                            <label for="" class="form_label">Password again</label>
                            <small class="small_under"></small>
                        </div>
                        <div class="error">
                        <?= !empty($error['passAGE'])?$error['passAGE']:''  ?>
                        </div>
                   </div>
                    <div class="w-100">
                         <input type="submit" class="btn_dangki" name="register" value="Register">
                    </div>
                    
                </form>
                <div>
                    <span style="color: #999">Absolute Privacy Policy</span>
                    <a href="form_login.php" class="link">Login</a>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
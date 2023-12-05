<?php
session_start();
    include "./forms/connect.php";  
    $user = !empty($_SESSION['user'])?$_SESSION['user']:'';
    // echo $_SESSION['user'];
    // Khi người dùng nhập đầy đủ thông sẽ insert vô DB 
    //  Với các thông tin, id công việc, id user = id người ứng tuyển, tên tuổi bla bla
    $id_job=$_GET['id_jobs'];
    $request_apply = mysqli_query($conn, "SELECT * FROM `jobs` WHERE `id`=".$_GET['id_jobs']);
    $data= mysqli_fetch_assoc($request_apply);
    // var_dump($request_apply);
   
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <style>
        body{
            margin: 10px;
            padding: 20px;
        }
        .table{
            border: 1px solid chartreuse;
            border-radius: 10px;
            border-style: dashed;
            padding: 25px;
        }
        .upload{
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            border-radius: 10px;
            border: 2px dashed #555;
            color: #444;
            cursor: pointer;
            transition: background .2s ease-in-out, border .2s ease-in-out;
        }
        .upload:hover{
            background: #eee;
            border-color: #111;
        }
        .input {
            font-family: inherit;
            width: 100%;
            border: 0;
            border-bottom: 2px solid gray;
            outline: 0;
            font-size:15px;
            /* color: white; */
            padding: 7px 0;
            background: transparent;
            transition: border-color 0.2s;
            &::placeholder {
                /* color: transparent; */
                color: darkgrey;
            }
        }
        .input:focus {
        
        padding-bottom: 6px;  
        font-weight: 500;
        border-width: 3px;
        border-image: linear-gradient(to right, primary,secondary);
        border-image-slice: 1;
        }
        .finish{
            border: none;
            width: 80%;
            background-color:#5fcf80 ;
            border-radius: 20px;
            padding: 5px;
            font-weight: 1000;
        }
        .finish:hover{
            background-color:#006600;
            color: azure;
        }

    </style>
    <title>Ứng tuyển ngay</title>
  </head>
  <body class="d-flex justify-content-center">
    <!-- <h1>Hello, world!</h1> -->
    <form action="ung_tuyen.php" method="POST">
        <div >
            <h4>Apply to <span class="text-success"><?= $data['Name_Job']?></span></h4>
            <div class="">
                <i class="fa-solid fa-camera text-success mb-4"></i> Choose CV to upload
            </div>
            <div class="table">
                <div class="upload">
                    <div>
                        <i class="fa-solid fa-cloud-arrow-up text-success"></i>
                        Upload CV from your computer or drag and drop
                    </div>
                    <div>          
                        <input class="d-flex justify-content-center" type="file" value="Upload here">
                    </div>
                    <hr>
                </div>
                <div class="if_details">
                   <b class="text-success"> Enter details information: </b>
                    <div class="name">                      
                        <input class="input" type="text" name="name" placeholder="Enter your name">
                    </div>
                    <div class="email">
                        <input class="input" type="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="email">
                        <input class="input" type="text" name="sdt" placeholder="Enter your phone number">
                    </div>
                </div>
                <div class="submit d-flex justify-content-center">
                    <input type="submit" class= " mt-4 finish " value="Apply" name="finish">
                </div>
               
            </div>
        </div>
    </form>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>


<?php
    ob_start();
    // include "../Mentor/forms/connect.php";
    include 'nav_admin.php' ;
    include 'sidibar.php';
    $id_apply = $_GET['id_apply'];
    // echo $id_apply;
    $request = mysqli_query($conn, "SELECT `id`, `name`, `sdt`, `apply_time`, `email`, `CV`, `apply_status` 
    FROM `apply` WHERE `id`=".$id_apply );
    $data = mysqli_fetch_assoc($request);
   // $c = $data['CV'];

//    if(isset($_GET['id_apply']))
//    {
//     $request_accept = mysqli_query($conn, "UPDATE `apply` SET `apply_status`='0' WHERE `id`=".$_GET['id_apply']);
//     // echo "okla";
//     echo json_encode(array(
//         'status' => '0',
//         'message'=>'Apply success' 
//     ));
//    }
//    else
//    {
//     echo json_encode(array(
//         'status' => '1',
//         'message'=>'Apply fail'
//     ));
//    }
    
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  </head>
  <style>
    body{
        font-family: "Nunito", sans-serif;
    }
  </style>
  <body>
    <!-- <h1>Hello, world!</h1> -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
        </div><!-- End Page Title -->

        <form action="" id="submit_apply">
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <h2 style="color: #012970">Applicant Information</h2>
                        <!-- <form class="form_inf_aplly" action=""> -->
                            <b>Full name: </b><?= $data['name'] ?> <br>
                            <b>Phone number: </b> <?= $data['sdt'] ?><br>
                            <b>Email address: </b><?= $data['email'] ?><br>

                    </div>  
                </div>
                <div class="card">
                    <div class="card-body">
                        <input type="text" name="id_apply" id="id_apply" value="<?php echo $data['id'] ?>">
                        <h3 style="color: #012970">Curriculum vitae </h3> 
                            <?php
                            // echo "ko có";
                            $cv = fopen("../Mentor/assets/CV/".$data['CV']."","r") or die("Unable to open file!");
                            // Output one line until end-of-file
                            while(!feof($cv)) {
                            echo fgets($cv) . "<br>";
                            }
                            fclose($cv); 
                            ?>
                            <button type="submit" class="btn border-0" style="background: #2d3f6a; color: white;"  id="btn_submit" >Accept</button>
                            <!-- <a href="" type="submit" class="btn border-0" style="background: #2d3f6a; color: white;"  id="btn_submit" >Accept</a> -->
                        <!-- </form> -->
                    </div>
                </div>
            </section>
        </form>
        
        <script>
 
        </script>

  </main>
        
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../NiceAdmin/assets/js/finish_apply.js"></script>
    
</body>
</html>
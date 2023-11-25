
<?php
    if(isset($_POST['finish']))
    {
        if(empty($_POST['name']) || empty($_POST['email'])||empty($_POST['sdt']) )
        {
            echo $_POST['name'];
        }
        else
        {
            echo $_POST['name'];
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
            
            
        }
        
    }
?>
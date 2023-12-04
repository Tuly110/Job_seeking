<?php 
    ob_start();
    include '../Mentor/forms/connect.php';
   if(isset($_GET['id_apply']))
   {
    $request_accept = mysqli_query($conn, "UPDATE `apply` SET `apply_status`='0' WHERE `id`=".$_GET['id_apply']);
    // echo "okla";
    echo json_encode(array(
        'status' => '0',
        'message'=>'Apply success' 
    ));
   }
   else
   {
    echo json_encode(array(
        'status' => '1',
        'message'=>'Apply fail'
    ));
   }
?>
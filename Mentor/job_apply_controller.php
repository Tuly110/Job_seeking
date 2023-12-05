<?php
    session_start();
    include 'forms/connect.php';
    $user = !empty($_SESSION['user'])?$_SESSION['user']:'';

    if(!empty($_GET['apply']))
    {
        if(empty($_POST['name']) || empty($_POST['email'])||empty($_POST['sdt']) )
        {
            echo json_encode(array(
                'status' => '1',
                'message'=>"Apply fail"
            ));
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

            $finish = mysqli_query($conn, "INSERT INTO `apply`( `id_job`, `id_user`, `name`, `sdt`, `apply_time`, `email`, `CV`, `apply_status`)
            VALUES ('".$_GET['apply']."','".$user['ID']."','$name','$sdt','".time()."','$email', '$cv', 1)");
            
            echo json_encode(array(
                'status' => '0',
                'message'=>'Apply success'
            ));
            
        }

        
    }

//Thêm bình luận

    if(!empty($_GET['comments'])){
        $sql = "INSERT INTO `comments`( `id_jobs`, `id_user`, `comment`, `create_time`) 
                VALUES ('".$_GET['comments']."','".$user['ID']."','".$_POST['content']."','".date('d/m/Y')."')";
        mysqli_query($conn, $sql);
    }

// like or dislike bình luận
    if(isset($_GET['rating_action'])){

        function getRating($comment_id){
            global $conn;
            $rating = array();
    
            $like_query = "SELECT COUNT(*) FROM rating_info WHERE comment_id = $comment_id AND rating_action = 'like'";
            $dislike_query = "SELECT COUNT(*) FROM rating_info WHERE comment_id = $comment_id AND rating_action = 'dislike'";
    
            $like_request = mysqli_query($conn,$like_query);
            $dislike_request = mysqli_query($conn,$dislike_query);

            $likes = mysqli_fetch_array($like_request);
            $dislikes = mysqli_fetch_array($dislike_request);
    
            $rating = [
                'likes' => $likes[0],
                'dislikes' => $dislikes[0]
            ];
    
            return json_encode($rating);
        }

        if(isset($_POST['action'])){
            $comment_id = $_POST['comment_id'];
            $action = $_POST['action'];

            switch ($action) {
                case 'like':
                    $sql = "INSERT INTO `rating_info`(`comment_id`, `user_id`, `rating_action`) 
                                            VALUES ('$comment_id','".$user['ID']."','$action')
                                            ON DUPLICATE KEY UPDATE rating_action='like'";
                    break;
                case 'dislike':
                    $sql = "INSERT INTO `rating_info`(`comment_id`, `user_id`, `rating_action`) 
                                            VALUES ('$comment_id','".$user['ID']."','$action')
                                            ON DUPLICATE KEY UPDATE rating_action= 'dislike'";
                    break;
                case 'unlike':
                    $sql = "DELETE FROM `rating_info` WHERE `user_id` = '".$user['ID']."' AND `comment_id` = '$comment_id'";
                    break;
                case 'undislike':
                    $sql = "DELETE FROM `rating_info` WHERE `user_id` = '".$user['ID']."' AND `comment_id` = '$comment_id'";
                    break;
                default:
                    break;
            }
            mysqli_query($conn,$sql);
            // return number of likes
            echo getRating($comment_id);
            exit(0);

        }

        

    }

?>
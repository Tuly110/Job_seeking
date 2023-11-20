<?php 

function category_id($id,$start,$limit,$conn){
    $sql_category = "SELECT * FROM jobs WHERE id_category = $id  ORDER BY RAND() LIMIT $start,$limit";
    $request= mysqli_query($conn,$sql_category);
    return $request;
  }

  if(isset($_GET['category_id'])){
    $kq = category_id($_GET['category_id'],0,6,$conn); 
  }

  if(isset($_GET['search_like'])){
    if(isset($_POST['btn_search'])){
      $input = trim($_POST['job_search']);

      if(!empty($input)){
        $kq = mysqli_query($conn, "SELECT * FROM jobs WHERE Name_Job LIKE '%$input%'");

        if(mysqli_num_rows($kq) <= 0){
          $error['notification'] = '<div class="mt-3 py-2 fw-5 rounded-3 mx-2 text-center" style="background-color: #eee;">
                        The job you are looking for is not available
                    </div>';
          $kq = mysqli_query($conn, "SELECT * FROM jobs ORDER BY RAND() LIMIT 0,6");
        }
      }

    }
  }
  
?>
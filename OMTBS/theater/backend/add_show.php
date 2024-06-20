<?php
    session_start();
    include('../config/config.php');

    extract($_POST);

    $qry = "INSERT INTO `tbl_shows`(`st_id`, `theatre_id`, `movie_id`, `start_date`, `status`, `r_status`)
     VALUES ('$time','". $_SESSION['theater_id']."','$movie','$sdate','1','0')";

    foreach($stime as $time){
        $result = mysqli_query($conn,$qry);
    }

    if($result){
        echo"<script >
                alert('Data inserted successfully');
                window.location.href='../pages/add_show.php';
            </script>";
    }
    else{
        echo"<script>
                alert('Something went wrong!');
                window.location.href='../pages/add_show.php';
            </script>";
    }
?>
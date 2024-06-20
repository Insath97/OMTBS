<?php
    session_start();
    // database connection
    include('../config/config.php');

    if(isset($_GET['mid'])){

        $id = $_GET['mid'];

        $qry = "DELETE FROM `tbl_movie` WHERE movie_id = $mid";
        $result = mysqli_query($con,$qry);

        if($result){
            echo"<script >
                    alert('Data deleted successfully');
                    window.location.href='../pages/dashboard.php';
                </script>";
        }
        else{
            echo"<script>
                    alert('Something went wrong!');
                    window.location.href='../pages/dashboard.php';
                </script>";
        }

    }
?>

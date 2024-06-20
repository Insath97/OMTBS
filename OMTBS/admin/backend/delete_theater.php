<?php
    // database connection
    include('../config/config.php');

    if(isset($_GET['deleteid'])){

        $id = $_GET['deleteid'];

        $qry = "DELETE FROM `tbl_theatre` WHERE id = $id";
        $result = mysqli_query($con,$qry);

        if($result){
            echo"<script >
                    alert('Data deleted successfully');
                    window.location.href='../pages/theater_info.php';
                </script>";
        }
        else{
            echo"<script>
                    alert('Something went wrong!');
                    window.location.href='../pages/theater_info.php';
                </script>";
        }

    }
?>

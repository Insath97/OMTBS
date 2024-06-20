<?php
session_start();
include("../config/config.php");

// extract method
extract($_POST);

$qry = "INSERT INTO `tbl_screens`(`t_id`, `screen_name`, `seats`, `charge`) 
VALUES ('".$_SESSION['theater_id']."','$name','$seats','$charge')";

$result = mysqli_query($conn,$qry);

if($result){
    echo"<script >
            alert('Data inserted successfully');
            window.location.href='../pages/screen_info.php';
        </script>";
}
else{
    echo"<script>
            alert('Something went wrong!');
            window.location.href='../pages/screen_info.php';
        </script>";
}

?>

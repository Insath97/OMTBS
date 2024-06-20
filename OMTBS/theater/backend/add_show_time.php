<?php
session_start();
include("../config/config.php");

// extract method
extract($_POST);

$id = $_POST['id'];

$qry = "INSERT INTO `tbl_show_time`(`screen_id`, `name`, `start_time`) 
VALUES ('$id','$s_name','$s_time')";

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

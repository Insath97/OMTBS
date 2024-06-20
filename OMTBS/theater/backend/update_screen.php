<?php
session_start();
include("../config/config.php");

// extract method
extract($_POST);

$id = $_POST['id'];

$qry = "UPDATE `tbl_screens` SET `screen_name`='$name',`seats`='$seats',`charge`='$charge' WHERE screen_id = $id";
$result = mysqli_query($conn,$qry);

if($result){
    echo"<script >
            alert('Data Updated successfully');
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

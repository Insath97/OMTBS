<?php
session_start();
include("../config/config.php");

extract($_GET);
$qry = "update tbl_shows set r_status='$status' where s_id='$id'";
$result = mysqli_query($conn,$qry);

if ($result) {
    echo "<script >
                alert('Running Status Updated successfully');
                window.location.href='../pages/view_show.php';
            </script>";
} else {
    echo "<script>
                alert('Something went wrong!');
                window.location.href='../pages/view_show.php';
            </script>";
}

// $_SESSION['success'] = "Running Status Updated";
// header("location:../pages/view_show.php");

?>
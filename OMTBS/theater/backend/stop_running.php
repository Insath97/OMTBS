<?php
session_start();
include("../config/config.php");

extract($_GET);
$qry = "update tbl_shows set status='0' where s_id='$id'";
$result = mysqli_query($conn,$qry);

if ($result) {
    echo "<script >
                alert('Show Deleted successfully');
                window.location.href='../pages/veiw_show.php';
            </script>";
} else {
    echo "<script>
                alert('Something went wrong!');
                window.location.href='../pages/veiw_show.php';
            </script>";
}

?>








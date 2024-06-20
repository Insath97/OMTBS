<?php
session_start();
// database connection
include("../config/config.php");

if (isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $qry = "DELETE FROM `tbl_movie` WHERE  movie_id = $id";
    $result = mysqli_query($conn, $qry);

    if ($result) {
        echo "<script >
                    alert('Data deleted successfully');
                    window.location.href='../pages/view_upcoming_movies.php';
                </script>";
    } else {
        echo "<script>
                    alert('Something went wrong!');
                    window.location.href='../pages/view_upcoming_movies.php';
                </script>";
    }
}
?>

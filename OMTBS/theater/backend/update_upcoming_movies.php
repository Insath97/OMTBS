<?php
session_start();
include("../config/config.php");

// extract method
extract($_POST);

// image import
$target_dir = "../assets/upcoming_movies_images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$flname="upcoming_movies_images/".basename($_FILES["image"]["name"]);

$id = $_POST['id'];

$qry ="UPDATE `tbl_movie` SET `movie_name`='$name',`cast`='$cast',`desc`='$desc',`release_date`='$rdate',`image`='$flname',`video_url`='$video',`status`='[value-9]' WHERE movie_id = '$id'";
$result = mysqli_query($conn,$qry);

if($result){
    // upload image into folder
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    echo"<script >
            alert('Data updated successfully');
            window.location.href='../pages/view_upcoming_movies.php';
        </script>";
}
else{
    echo"<script>
            alert('Something went wrong!');
            window.location.href='../pages/view_upcoming_movies.php';
        </script>";
}

?>
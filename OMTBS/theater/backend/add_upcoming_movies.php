<?php
session_start();
include("../config/config.php");

// extract method
extract($_POST);

// image import
$target_dir = "../assets/upcoming_movies_images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$flname="upcoming_movies_images/".basename($_FILES["image"]["name"]);

$qry = "INSERT INTO `tbl_movie`(`t_id`, `movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`, `status`)
 VALUES ('".$_SESSION['theater_id']."','$name','$cast','$desc','$rdate','$flname','$video','0')";

$result = mysqli_query($conn,$qry);

if($result){
    // upload image into folder
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    echo"<script >
            alert('Data inserted successfully');
            window.location.href='../pages/add_upcoming_movies.php';
        </script>";
}
else{
    echo"<script>
            alert('Something went wrong!');
            window.location.href='../pages/add_upcoming_movies.php';
        </script>";
}

?>


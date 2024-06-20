<?php
include('../config/config.php');
extract($_POST);

// image import
$uploaddir = '../assets/news_images/';
$uploadfile = $uploaddir . basename($_FILES['attachment']['name']);
move_uploaded_file($_FILES['attachment']['tmp_name'],$uploadfile);
$flname="news_images/".basename($_FILES["attachment"]["name"]);

$id = $_POST['id'];

// database insert
$qry = "UPDATE `tbl_news` SET `name`='$name',`cast`='$cast',`news_date`='$date',`description`='$description',`attachment`='$flname' WHERE news_id = $id";
$result = mysqli_query($con,$qry);


if($result){
    echo"<script >
            alert('Data update successfully');
            window.location.href='../pages/add_movie_news.php';
        </script>";
}
else{
    echo"<script>
            alert('Something went wrong!');
            window.location.href='../pages/add_movie_news.php';
        </script>";
}
?>
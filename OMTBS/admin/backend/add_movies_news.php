<?php
include('../config/config.php');
extract($_POST);

// image import
$uploaddir = '../assets/news_images/';
$uploadfile = $uploaddir . basename($_FILES['attachment']['name']);
move_uploaded_file($_FILES['attachment']['tmp_name'],$uploadfile);
$flname="news_images/".basename($_FILES["attachment"]["name"]);

// database insert
$result = mysqli_query($con,"insert into  tbl_news values(NULL,'$name','$cast','$date','$description','$flname')");
$_SESSION['add']=1;

if($result){
    echo"<script >
            alert('Data inserted successfully');
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
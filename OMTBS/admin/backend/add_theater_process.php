<?php
// database connection
include ('../config/config.php');

// extracts all of the variables submitted via the HTTP POST method
extract($_POST);

// insert data into theater table
$result = mysqli_query($con,"insert into  tbl_theatre values(NULL,'$name','$address','$place','$district','$pin','$username','$password')");

if($result){
    echo"<script >
            alert('New Theater Added Successfully!');
            window.location.href='../pages/add_theater.php';
        </script>";
}
else{
    echo"<script>
            alert('Something went wrong!');
            window.location.href='../pages/add_theater.php';
        </script>";
}

?>
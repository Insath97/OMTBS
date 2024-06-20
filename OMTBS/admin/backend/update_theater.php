<?php
// database connection
include("../config/config.php");

// extracts all of the variables submitted via the HTTP POST method
extract($_POST);

$id = $_POST['id'];

$qry = "UPDATE `tbl_theatre` SET `name`='$name',`address`='$address',`place`='$place',`state`='$district',`pin`='$pin',`username`='$username',`passwored`='$password' WHERE  `id`=$id";

$result = mysqli_query($con,$qry);

if($result){
    echo"<script >
            alert('Data update successfully');
            window.location.href='../pages/theater_info.php';
        </script>";
}
else{
    echo"<script>
            alert('Something went wrong!');
            window.location.href='../pages/theater_info.php';
        </script>";
}

?>
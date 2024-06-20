<?php
    $host = "localhost";
    $user = "root";                     
    $pass = "";                                  
    $db = "movietheatredb";
    $port = 3306;
    $conn = mysqli_connect($host, $user, $pass, $db, $port)or die(mysqli_error());
?>
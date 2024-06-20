<?php
session_start();
include('partials/msgbox.php');
include('config/config.php');

// login code 
if (isset($_POST['login'])){
    $admin_email = $_POST['admin_email'];
    // $admin_password = sha1(md5($_POST['password']));
    $admin_password = $_POST['password'];
    $qry=mysqli_query($con,"select * from tbl_login where username='$admin_email' and password='$admin_password'");
    if(mysqli_num_rows($qry)){
        $usr=mysqli_fetch_array($qry);
        if($usr['user_type']==0){
            $_SESSION['admin']=$usr['user_id'];
		    header('location:pages/dashboard.php');
        }
        else{
            $_SESSION['error']="Login Failed!";
	    	header("location:../index.php");
        }
    }
    else{
        $_SESSION['error']="Login Failed!";
    	header("location:../index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMTBS || Admin </title>

    <!-- Boostarp  -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">

    <!-- icheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a><b> &nbsp; Admin Panel</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Please login to start your session</p>
            <form  method="post">
                <div class="form-group has-feedback">
                    <input name="admin_email" type="text" size="25" placeholder="Username" class="form-control" required/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="password" type="password" size="25" placeholder="Password" class="form-control" required/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-danger">Login</button>
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

    <!-- Boostrap  -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- icheck -->
    <script src="assets/plugins/iCheck/icheck.min.js"></script>

    <!-- script  -->
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>
<?php
    session_start();   
    include('config/config.php');

    if(isset($_POST['login'])){

        // username = THR995013     
       //  password = PWD227911

        $theater_username = $_POST['theater_username'];
        $theater_password = $_POST['password'];

        $qry = "SELECT * FROM `tbl_theatre` WHERE username = '$theater_username' and passwored = '$theater_password'";
        $result = mysqli_query($conn,$qry);

        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);

            // id`, `name`, `address`, `place`, `state`, `pin`, `username`, `passwored`

            $_SESSION['theater_id'] =  $row['id'];
            $_SESSION['theater_name'] = $row['name'];
            $_SESSION['theater_username'] = $row['username'];

            header("location:../theater/pages/dashboard.php");
        }
        else{
            $_SESSION['error']="Login Failed!";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMTBS || Theater Panel </title>

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
            <a><b> &nbsp; Theater Panel</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <?php include('partials/msgbox.php'); ?>
            <p class="login-box-msg">Please login to start your session</p>
            <form  method="post">
                <div class="form-group has-feedback">
                    <input name="theater_username" type="text" size="25" placeholder="Username" class="form-control" required/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="password" type="password" size="25" placeholder="Password" class="form-control" required/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
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
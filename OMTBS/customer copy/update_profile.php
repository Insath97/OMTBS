<?php
session_start();
include("config/dbconn.php");

if(isset($_POST['registration'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_POST['id'];

    $qry = "UPDATE `tbl_registration` SET `name`='$name',`email`='$email',`phone`='$phone',`age`='$age',`gender`='$gender',`password`='$password' WHERE user_id ='$id'";
    $result = mysqli_query($conn, $qry);

    if ($result) {
        $successScript = "
        Swal.fire({
            icon: 'success',
            title: 'Update Successful',
            text: 'You have been Updated successfully!',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'home.php';
        });
        ";
    } else {
        $errorScript = "
        Swal.fire({
            icon: 'error',
            title: 'Update Failed',
            text: 'Failed to Update. Please try again.',
            confirmButtonText: 'OK'
        });
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Book my Show</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

</head>

<body>

    <!-- header start -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="home.php" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>Book My Show</h1>
            </a>

            <!-- navbar -->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="home.php" >Home</a></li>
                    <li><a href="now_showing_movies.html">Now showing Movies</a></li>
                    <li><a href="upcomming_movies.html">Upcoming Movies</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        $UserName = $_SESSION['user_name'];
                        ?>
                        <li><a href='update_profile.php?updateid=<?php echo $_SESSION['user_id'];?>' class="active"><?php echo $UserName; ?></a></li>
                        <li><a href='logout.php'>Logout</a></li>
                    <?php
                    } 
                    ?>
                </ul>
            </nav>

            <?php
            if (isset($_SESSION['user_name'])) {
                $UserName = $_SESSION['user_name'];
            ?>
            <a class="btn-book-a-table" href="booking_info.php">Booking History</a>
            <?php
            }else{
            ?>
            <a class="btn-book-a-table" href="login.php">Login Here</a>
            <?php
            } ?>  
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header>
    <!-- header end   -->

    <!-- hero content start-->
    <section id="hero" class="hero d-flex align-items-center section-bg">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="border border-3 border-success"></div>
                            <div class="card bg-white shadow-lg">
                                <div class="card-body p-5">
                                    <?php
                                    // SELECT `user_id`, `name`, `email`, `phone`, `age`, `gender`, `password` FROM `tbl_registration` WHERE
                                    $id = $_GET['updateid'];
                                    $select_qry = "SELECT * FROM `tbl_registration` WHERE user_id='$id'";
                                    $select_qry_exe = mysqli_query($conn,$select_qry);
                                    while($row = mysqli_fetch_array($select_qry_exe)){
                                    ?>
                                    <form class="mb-3 mt-md-4"  method="post">
                                        <h2 class="fw-bold mb-2 text-uppercase">BOOK MY SHOW</h2>
                                        <p class="mb-3">Please enter your details to Update an account.</p>

                                        <div class="mb-3">
                                            <input type="text" class="form-control"  name="name" id="name" value="<?php echo $row['name'];?>" placeholder="Enter your name" required>                                            
                                        </div>

                                        <div class="mb-3">
                                            <input type="number" class="form-control" name="age" value="<?php echo $row['age'];?>" placeholder="Enter your age" required>
                                        </div>

                                        <div class="mb-3">
                                            <select class="form-select" name="gender">
                                                <option value="<?php echo $row['gender'];?>" selected><?php echo $row['gender'];?></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Others</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <input type="number" class="form-control" name="phone" value="<?php echo $row['phone'];?>" placeholder="Enter your phone number" required>
                                        </div>

                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>" placeholder="name@example.com" required>
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="password" value="<?php echo $row['password'];?>" placeholder="Enter your password" required>
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $row['user_id'];?>">

                                        <div class="d-grid mt-2">
                                            <button class="btn btn-outline-success" type="submit" name="registration">Update Profile</button>
                                        </div>

                                    </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hero content end -->

    <!-- footer start -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div>
                        <h4>Address</h4>
                        <p>
                            677/c V.H Road Sainthamruthu -14 <br>
                            Sainthamruthu, Srilanka <br>
                        </p>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Reservations</h4>
                        <p>
                            <strong>Phone:</strong> +94 775062716<br>
                            <strong>Email:</strong> inshath97.mi@gmail.com<br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Opening Hours</h4>
                        <p>
                            <strong>Mon-Sun: 7AM</strong> - 12AM<br>

                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Book My Show</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://www.linkedin.com/in/mohamed-insath-90a40724a/">Mohamed Insath</a>
            </div>
        </div>

    </footer>
    <!-- footer end  -->

    <!-- alert popup -->
    <?php if (isset($successScript)) : ?>
        <script>
            <?php echo $successScript; ?>
        </script>
    <?php endif; ?>

    <?php if (isset($errorScript)) : ?>
        <script>
            <?php echo $errorScript; ?>
        </script>
    <?php endif; ?>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
<?php
session_start();
include("config/dbconn.php");
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
?>

<?php
if (isset($_GET['cancelid'])) {
    $id = $_GET['cancelid'];
    $cancel_qry = "DELETE FROM `tbl_bookings` WHERE book_id = '$id'";
    $cancel_qry_exe = mysqli_query($conn, $cancel_qry);

    if ($cancel_qry_exe) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: 'Booking has been deleted successfully!',
                confirmButtonText: 'OK'
             }).then(() => {
                 window.location.href = 'booking_info.php';
             });
        </script>";
    } else {
        $errorScript = "
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Failed to delete Booking!',
        confirmButtonText: 'OK'
    });
</script>
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

    <link rel="stylesheet" href="assets/validation/src/css/bootstrapValidator.css">
    <script src="assets/validation/src/js/bootstrapValidator.js"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

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

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="now_showing_movies.php">Now showing Movies</a></li>
                    <li><a href="upcomming_movies.php">Upcoming Movies</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        $UserName = $_SESSION['user_name'];
                    ?>
                        <li><a href='update_profile.php?updateid=<?php echo $_SESSION['user_id']; ?>' class="active"><?php echo $UserName; ?></a></li>
                        <li><a href='logout.php'>Logout</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav><!-- .navbar -->

            <?php
            if (isset($_SESSION['user_name'])) {
                $UserName = $_SESSION['user_name'];
            ?>
                <a class="btn-book-a-table" href="booking_info.php">Booking History</a>
            <?php
            } else {
            ?>
                <a class="btn-book-a-table" href="login.php">Login Here</a>
            <?php
            } ?>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>
    </header>
    <!-- header end   -->

    <!-- web content start -->

    <section class="chefs section-bg">
        <div class="container my-5">
            <div class="row">
                <a class="btn btn-primary disabled placeholder col-12"> Booking Movies History</a>
                <div class="col-md-12 my-5">
                    <div class="table-responsive section-bg">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Booking ID</th>
                                    <th scope="col">Movie Name</th>
                                    <th scope="col">Theater Name</th>
                                    <th scope="col">Screen Name</th>
                                    <th scope="col">Show Name</th>
                                    <th scope="col">Show Time</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Seats</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Qr Code</th>
                                </tr>
                            </thead>
                            <?php
                            // `book_id`, `ticket_id`, `t_id`, `user_id`, `show_id`, `screen_id`, `no_seats`, `amount`, `ticket_date`, `date`, `status`
                            $qry = "SELECT * FROM `tbl_bookings` WHERE user_id='" . $_SESSION['user_id'] . "'";
                            $result = mysqli_query($conn, $qry);

                            while ($row = mysqli_fetch_array($result)) {

                                // get theater name using theater id
                                $qry_1 = "SELECT * FROM `tbl_theatre` WHERE id = '" . $row['t_id'] . "'";
                                $result_1 = mysqli_query($conn, $qry_1);
                                $row_1 = mysqli_fetch_array($result_1);

                                // get screen name using screen id
                                $qry_2 = "SELECT * FROM `tbl_screens` WHERE screen_id = '" . $row['screen_id'] . "'";
                                $result_2 = mysqli_query($conn, $qry_2);
                                $row_2 = mysqli_fetch_array($result_2);

                                //get movie id using show id
                                $qry_3 = "SELECT `s_id`, `st_id`, `theatre_id`, `movie_id`, `start_date`, `status`, `r_status` FROM `tbl_shows` WHERE s_id = '" . $row['show_id'] . "'";
                                $result_3 = mysqli_query($conn, $qry_3);
                                $row_3 = mysqli_fetch_array($result_3);

                                // get show name using show id
                                $qry_4 = "SELECT `st_id`, `screen_id`, `name`, `start_time` FROM `tbl_show_time` WHERE st_id='" . $row_3['st_id'] . "'";
                                $result_4 = mysqli_query($conn, $qry_4);
                                $row_4 = mysqli_fetch_array($result_4);

                                // get movie name 
                                $qry_5 = "SELECT `movie_id`, `t_id`, `movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`, `status` FROM `tbl_movie` WHERE movie_id='" . $row_3['movie_id'] . "'";
                                $result_5 = mysqli_query($conn, $qry_5);
                                $row_5 = mysqli_fetch_array($result_5);

                                // 
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['ticket_id']; ?></td>
                                        <td><?php echo $row_5['movie_name']; ?></td>
                                        <td><?php echo $row_1['name']; ?></td>
                                        <td><?php echo $row_2['screen_name']; ?></td>
                                        <td><?php echo $row_4['name']; ?></td>
                                        <td><?php echo $row_4['start_time']; ?></td>
                                        <td><?php echo $row['ticket_date']; ?></td>
                                        <td><?php echo $row['no_seats']; ?></td>
                                        <td><?php echo $row['amount']; ?></td>
                                        <td>Status</td>
                                        <td><a href="booking_info.php?cancelid=<?php echo $row['book_id']; ?>" class="btn btn-danger">Cancel</a></td>
                                        <td>Qr Generate </td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- web content end   -->

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




    <!-- scripts -->
    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>


</body>

</html>
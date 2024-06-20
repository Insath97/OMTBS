<?php
session_start();
include("config/dbconn.php");
$movieid = $_GET['movid'];
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

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="now_showing_movies.php" class="active">Now showing Movies</a></li>
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
    <!-- now showing movies -->
    <section class="chefs section-bg">
        <div class="container my-5">
            <div class="row">
                <a class="btn btn-primary disabled placeholder col-9"> Now Screening Movies</a>
                <div class="col-md-9 my-5">
                    <?php
                    //$movieid = $_GET['movid'];

                    $qry = "SELECT * FROM `tbl_movie` WHERE movie_id = '$movieid'";
                    $result = mysqli_query($conn, $qry);

                    while ($row = mysqli_fetch_array($result)) {
                        // `movie_id`, `t_id`, `movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`, `status
                    ?>
                        <div class="d-flex mx-5">
                            <div>
                                <img src="../theater/assets/<?php echo $row['image']; ?>" alt="Image" class="rounded float-start img-fluid" style="max-width: 300px; height: auto;">
                            </div>
                            <div class="ms-5 d-flex flex-column justify-content-between">
                                <div>
                                    <h3><?php echo $row['movie_name']; ?></h3>
                                    <p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th><b>Cast:</b></th>
                                                <td><?php echo $row['cast']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><b>Description:</b></th>
                                                <td><?php echo $row['desc']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><b>Release date:</b></th>
                                                <td><?php echo $row['release_date']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <a href="<?php echo $row['video_url']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-danger">Watch Trailer</a>

                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <a class="btn btn-primary disabled placeholder col-9"> Availabale Shows </a>

                <div class="col-md-9 my-5">
                    <?php
                    $qry1 = "SELECT `theatre_id` FROM `tbl_shows` WHERE movie_id='$movieid'";
                    $result1 = mysqli_query($conn, $qry1);
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Theater Name</th>
                                <th>Showing Time</th>
                            </tr>
                        </thead>
                        <?php
                        while ($row1 = mysqli_fetch_array($result1)) {

                            // `id`, `name`, `address`, `place`, `state`, `pin`, `username`, `passwored`
                            $qry2 = "SELECT * FROM `tbl_theatre` WHERE id = '" . $row1['theatre_id'] . "'";
                            $result2 = mysqli_query($conn, $qry2);
                        ?>
                            <tbody>
                                <?php
                                while ($row2 = mysqli_fetch_array($result2)) {

                                    $qry3 = "SELECT `s_id`, `st_id`, `theatre_id`, `movie_id`, `start_date`, `status`, `r_status`
                                     FROM `tbl_shows` WHERE movie_id = '$movieid'";

                                    $result3 = mysqli_query($conn, $qry3);

                                    while ($row3 = mysqli_fetch_array($result3)) {
                                        $qry4 = "SELECT `st_id`, `screen_id`, `name`, `start_time` FROM `tbl_show_time` WHERE st_id = '" . $row3['st_id'] . "'";
                                        $result4 = mysqli_query($conn, $qry4);

                                        while ($row4 = mysqli_fetch_array($result4)) {

                                ?>
                                            <tr>
                                                <td><?php echo $row2['name']; ?></td>
                                                <td> <a href="check_login.php?show=<?php echo $row3['s_id']; ?>&movie=<?php echo $movieid ?>&theatre=<?php echo $row1['theatre_id']; ?>" class="btn btn-danger"><?php echo date('h:i A', strtotime($row4['start_time'])); ?></a></td>
                                            </tr>

                                            <!-- <?php  }
                                            } ?> -->
                            </tbody>

                    <?php }
                            } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- web content end   -->

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

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
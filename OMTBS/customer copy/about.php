<?php
session_start();
include("config/dbconn.php");
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
                    <li><a href="now_showing_movies.php">Now showing Movies</a></li>
                    <li><a href="upcomming_movies.php">Upcoming Movies</a></li>
                    <li><a href="about.php" class="active">About</a></li>
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

    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <p>Learn More <span>About Us</span></p>
            </div>

            <div class="row gy-4">
                <div class="col-lg-7 position-relative about-img" style="background-image: url(assets/img/download.jpg) ;" data-aos="fade-up" data-aos-delay="150">
                    <div class="call-us position-absolute">
                        <h4>Book Tickets </h4>
                        <p>+94 775062716</p>
                    </div>
                </div>
                <div class="col-lg-5 d-flex align-items-lg-start" data-aos="fade-up" data-aos-delay="300">
                    <div class="content ps-0 ps-lg-5">
                        <p class="fst-italic">
                            Welcome to our online movie ticket booking system!
                            We are dedicated to providing you with a seamless and convenient way to book your favorite movies and enjoy a memorable cinema experience.
                            With our user-friendly platform, you can easily browse through a wide selection of movies, check showtimes, and secure your tickets with just a few clicks.
                        </p>
                        <p>
                            At Book my Show, our mission is to bring the magic of cinema right to your fingertips.
                            We strive to make the movie-going process as enjoyable and hassle-free as possible,
                            so you can focus on the excitement of the big screen.
                        </p>
                        <ul>

                            <li><i class="bi bi-check2-all"></i>Convenient Booking: Our user-friendly platform allows you to effortlessly navigate through movie listings, view showtimes, and select your preferred seats.
                                With just a few clicks, you can secure your tickets and be ready for an unforgettable movie experience.</li>

                            <li><i class="bi bi-check2-all"></i>Flexible Payment Options:
                                We offer various payment methods to suit your convenience. Whether you prefer using credit cards, debit cards, or digital wallets,
                                we strive to provide a seamless payment process that suits your preferences.</li>
                        </ul>
                        <p>
                            Join us on this cinematic journey and immerse yourself in the enchanting world of movies.
                            Book your tickets with Book My Show today and let us take care of your movie-watching experience from start to finish.
                            Lights, camera, action!
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

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
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

      <!-- navbar -->
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="now_showing_movies.php" class="active">Now showing Movies</a></li>
          <li><a href="upcomming_movies.php">Upcoming Movies</a></li>
          <li><a href="about.html">About</a></li>
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

  <!-- now showing movies -->
  <section class="chefs section-bg">
    <div class="container">
      <div class="wall my-5">
        <div class="section-header mt-2">
          <p>Now <span>Showing</span> Movies</p>
        </div>
        <div class="row ">
          <?php
          $qry = "SELECT * FROM `tbl_movie`";
          $result = mysqli_query($conn, $qry);
          while ($row = mysqli_fetch_array($result)) {
            // movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`
          ?>
            <div class="col-md-3">
              <div class="card">
                <a href="<?php echo $row['video_url']; ?>" target="_blank" rel="noopener noreferrer">
                  <img src="../theater/assets/<?php echo $row['image']; ?>" class="card-img-top" alt="Thumbnail Image"></a>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['movie_name']; ?></h5>
                  <p class="card-text">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th><b>Cast:</b></th>
                        <td> <?php echo $row['cast']; ?></td>
                      </tr>

                      <tr>
                        <th><b>Release date:</b></th>
                        <td><?php echo $row['release_date']; ?></td>
                      </tr>
                    </table>
                  </div>

                  </p>
                  <a href="about_movie.php?movid=<?php echo $row['movie_id']; ?>" class="btn btn-danger">Book Now</a>
                </div>
              </div>
            </div>
          <?php } ?>
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
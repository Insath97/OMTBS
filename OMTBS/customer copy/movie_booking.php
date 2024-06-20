<?php
session_start();
include("config/dbconn.php");
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
?>

<?php
// generate random id
$bookid = "BKID" . rand(1000000, 9999999);

if (isset($_POST['booking'])) {
    $theater_id = $_POST['theaterid'];
    $user_id =  $_SESSION['user_id'];
    $show_id = $_SESSION['show'];
    $screen_id = $_POST['screen'];
    $number_of_seats = $_POST['seats'];
    $amount = $_POST['amount'];
    $show_date = $_POST['date'];

    $qury = "INSERT INTO `tbl_bookings`(`ticket_id`, `t_id`, `user_id`, `show_id`, `screen_id`, `no_seats`, `amount`, `ticket_date`, `date`, `status`) 
    VALUES ('$bookid','$theater_id','$user_id','$show_id','$screen_id','$number_of_seats','$amount','$show_date',CURDATE(),'1')";

    $qury_run = mysqli_query($conn, $qury);



    if ($qury_run) {
        $qury_get_data = "SELECT * FROM `tbl_bookings` WHERE user_id = '$user_id' and ticket_id='$bookid'";
        $qury_get_exe = mysqli_query($conn, $qury_get_data);
        // `book_id`, `ticket_id`, `t_id`, `user_id`, `show_id`, `screen_id`, `no_seats`, `amount`, `ticket_date`, `date`, `status`       
        $row_booking = mysqli_fetch_array($qury_get_exe);
        $_SESSION['ticket_id'] = $row_booking['ticket_id'];
        $_SESSION['booking_id'] = $row_booking['book_id'];
        $_SESSION['amount'] = $row_booking['amount'];

        header("location:process_movie_booking.php");
    } else {
        $errorScript = "
        Swal.fire({
            icon: 'error',
            title: 'Booking Failed',
            text: 'Something went wrong!',
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

    <link rel="stylesheet" href="assets/validation/src/css/bootstrapValidator.css">
    <script src="assets/validation/src/js/bootstrapValidator.js"></script>

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

                    $qry = "SELECT * FROM `tbl_movie` WHERE movie_id = '" . $_SESSION['movie'] . "'";
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
                                    <div class="table-responsive section-bg">
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
                    $qry1 = "SELECT * FROM `tbl_shows` WHERE movie_id='" . $_SESSION['movie'] . "'";
                    $result1 = mysqli_query($conn, $qry1);
                    $row1 = mysqli_fetch_array($result1);

                    // `id`, `name`, `address`, `place`, `state`, `pin`, `username`, `passwored`
                    $qry2 = "SELECT * FROM `tbl_theatre` WHERE id = '" . $row1['theatre_id'] . "'";
                    $result2 = mysqli_query($conn, $qry2);
                    $row2 = mysqli_fetch_array($result2);
                    ?>
                    <table class="table table-bordered table-hover text-center">
                        <tr>
                            <th class="col-md-6"> Theater Name</th>
                            <td><?php echo $row2['name']; ?></td>
                        </tr>

                        <?php
                        $qry3 = "SELECT `st_id`, `screen_id`, `name`, `start_time` FROM `tbl_show_time` WHERE st_id = '" . $row1['st_id'] . "'";
                        $result3 = mysqli_query($conn, $qry3);
                        $row3 = mysqli_fetch_array($result3);

                        $qry4 = "SELECT `screen_id`, `t_id`, `screen_name`, `seats`, `charge` FROM `tbl_screens` WHERE screen_id = '" . $row3['screen_id'] . "'";
                        $result4 = mysqli_query($conn, $qry4);
                        $row4 = mysqli_fetch_array($result4);
                        ?>
                        <tr>
                            <th class="col-md-6">Screen</th>
                            <td><?php echo $row4['screen_name']; ?></td>
                        </tr>

                        <tr>
                            <th>Date</th>
                            <?php
                            if (isset($_GET['date'])) {
                                $date = $_GET['date'];
                            } else {
                                if ($row1['start_date'] > date('Y-m-d')) {
                                    $date = date('Y-m-d', strtotime($row1['start_date'] . "-1 days"));
                                } else {
                                    $date = date('Y-m-d');
                                }
                                $_SESSION['dd'] = $date;
                            }
                            ?>
                            <td>
                                <div class="col-md-12 text-center" style="padding-bottom:20px">
                                    <?php if ($date > $_SESSION['dd']) { ?>
                                        <a href="movie_booking.php?date=<?php echo date('Y-m-d', strtotime($date . "-1 days")); ?>">
                                            <button class="btn btn-default"><i class="bi bi-chevron-left"></i></button>
                                        </a>
                                    <?php } ?>
                                    <span style="cursor:default" class="btn btn-default"><?php echo date('d-M-Y', strtotime($date)); ?></span>
                                    <?php if ($date != date('Y-m-d', strtotime($_SESSION['dd'] . "+4 days"))) { ?>
                                        <a href="movie_booking.php?date=<?php echo date('Y-m-d', strtotime($date . "+1 days")); ?>">
                                            <button class="btn btn-default"><i class="bi bi-chevron-right"></i></button>
                                        </a>
                                    <?php }
                                    $qry5 = "select sum(no_seats) from tbl_bookings where show_id='" . $_SESSION['show'] . "' and ticket_date='$date'";
                                    $result5 = mysqli_query($conn, $qry5);
                                    $row5 = mysqli_fetch_array($result5);
                                    ?>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>Show Time</th>
                            <td><?php echo date('h:i A', strtotime($row3['start_time'])) . " " . $row3['name']; ?> Show</td>
                        </tr>

                        <tr>
                            <th>Number of Seats</th>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="screen" value="<?php echo $row4['screen_id']; ?>" />
                                    <input type="hidden" name="theaterid" value="<?php echo $row1['theatre_id']; ?>">
                                    <input type="number" required title="Number of Seats" max="<?php echo $row4['seats'] - $row5[0]; ?>" min="0" name="seats" class="form-control" value="1" style="text-align:center" id="seats" oninput="calculateAmount()" />
                                    <input type="hidden" name="amount" id="hm" value="<?php echo $row4['charge']; ?>" />
                                    <input type="hidden" name="date" value="<?php echo $date; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <th>Amount</th>
                            <td id="amount" style="font-weight:bold;font-size:18px">
                                Rs <?php echo $row4['charge']; ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"><?php if ($row5[0] == $row4['seats']) { ?><button type="button" class="btn btn-danger" style="width:100%">House Full</button><?php } else { ?>
                                    <button class="btn btn-danger" name="booking" style="width:100%">Book Now</button>
                                <?php } ?>
                                </form>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- web content end   -->

    <!-- footer start -->
    <?php include("includes/footer.php"); ?>
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

    <script type="text/javascript">
        function calculateAmount() {
            var charge = <?php echo $row4['charge']; ?>;
            var seats = parseInt(document.getElementById('seats').value);
            var amount = charge * seats;
            document.getElementById('amount').innerHTML = "Rs " + amount;
            document.getElementById('hm').value = amount;
        }
    </script>


</body>

</html>
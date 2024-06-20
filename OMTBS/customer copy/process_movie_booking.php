<?php
session_start();
include("config/dbconn.php");
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
?>

<?php
if (isset($_POST['payment'])) {

    // `book_id`, `ticket_id`, `t_id`, `user_id`, `show_id`, `screen_id`, `no_seats`, `amount`, `ticket_date`, `date`, `status
    $booking_qry = "SELECT * FROM `tbl_bookings` WHERE user_id ='" . $_SESSION['user_id'] . "' and book_id ='" . $_SESSION['booking_id'] . "'";
    $qury_qry_exe = mysqli_query($conn, $booking_qry);
    $row_booking = mysqli_fetch_array($qury_qry_exe);
    $ticket_amount = $row_booking['amount'];


    $name_on_card = $_POST['name'];
    $card_number = $_POST['number'];
    $expiry_date = $_POST['date'];
    $cvc = $_POST['cvv'];

    // `id`, `name`, `card_number`, `expiration_date`, `cvc`, `balance`
    $qry = "SELECT * FROM `bank` WHERE card_number = '$card_number' and cvc = '$cvc'";
    $result = mysqli_query($conn, $qry);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);
        $_SESSION['card_number'] = $row['card_number'];
        $bank_balance = $row['balance'];

        if ($ticket_amount < $row['balance']) {
            $balance = $bank_balance - $ticket_amount;

            $qry1 = "UPDATE `bank` SET `balance`='$balance' WHERE card_number = '$card_number'";
            $result1 = mysqli_query($conn, $qry1);

            if ($result1) {
                header("location:bank_demo.php");
            }
        } else {
            $errorScript = "
            Swal.fire({
                icon: 'error',
                title: 'Payment Failed',
                text: 'Not enough balance!',
                confirmButtonText: 'OK'
            });
            ";
        }
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

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <style>
        label {
            font-weight: bold;
        }
    </style>

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
            <div class="d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="card bg-white shadow-lg">
                                <div class="card-body p-5">
                                    <form class="mb-3 " method="post" action="">
                                        <h2 class="fw-bold  text-uppercase text-center">payment</h2>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name on Card</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="number" class="form-label">Card Number</label>
                                            <input type="text" class="form-control" id="number" name="number" required pattern="[0-9]{16}" title="Enter 16 digit card number">
                                        </div>
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Expiration date</label>
                                            <input type="date" class="form-control" id="date" name="date">
                                        </div>
                                        <div class="mb-3">
                                            <label for="cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cvv" name="cvv">
                                        </div>
                                        <div class="d-grid mt-4">
                                            <button class="btn btn-success" type="submit" name="payment">Make Payment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('#form1').bootstrapValidator({
                fields: {
                    name: {
                        verbose: false,
                        validators: {
                            notEmpty: {
                                message: 'The Name is required and can\'t be empty'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z ]+$/,
                                message: 'The Name can only consist of alphabets'
                            }
                        }
                    },
                    number: {
                        verbose: false,
                        validators: {
                            notEmpty: {
                                message: 'The Card Number is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 16,
                                max: 16,
                                message: 'The Card Number must 16 characters long'
                            },
                            regexp: {
                                regexp: /^[0-9 ]+$/,
                                message: 'Enter a valid Card Number'
                            }
                        }
                    },
                    date: {
                        verbose: false,
                        validators: {
                            notEmpty: {
                                message: 'The Expire Date is required and can\'t be empty'
                            }
                        }
                    },
                    cvv: {
                        verbose: false,
                        validators: {
                            notEmpty: {
                                message: 'The cvv is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 3,
                                max: 3,
                                message: 'The cvv must 3 characters long'
                            },
                            regexp: {
                                regexp: /^[0-9 ]+$/,
                                message: 'Enter a valid cvv'
                            }
                        }
                    }
                }
            });
        });
    </script>


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


</body>

</html>
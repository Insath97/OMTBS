<?php
session_start();
include("config/dbconn.php");
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
?>

<?php
if(isset($_POST['payment'])){
    //OTP Code
    $otp = $_POST['otp'];

    if ($otp == "123456"){
        header("location:payment_success.php");
        $_SESSION['payment_status'] === 'success';
    }
    else{
        $errorScript = "
        Swal.fire({
            icon: 'error',
            title: 'Payment Failed',
            text: 'Your payment was not successful!',
            confirmButtonText: 'OK'
        }).then(() => {          
            window.location.href = 'process_movie_booking.php';
        });
            ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment || OMTBS</title>

    <!-- css import for demo bank  -->
    <link rel="stylesheet" href="assets/css/bank.css">
    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

</head>

<body>
    <div id="mainContainer" class="row large-centered">

        <div class="text-center">
            <h2>BANK</h2>
        </div>

        <hr class="divider">
        <dl class="mercDetails">
            <dt>Acount Holder Name</dt>
            <dd><?php echo $_SESSION['user_name']; ?></dd>
            <dt>Transaction Amount</dt>
            <dd>LKR <?php echo $_SESSION['amount']; ?></dd>
            <dt>Debit Card</dt>
            <dd><?php echo $_SESSION['card_number']; ?>
            </dd>
        </dl>
        <hr class="divider">
        
        <form name="form1" id="form1" method="post" action="">
            <fieldset class="page2">
                <div class="page-heading">
                    <h6 class="form-heading">Authenticate Payment</h6>
                    <p class="form-subheading">OTP sent to your mobile number ending with <strong>1343</strong></p>
                </div>
                <div class="row formInputSection">
                    <div class="large-7 columns">
                        <label>
                            Enter One Time Password (OTP)
                            <input type="tel" name="otp" class="form-control optPass" value="" maxlength="6" autocomplete="off" />
                        </label>
                    </div>
                    <div class="large-5 columns">
                        <label>&nbsp;</label><button class="expanded button next" name="payment" onClick="ValidateForm()">Make Payment</button>
                    </div>
                </div>
                <div class="text-right resendBtn requestOTP"><a class="request-link" href="javascript:void(0)">Resend OTP</a></div>
                <p>
                    <a class="tryAgain" href="process_movie_booking.php">Go back</a> 
                </p>
            </fieldset>
        </form>
    </div>

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

    <script src="bank/script/jquery-1.9.1.js"></script>

    <script>
        document.onmousedown = rightclickD;

        function rightclickD(e) {
            e = e || event;
            if (e.button == 2) {
                alert('Function Disabled...');
                return false;
            }
        }

        function ValidateForm() {
            var regPin = RegExp("^[0-9]{4,6}$");
            if (document.form1.customerpin.value == "" || !document.form1.customerpin.value.match(regPin)) {
                alert("Please enter a valid 6 digit One Time Password (OTP) receive on your registered Mobile Number.");
                document.form1.customerpin.focus();
                return false;
            } else {
                document.form1.submit();
            }

        }
    </script>


</body>
</html>
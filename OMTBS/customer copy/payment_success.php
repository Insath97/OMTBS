<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment || OMTBS</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <script>
        setTimeout(function() {
            // Display SweetAlert alert
            Swal.fire({
                icon: 'success',
                title: 'Payment Success',
                text: 'Your payment was successful!',
                confirmButtonText: 'OK'
            }).then(() => {
                // Redirect to another page
                window.location.href = 'booking_info.php';
            });
        }, 3000);
    </script>

</head>

<body>
    <table align='center'>
        <tr>
            <td><STRONG>Transaction is being processed,</STRONG></td>
        </tr>
        <tr>
            <td>
                <font color='blue'>Please Wait <i class="fa fa-spinner fa-pulse fa-fw"></i>
                    <span class="sr-only">
                </font>
            </td>
        </tr>
        <tr>
            <td>(Do not 'RELOAD' this page or 'CLOSE' this page)</td>
        </tr>
    </table>

    <script>
        setTimeout(function() {
            // Display SweetAlert alert
            Swal.fire({
                icon: 'success',
                title: 'Payment Success',
                text: 'Your payment was successful!',
                confirmButtonText: 'OK'
            }).then(() => {
                // Redirect to another page
                window.location.href = 'booking_info.php';
            });
        }, 3000);
    </script>



</body>

</html>
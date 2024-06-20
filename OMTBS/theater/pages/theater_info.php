<?php
include('../partials/header.php');
?>

<!-- validation -->
<script type="text/javascript" src="../assets/validation/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../assets/validation/dist/js/bootstrapValidator.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Theater Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="../pages/dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Theater Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">General Details</h3>
            </div>
            <div class="box-body">
                <?php
                    // SELECT `id`, `name`, `address`, `place`, `state`, `pin`, `username`, `passwored` FROM `tbl_theatre` WHERE 1
                    $qry = "SELECT * FROM `tbl_theatre` WHERE id = '" . $_SESSION['theater_id'] . "'";
                    $result = mysqli_query($conn, $qry);
                    $row = mysqli_fetch_array($result);
                ?>
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="col-md-6">Theater Name</td>
                        <td class="col-md-6"><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-6">Theater Username</td>
                        <td class="col-md-6"><?php echo $row['username']; ?></td>
                    </tr>
                    <tr>
                        <td>Theater Address</td>
                        <td><?php echo $row['address']; ?></td>
                    </tr>
                    <tr>
                        <td>Place</td>
                        <td><?php echo $row['place']; ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $row['state']; ?></td>
                    </tr>
                    <tr>
                        <td>Pin</td>
                        <td><?php echo $row['pin']; ?></td>
                    </tr>
                </table>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('../partials/footer.php');
?>
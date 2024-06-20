<?php
include("../config/config.php");
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
            Screen Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="../pages/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Screen Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
            <button class="btn btn-info box-title my-4"><a href="add_screen.php" style="color: white; font-size :smaller;"><i class="fa fa-plus"></i> Add Screen Details</a></button>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-2">
                                Screen name
                            </th>
                            <th class="col-md-2">
                                Seats
                            </th>
                            <th class="col-md-2">
                                Charge Per Seat
                            </th>
                            <th class="col-md-2">
                                Show Time
                            </th>
                            <th class="col-md-2">
                                Show Time
                            </th>   
                            <th class="col-md-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <?php
                    $qry = "SELECT * FROM `tbl_screens` WHERE  t_id = '" . $_SESSION['theater_id'] . "'";
                    $result = mysqli_query($conn, $qry);
                    while ($row = mysqli_fetch_assoc($result)) {
                        // `screen_id`, `t_id`, `screen_name`, `seats`, `charge`                       
                    ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row['screen_name']; ?> </td>
                                <td> <?php echo $row['seats']; ?> </td>
                                <td> <?php echo $row['charge']; ?> </td>  
                                <?php
                                // intha page la oru error irukku ithula ore id la irukkura neraya data va table la ore column athula view panna vendum.
                                    $qry2 = "SELECT `start_time` FROM `tbl_show_time` WHERE screen_id = '".$row['screen_id']."'";
                                    $result2 = mysqli_query($conn, $qry2);
                                    $row2 = mysqli_fetch_assoc($result2)                                
                                ?> 
                                <td><?php echo $row2['start_time']; ?></td> 
                                
                                <td><a href="../pages/add_show_time.php?addid=<?php echo $row['screen_id']; ?>" class="btn btn-warning">Add Show Times</a></td>                          
                                <td>
                                    <a href="../pages/update_screen.php?updateid=<?php echo $row['screen_id']; ?>" class="btn btn-success">Edit</a>
                                    <a href="../backend/delete_screen.php?deleteid=<?php echo $row['screen_id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>

                    <?php
                    }
                    ?>

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
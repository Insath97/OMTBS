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
            Todays Booking
        </h1>
        <ol class="breadcrumb">
            <li><a href="../pages/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Todays Booking</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group col-md-6">
                            <label class="control-label">Select Screen</label>
                            <select class="form-control" id="screen">
                                <option value="0">Select Screen</option>
                                <?php
                                $q = mysqli_query($conn, "select  * from tbl_screens where t_id='" .  $_SESSION['theater_id'] . "'");
                                while ($th = mysqli_fetch_array($q)) {
                                ?>
                                    <option value="<?php echo $th['screen_id']; ?>"><?php echo $th['screen_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Select Show</label>
                            <select class="form-control" id="show">
                                <option value="0">Select Screen</option>

                            </select>
                        </div>

                    </div>
                </div>
                <div id="disp"></div>
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

<script>
    $('#screen').change(function() {

        screen = $(this).val();
        $.ajax({
                url: '../backend/get_show.php',
                type: 'POST',
                data: 'id=' + screen,
                dataType: 'html'
            })
            .done(function(data) {
                //console.log(data);	
                $('#show').html(data);
            })
            .fail(function() {
                $('#screendtls').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            });

    });

    $('#show').change(function() {
        show = $(this).val();
        $.ajax({
                url: '../backend/get_tickets.php',
                type: 'POST',
                data: 'id=' + show,
                dataType: 'html'
            })
            .done(function(data) {
                //console.log(data);	
                $('#disp').html(data);
            })
            .fail(function() {
                $('#screendtls').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            });
    });
</script>
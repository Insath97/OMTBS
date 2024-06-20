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
            Theatre Assistance
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Home</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Running Movies</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-3">Show Time</th>
                                <th class="col-md-4">Screen</th>
                                <th class="col-md-4">Movie</th>
                            </tr>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>

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

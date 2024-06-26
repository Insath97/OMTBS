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
            View Shows
        </h1>
        <ol class="breadcrumb">
            <li><a href="../pages/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View Shows</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Available Shows</h3>
            </div>
            <div class="box-body">              
                <?php
                $sw = mysqli_query($conn, "select * from tbl_shows where st_id in(select st_id from tbl_show_time where screen_id in(select screen_id from  tbl_screens where t_id='" .   $_SESSION['theater_id'] . "')) and status='1'");
                if (mysqli_num_rows($sw)) { ?>
                    <table class="table">
                        <th class="col-md-1">
                            Sl.no
                        </th>
                        <th class="col-md-2">
                            Screen
                        </th>
                        <th class="col-md-3">
                            Show Time
                        </th>
                        <th class="col-md-3">
                            Movie
                        </th>
                        <th class="col-md-3">
                            Options
                        </th>
                        <?php
                        $sl = 1;
                        while ($shows = mysqli_fetch_array($sw)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $sl;
                                    $sl++; ?>
                                </td>
                                <?php
                                $st = mysqli_query($conn, "select * from tbl_show_time where st_id='" . $shows['st_id'] . "'");
                                $show_time = mysqli_fetch_array($st);
                                $sr = mysqli_query($conn, "select * from tbl_screens where screen_id='" . $show_time['screen_id'] . "'");
                                $screen = mysqli_fetch_array($sr);
                                $mv = mysqli_query($conn, "select * from tbl_movie where movie_id='" . $shows['movie_id'] . "'");
                                $movie = mysqli_fetch_array($mv);
                                ?>
                                <td>
                                    <?php echo $screen['screen_name']; ?>
                                </td>
                                <td>
                                    <?php echo date('h:i A', strtotime($show_time['start_time'])) . " ( " . $show_time['name'] . " Show )"; ?>
                                </td>
                                <td>
                                    <?php echo $movie['movie_name']; ?>
                                </td>
                                <td>
                                    <?php if ($shows['r_status'] == 1) {
                                    ?><a href="../backend/change_running.php?id=<?php echo $shows['s_id']; ?>&status=0"><button class="btn btn-danger">Stop Running</button></a>
                                    <?php
                                    } else { ?><a href="../backend/change_running.php?id=<?php echo $shows['s_id']; ?>&status=1"><button class="btn btn-success">Start Running</button></a>
                                    <?php
                                    } ?>
                                    <a href="../backend/stop_running.php?php echo $shows['s_id']; ?>"><button class="btn btn-warning">Stop Show</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <h3>No Shows Added</h3>
                <?php
                }
                ?>
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
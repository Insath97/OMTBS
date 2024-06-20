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
            Upcoming Movies List
        </h1>
        <ol class="breadcrumb">
            <li><a href="../pages/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Upcoming Movies List</li>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-md-1">
                                Movie name
                            </th>
                            <th class="col-md-1">
                                Cast
                            </th>
                            <th class="col-md-3">
                                Description
                            </th>
                            <th class="col-md-2">
                                Release Date
                            </th>
                            <th class="col-md-2">
                                Poster
                            </th>
                            <th class="col-md-2">
                                Trailer Link
                            </th>
                            <th class="col-md-2">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <?php
                    $qry = "SELECT * FROM `tbl_movie` WHERE  t_id = '" . $_SESSION['theater_id'] . "'";
                    $result = mysqli_query($conn, $qry);
                    while ($row = mysqli_fetch_assoc($result)) {
                        // `movie_id`, `t_id`, `movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`                       
                    ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row['movie_name']; ?> </td>
                                <td> <?php echo $row['cast']; ?> </td>
                                <td> <?php echo $row['desc']; ?> </td>
                                <td> <?php echo $row['release_date']; ?> </td>
                                <td> <img src="../assets/<?php echo $row['image'];?>" height="100" width="100" alt=""></td>
                                <td> <a href="<?php echo $row['video_url'];?>" target="_blank" rel="noopener noreferrer"><?php echo $row['video_url']; ?></a></td>
                                <td>
                                    <a href="../pages/update_upcoming_movies.php?updateid=<?php echo $row['movie_id']; ?>" class="btn btn-success">Edit</a>
                                    <a href="../backend/delete_upcoming_movies.php?deleteid=<?php echo $row['movie_id']; ?>" class="btn btn-danger">Delete</a>
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
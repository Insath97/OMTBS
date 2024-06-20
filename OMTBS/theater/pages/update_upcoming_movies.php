<?php
include("../config/config.php");
include('../partials/header.php');
?>

<!-- validation -->
<script type="text/javascript" src="../assets/validation/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../assets/validation/dist/js/bootstrapValidator.js"></script>

<!-- form object calling start -->
<?php
include("../partials/form.php");
$frm = new formBuilder;
?>
<!-- form object calling end -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Upcoming Movies
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Update Upcoming Movies</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <?php
                // database connection
                include('../config/config.php');
                $id = $_GET['updateid'];

                $qry = "SELECT * FROM `tbl_movie` WHERE movie_id = $id";
                $result = mysqli_query($conn, $qry);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // `movie_id`, `t_id`, `movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`, `status`

                ?>

                        <form action="../backend/update_upcoming_movies.php" method="post" enctype="multipart/form-data" id="form1">

                            <div class="form-group">
                                <label class="control-label">Movie Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $row['movie_name']; ?>" />
                                <?php $frm->validate("name", array("required", "label" => "Movie Name")); // Validating form using form builder written in form.php 
                                ?>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Cast</label>
                                <input type="text" name="cast" class="form-control" value="<?php echo $row['cast']; ?>" />
                                <?php $frm->validate("cast", array("required", "label" => "Cast", "regexp" => "text")); // Validating form using form builder written in form.php 
                                ?>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="desc" class="form-control"><?php echo $row['desc']; ?></textarea>
                                <?php $frm->validate("desc", array("required", "label" => "Description")); // Validating form using form builder written in form.php 
                                ?>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Release Date</label>
                                <input type="date" name="rdate" class="form-control" value="<?php echo $row['release_date']; ?>" />
                                <?php $frm->validate("rdate", array("required", "label" => "Release Date")); // Validating form using form builder written in form.php 
                                ?>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Image</label>
                                <input type="file" name="image" class="form-control" value="<?php echo $row['image']; ?>" />
                                <?php $frm->validate("image", array("required", "label" => "Image")); // Validating form using form builder written in form.php 
                                ?>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Trailer Youtube Link</label>
                                <input type="text" name="video" class="form-control" value="<?php echo $row['video_url']; ?>" />
                                <?php $frm->validate("video", array("label" => "Image", "max" => "500")); // Validating form using form builder written in form.php 
                                ?>
                            </div>

                            <!-- id hidden grna input type ma "hidden" -->
                            <input type="hidden" name="id" value="<?php echo $row['movie_id']; ?>">


                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update Movie</button>
                            </div>

                        </form>
                <?php
                    }
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

<script>
    <?php $frm->applyvalidations("form1"); ?>
</script>
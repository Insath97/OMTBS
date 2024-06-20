<?php
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
            Add Show Time
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Add Show Time</li>
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
                $id = $_GET['addid'];

                $qry = "SELECT * FROM `tbl_screens` WHERE  screen_id = '$id'";
                $result = mysqli_query($conn, $qry);

                if(mysqli_num_rows($result)){
                    while($row = mysqli_fetch_array($result)){
                ?>

                <!-- `screen_id`, `t_id`, `screen_name`, `seats`, `charge` -->
                <form action="../backend/add_show_time.php" method="post" enctype="multipart/form-data" id="form1">

                    <div class="form-group">
                        <label class="control-label">Screen Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $row['screen_name']; ?>" />
                        <?php $frm->validate("name", array("required", "label" => "Screen Name")); // Validating form using form builder written in form.php 
                        ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Select Show</label>
                        <select name="s_name" id="s_name" class="form-control">
                            <option value="0">Select Show</option>
                            <option>Noon</option>
                            <option>Matinee</option>
                            <option>Night</option>
                            <option>First</option>
                            <option>Second</option>
                            <option>Others</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Show Starting Time</label>
                        <input type="time" id="s_time" class="form-control" name="s_time" />
                    </div>

                    <!-- id hidden grna input type ma "hidden" -->
                    <input type="hidden" name="id" value="<?php echo $row['screen_id']; ?>">

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Add Show Time</button>
                    </div>

                </form>
                <?php
                }}
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
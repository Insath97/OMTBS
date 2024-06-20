<?php
include('../config/config.php');
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
            Add Show
        </h1>
        <ol class="breadcrumb">
            <li><a href="../pages/dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Add Show</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <!-- `screen_id`, `t_id`, `screen_name`, `seats`, `charge` -->
                <form action="../backend/add_show.php" method="post" enctype="multipart/form-data" id="form1">

                    <div class="form-group">
                        <label class="control-label">Select Movie</label>
                        <select name="movie" class="form-control">
                            <option value>Select Movie</option>
                            <?php
                            $qry = "SELECT * FROM `tbl_movie` WHERE status='0' and t_id = '" . $_SESSION['theater_id'] . "'";
                            $result = mysqli_query($conn, $qry);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?php echo $row['movie_id']; ?>"><?php echo $row['movie_name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php $frm->validate("movie", array("required", "label" => "Movie")); // Validating form using form builder written in form.php 
                        ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Select Screen</label>
                        <select name="screen" class="form-control" id="screen">
                            <option value>Select Screen</option>
                            <?php
                            $qry2 = "SELECT * FROM `tbl_screens` WHERE t_id = '" . $_SESSION['theater_id'] . "'";
                            $result2 = mysqli_query($conn, $qry2);
                            while ($row2 = mysqli_fetch_array($result2)) {
                            ?>
                                <option value="<?php echo $row2['screen_id']; ?>"><?php echo $row2['screen_name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php $frm->validate("screen", array("required", "label" => "Screen")); // Validating form using form builder written in form.php 
                        ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Select Show Times</label>
                        <select name="stime[]" class="form-control" id="stime" multiple>
                            <option value="0">Select Show Times</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Start Date</label>
                        <input type="date" name="sdate" class="form-control" />
                        <?php $frm->validate("sdate", array("required", "label" => "Start Date")); // Validating form using form builder written in form.php 
                        ?>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Add Screen</button>
                    </div>

                </form>
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

<!-- //  this code snippet demonstrates how to use jQuery and Ajax to handle a change event and make
 a server-side request to dynamically update the content of a specific HTML element based on the selected value -->
<script type="text/javascript">
  
  $('#screen').change(function(){
    screen=$(this).val();
    $.ajax({
			url: '../backend/get_show_time.php',
			type: 'POST',
			data: 'screen='+screen,
			dataType: 'html'
		})
		.done(function(data){
			//console.log(data);	
			$('#stime').html(data);    
		})
		.fail(function(){
			$('#stime').html('<option><i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...</option>');
		});
  });
</script>

<script>
    <?php $frm->applyvalidations("form1"); ?>
</script>


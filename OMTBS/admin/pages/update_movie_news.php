<?php
include('../partials/header.php');
?>
<link rel="stylesheet" href="../assets/validation/dist/css/bootstrapValidator.css"/>
    
<script type="text/javascript" src="../assets/validation/dist/js/bootstrapValidator.js"></script>
  
  <?php
    include('../partials/form.php');
    $frm=new formBuilder;      
  ?>   
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Upcoming Movie News
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Update Movies News</li>
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

                $qry = "SELECT * FROM `tbl_news` WHERE news_id = $id";
                $result = mysqli_query($con,$qry);
                if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                // SELECT `news_id`, `name`, `cast`, `news_date`, `description`, `attachment` FROM `tbl_news` WHERE 1` 
            ?>

            <form action="../backend/update_movies_news.php" method="post" enctype="multipart/form-data" id="form1">
              <div class="form-group">
                <label class="control-label">Movie name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>"/>
                <?php $frm->validate("name",array("required","label"=>"Movie Name")); // Validating form using form builder written in form.php ?>
              </div>

              <div class="form-group">
                 <label class="control-label">Cast</label>
                <input type="text" name="cast" class="form-control" value="<?php echo $row['cast']; ?>">
                <?php $frm->validate("cast",array("required","label"=>"Cast","regexp"=>"text")); // Validating form using form builder written in form.php ?>
              </div>
              
              <div class="form-group">
                <label class="control-label">Release Date</label>
                <input type="date" name="date" class="form-control" value="<?php echo $row['news_date']; ?>"/>
                <?php $frm->validate("date",array("required","label"=>"Release Date")); // Validating form using form builder written in form.php ?>
              </div>
              
              <div class="form-group">
                <label class="control-label">Description</label>
                 <input type="text" name="description" class="form-control" value="<?php echo $row['description']; ?>">
                 <?php $frm->validate("description",array("required","label"=>"Description")); // Validating form using form builder written in form.php ?>
              </div>

              <div class="form-group">
                  <label class="control-label">Images</label>
              <input type="file"  name="attachment" class="form-control" placeholder="Images" value="<?php echo $row['attachment']; ?>">
               <?php $frm->validate("attachment",array("required","label"=>"Image")); // Validating form using form builder written in form.php ?>
              </div>

                    <!-- id hidden grna input type ma "hidden" -->
             <input type="hidden" name="id" value="<?php echo $row['news_id'];?>">

              <div class="form-group">
                <button class="btn btn-success" name="UpdateNews">Update News</button>
              </div>

        </form>
            <?php }} ?>
        </div> 
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
    
  </div>
  <?php
include('../partials/footer.php');
?>
<script>
  <?php $frm->applyvalidations("form1");?>
</script>
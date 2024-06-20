<?php
include('../partials/header.php');
?>
<link rel="stylesheet" href="../../validation/dist/css/bootstrapValidator.css"/>
    
<script type="text/javascript" src="../../validation/dist/js/bootstrapValidator.js"></script>
  <!-- =============================================== -->
  <?php
    include('../partials/form.php');
    $frm=new formBuilder;      
  ?>    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Theatre
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Add Theatre</li>
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

                $qry = "SELECT * FROM `tbl_theatre` WHERE id = $id";
                $result = mysqli_query($con,$qry);
                if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                // `name`, `address`, `place`, `state`, `pin`, `username`, `passwored` 
            ?>
            <form action="../backend/update_theater.php" method="post" id="form1">
              
              <div class="form-group">
                <label class="control-label">Theatre Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>"/>
                <?php $frm->validate("name",array("required","label"=>"Theatre Name")); // Validating form using form builder written in form.php ?>
              </div>

              <div class="form-group">
                <label class="control-label">Theatre Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>"/>
                <?php $frm->validate("address",array("required","label"=>"Theatre Address")); // Validating form using form builder written in form.php ?>
              </div>

              <div class="form-group">
                <label class="control-label">Place</label>
                <!-- <input type="text" name="place" id="autocomplete" class="form-control"> -->
                <input type="text" name="place" class="form-control" value="<?php echo $row['place']; ?>">
                <?php $frm->validate("place",array("required","label"=>"Place")); // Validating form using form builder written in form.php ?>
              </div>

              <div class="form-group">
                 <label class="control-label">District</label>
                <input type="text" name="district" id="administrative_area_level_1" s placeholder="District" class="form-control" value="<?php echo $row['state']; ?>">
                <?php $frm->validate("district",array("required","label"=>"District")); // Validating form using form builder written in form.php ?>
              </div>

              <div class="form-group">
                <label class="control-label">Pin Code</label>
                 <input type="text" name="pin" id="postal_code"s placeholder="Zip code" class="form-control" value="<?php echo $row['pin']; ?>">
                 <?php $frm->validate("pin",array("required","label"=>"Pin Code","regexp"=>"pin")); // Validating form using form builder written in form.php ?>
              </div>
              
              <div class="form-group">
                <label class="control-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">
                <?php $frm->validate("username",array("required","label"=>"Username")); // Validating form using form builder written in form.php ?>
              </div>

              <div class="form-group">
                <label class="control-label">Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo $row['passwored']; ?>">
                <?php $frm->validate("password",array("required","label"=>"Password")); // Validating form using form builder written in form.php ?>
              </div>
              
                 <!-- id hidden grna input type ma "hidden" -->
             <input type="hidden" name="id" value="<?php echo $row['id'];?>">

              <div class="form-group">
                <button class="btn btn-success">Update Theatre</button>
              </div>
    
            </form>
            <?php } }?>
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
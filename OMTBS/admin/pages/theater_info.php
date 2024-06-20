<?php
include('../config/config.php');
include('../partials/header.php');
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Theater List
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Theater List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

     <!-- Default box --> 
     <div class="box">
         <div class="box-header with-border">
              <h3 class="box-title">Theater Details</h3>
            </div>
        <div class="box-body">
         <!-- table start -->
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Theatre Name</th>
                    <th>Theatre Address</th>
                    <th>Place</th>
                    <th>District</th>
                    <th>Pin Code</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
                  $qry = "SELECT * FROM `tbl_theatre`";
                  $result = mysqli_query($con,$qry);

                  while($row = mysqli_fetch_assoc($result)){

                  //`id`, `name`, `address`, `place`, `state`, `pin`
              ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['place']?></td>
                <td><?php echo $row['state']?></td>
                <td><?php echo $row['pin']?></td>
                <td><?php echo $row['username']?></td>
                <td>
                  <a href="../pages/update_theater_details.php?updateid=<?php echo $row['id'] ?>" class="btn btn-success">Edit</a>
                  <a href="../backend/delete_theater.php?deleteid=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php } ?>
           </tbody>
        </table>
        <!-- table end -->

        
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

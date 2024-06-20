<?php
include('../config/config.php');
include('../partials/header.php');
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Upcomming Movie List
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Upcomming Movie List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

     <!-- Default box --> 
     <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-success box-title my-4"><a href="add_movie_news.php" style="color: white;">Upcomming Movie List Details</a></button>           
            </div>
        <div class="box-body">
            <!-- table start -->
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Movie Name</th>
                        <th>Cast</th>
                        <th>Release Date</th>
                        <th>Description</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $qry = "SELECT * FROM `tbl_news`";
                        $result = mysqli_query($con,$qry);
                        while($row = mysqli_fetch_assoc($result)){                       
                    ?>
                <tr>
                    <td><?php echo $row['news_id']?></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['cast']?></td>
                    <td><?php echo $row['news_date']?></td>
                    <td><?php echo $row['description']?></td>
                    <td><img src="../assets/<?php echo $row['attachment'];?>" height="100" width="100" alt=""></td> 
                    <td >
                        <a href="../pages/update_movie_news.php?updateid=<?php echo $row['news_id'] ?>" class="btn btn-success">Edit</a>
                        <a href="../backend/delete_movie_news.php?deleteid=<?php echo $row['news_id'] ?>" class="btn btn-danger">Delete</a>
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

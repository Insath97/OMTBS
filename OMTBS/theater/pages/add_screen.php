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
            Add Screen Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Add Screen Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <!-- `screen_id`, `t_id`, `screen_name`, `seats`, `charge` -->
                <form action="../backend/add_screen.php" method="post" enctype="multipart/form-data" id="form1">

                    <div class="form-group">
                        <label class="control-label">Screen Name</label>
                        <input type="text" name="name" class="form-control" />
                        <?php $frm->validate("name", array("required", "label" => "Screen Name")); // Validating form using form builder written in form.php 
                        ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Seats</label>
                        <input type="number" name="seats" class="form-control" />
                        <?php $frm->validate("seats", array("required", "label" => "Seats", "regexp" => "seats")); // Validating form using form builder written in form.php 
                        ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Charge</label>
                        <input type="number" name="charge" class="form-control" />
                        <?php $frm->validate("charge", array("required", "label" => "Charge", "regexp" => "charge")); // Validating form using form builder written in form.php 
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

<script>
    <?php $frm->applyvalidations("form1"); ?>
</script>
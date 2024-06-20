<?php
include('../config/config.php');

$id = $_POST['screen'];

$qry = "SELECT * FROM `tbl_show_time` WHERE screen_id = $id";
$result = mysqli_query($conn,$qry);

if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_array($result)){ ?>
        <option value="<?php echo $row['st_id']; ?>"><?php echo $row['name'] . "( " . $row['start_time'] . " )"; ?></option>
<?php        
    }
} 
else { ?>
    <option disabled>No Show time added in selected screen</option>
<?php
}

?>
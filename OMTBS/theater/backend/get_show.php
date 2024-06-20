<?php
include("../config/config.php");
extract($_POST);

$qry = "select * from tbl_show_time where screen_id='$id'";
$result = mysqli_query($conn, $qry);
?>
<option value="0">Select Show</option>

<?php
while ($row = mysqli_fetch_array($result)) {
?>
    <option value="<?php echo $row['st_id']; ?>"><?php echo $row['name']; ?></option>
<?php
}

?>
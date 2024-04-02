<?php
include '../config.php';
include '../function.php';
extract($_POST);
$db= dbConn();
$sql="SELECT * FROM tbl_city WHERE DistrictCode='$district'";
$result=$db->query($sql);
?>

<label>Select City</label>
<select id="city" name="city">
    <option value="">--</option>
<?php

if($result->num_rows>0){
    while ($row=$result->fetch_assoc()){
        ?>
    <option value="<?= $row['CityId'] ?>"><?= $row['City'] ?></option>
    <?php
    }
}


?>
</select>
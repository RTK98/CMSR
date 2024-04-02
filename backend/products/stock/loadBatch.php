<?php

include '../../config.php';
include '../../function.php';
extract($_POST);

$db = dbConn();
echo "here";
echo $CategoryId1 = $_POST["catId"];
echo $suppId = $_POST["suppId"];
echo $suppId = $_POST["suppId"];
echo $proId = $_POST["proId"];

$sql2 = "SELECT * FROM `batchno` WHERE SupplierId = '$suppId' AND CategoryId = '$CategoryId1' AND ProductId = '$proId';";
$result2 = $db->query($sql2);

if ($result2->num_rows > 0) {
    echo '<option value="">Select Product</option>';
    while ($row = $result2->fetch_assoc()) {
        echo '<option value="' . $row['BatchId'] . '">' . $row['BatchNo'] . '</option>';
    }
} else {
    echo '<option value="">Batch Not Selected</option>';
}
?>

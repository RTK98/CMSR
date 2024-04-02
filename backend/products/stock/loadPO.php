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

$sql2 = "SELECT * FROM `purchasingorders` WHERE Supplier_Name = '$suppId' AND Product_Name = '$proId';";
$result2 = $db->query($sql2);

if ($result2->num_rows > 0) {
    echo '<option value="">Select Product</option>';
    while ($row = $result2->fetch_assoc()) {
        echo '<option value="' . $row['PoId'] . '">' . $row['PoNo'] . '</option>';
    }
} else {
    echo '<option value="">Batch Not Selected</option>';
}
?>

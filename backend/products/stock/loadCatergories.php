<?php

include '../../config.php';
include '../../function.php';
extract($_POST);
//var_dump($_POST["options"])
echo $SupplierId = $_POST["options"];
 
if (!empty($SupplierId)) {
    $db = dbConn();
     $sql = "SELECT * FROM `suppliercatergories` LEFT JOIN `catergories` ON catergories.CatergoryID=suppliercatergories.CatergoryId WHERE suppliercatergories.SupplierId='$SupplierId'";
    $result = $db->query($sql);

    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
        echo '<option value="">Select Product</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['CatergoryId'] . '">' . $row['CatergoryName'] . '</option>';
        }
    } else {
        echo '<option value="">Catergory Not Selected</option>';
    }
}
?>

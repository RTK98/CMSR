<?php

include '../config.php';
include '../function.php';
extract($_POST);
echo @$CategoryId = $_POST["options"];

if (!empty($CategoryId)) {
    $db = dbConn();
    echo $query = "SELECT "
    . "cat.CatergoryName, "
    . "cat.CatergoryId "
    . "FROM suppliercatergories sc "
    . "LEFT JOIN supplier s ON sc.SupplierId = s.SupplierId "
    . "LEFT JOIN catergories cat ON sc.CatergoryId = cat.CatergoryID "
    . "WHERE sc.SupplierId = '$CategoryId'";
    $result = $db->query($query);

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

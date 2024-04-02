<?php

include '../../config.php';
include '../../function.php';
extract($_POST);
echo @$CategoryId = $_POST["options"];

if (!empty($CategoryId)) {
    $db = dbConn();
    echo $query = "SELECT * FROM products WHERE ProductCatergory = '$CategoryId' AND ProductStatus = 1";
    $result = $db->query($query);

    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
        echo '<option value="">Select Product</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['ProductId'] . '">' . $row['ProductName'] . '</option>';
        }
    } else {
        echo '<option value="">Catergory Not Selected</option>';
    }
}
?>

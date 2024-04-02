<?php

include '../config.php';
include '../function.php';
extract($_POST);
echo $ProvinceId = $_POST["options"];



if (!empty($ProvinceId)) {
    $db = dbConn();
    $sql = "SELECT * FROM districts WHERE province_id='$ProvinceId' ";
    
    $result = $db->query($sql);
    

    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
        echo '<option value="">Select District</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . $row['DistrictName'] . '</option>';
        }
        
    } else {
        echo '<option value="">District Not Selected</option>';
    }
}



?>

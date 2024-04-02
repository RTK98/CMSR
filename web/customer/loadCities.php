<?php

include '../config.php';
include '../function.php';
extract($_POST);
echo $DistrictId = $_POST["options1"];



if (!empty($DistrictId)) {
    $db = dbConn();
    $sql = "SELECT * FROM cities WHERE district_id='$DistrictId' ORDER BY cities.name_en ASC";
    
    $result = $db->query($sql);
    

    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
        echo '<option value="">Select City</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . $row['name_en'] . '</option>';
        }
        
    } else {
        echo '<option value="">City Not Selected</option>';
    }
}



?>

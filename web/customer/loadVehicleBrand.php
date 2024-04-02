<?php

include '../config.php';
include '../function.php';
extract($_POST);
echo $CategoryId = $_POST["options"];

if (!empty($CategoryId)) {
    $db = dbConn();
    $sql = "SELECT * FROM vehiclemodels WHERE VCatergoryName = '$CategoryId' AND Status = 1";

    $result = $db->query($sql);

    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
        echo '<option value="">Select Product</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['VehicleModelsId'] . '">' . ucwords($row['ModelName']) . '</option>';
        }
    } else {
        echo '<option value="">Catergory Not Selected</option>';
    }
}
?>

<?php

include '../config.php';
include '../function.php';
extract($_POST);
echo @$CustomerId = $_POST["options"];

if (!empty($CustomerId)) {
    $db = dbConn();
    echo $query = "SELECT * FROM customervehicles WHERE CustomerID = '$CustomerId'";
    $result = $db->query($query);

    // Generate HTML of state options list 
    if ($result->num_rows > 0) {
        echo '<option value="">Select Vehicle</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['vehicleId'] . '">' . $row['registerLetter'] .' - '. $row['RegistrationNo']. '</option>';
        }
    } else {
        echo '<option value="">Vehicle Not Selected</option>';
    }
}
?>

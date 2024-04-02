<?php

include '../config.php';
include '../function.php';
if (isset($_POST["vehicleId"])) {
    // echo $_POST["vehicleId"];
    extract($_POST);
    $db = dbConn();

    $sql = "SELECT * FROM customervehicles INNER JOIN service ON customervehicles.VehicleType = service.CatergoryName WHERE customervehicles.vehicleId =" . $_POST["vehicleId"];
    $result = $db->query($sql);

    $option = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $option .= '<option id="' . $row["ServiceId"] . '" value="' . $row["ServiceId"] . '">' . $row["ServiceName"] . '</li>';
        }
    } else {
        $option .= '';
    }

    echo $option;
}
?>

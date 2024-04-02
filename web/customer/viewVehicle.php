<?php
include'../header.php';
include'../menu.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 view-vehicle" style='background: white;'>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Vehicles</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addVehicle.php" class="btn btn-sm btn-outline-secondary">Add Vehicle</a>
            </div>
            <div class="btn-group me-2">
                <button class="btn btn-sm btn-primary" onclick="history.back()">Go Back</button>
            </div>
        </div>
    </div>
    <h2>Vehicles</h2>
    <?php
    $db = dbConn();
    $customerid = $_SESSION['CustomerID'];

     $sqlaa = "SELECT cv.vehicleId,"
    . "cv.VehicleImage,"
    . "cv.registerLetter,"
    . "cv.RegistrationNo,"
    . "vm.ModelName "
    . "FROM customervehicles cv "
    . "LEFT JOIN vehiclemodels vm ON cv.VehicleModel=vm.VehicleModelsId "
    . "WHERE CustomerID='$customerid'";
    $resultaa = $db->query($sqlaa);
//                $row = $resultaa->fetch_assoc();
//                var_dump($row);
    ?>
    <div class="row">
        <?php
        if ($resultaa->num_rows > 0) {
            $id = 0;
            while ($row = $resultaa->fetch_assoc()) {
                ?>
                <div class="col-md-4">  
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <img src="<?= SYSTEM_PATH ?>assets/img/myVehicleImage/<?= $row['VehicleImage'] ?>" class="card-img" alt="vehicleImage">
                            </div>
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title"><?= ucwords($row['ModelName']); ?></h5>
                                    <h6><?= $row['registerLetter'] . " - " . $row['RegistrationNo'] ?></h6>
                                    <div class="btn-toolbar btn-toolbar-custom mb-2 mb-md-0">
<!--                                        <div class="btn-group me-2">
                                            <a href="viewVehicleDetails.php" class="btn-sm btn btn-primary">View Details</a>
                                        </div>-->
                                        <form method="post"  action="viewAppointmentVehicle.php">
                                            <div class="btn-group me-2">
                                                <input type="hidden" name="CustomerId" value="<?= $customerid ?>" >
                                                <input type="hidden" name="VehicleId" value="<?= $vehicleId = $row['vehicleId']; ?>" >
                                                <button type='submit' name="action" value='viewAppointment' class="btn-sm btn btn-success">Appointment History</button>
                                            </div>
                                        </form>
<!--                                        <div class="btn-group me-2">
                                            <a href="viewRepairHistory.php" class="btn-sm btn btn-warning">Repair History</a>
                                        </div>-->
<!--                                        <div class="btn-group me-2">
                                            <a href="#" class="btn-sm btn btn-danger">Delete Vehicle</a>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }$id = 0;
        }
        ?>
    </div>
</div>
</main>
<?php include'../footer.php'; ?>

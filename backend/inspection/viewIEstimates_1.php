<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Inspections</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addInspectionRegCustomer.php" class="btn btn-sm btn-outline-secondary">Add Registered Inspection</a>
            </div>
            <div class="btn-group me-2">
                <a href="addInspection.php" class="btn btn-sm btn-outline-secondary">Add Non Reg Customer Inspection</a>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <h2>Inspection List</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT * FROM inspections";
        $result = $db->query($sql); // Run Query"
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">inspection No</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Vehicle Category</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Inspection Status</th>
                    <th scope="col">Estimate Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $row['InspectionNo'] ?></td>
                            <td><?php
                                $vehicleId = $row['VehicleNo'];
                                $db = dbconn();
                                $sqlVehicle = "SELECT VehicleModel,VehicleType,registerLetter,RegistrationNo FROM customervehicles WHERE vehicleId='$vehicleId'";
                                $resultVehicle = $db->query($sqlVehicle); // Run Query"
                                $rowVehicle = $resultVehicle->fetch_assoc();
                                ?>
                                <?= $rowVehicle['registerLetter'] . ' - ' . $rowVehicle['RegistrationNo'] ?>
                            </td>
                            <td>
                                <?php
                                $vehicleType = $rowVehicle['VehicleType'];
                                $sqlVCatergory = "SELECT CatergoryName FROM vehicle_catergories WHERE VCatergoryId='$vehicleType'";
                                $resultVCatergory = $db->query($sqlVCatergory); // Run Query"
                                $rowVCatergory = $resultVCatergory->fetch_assoc();
                                ?>
                                <?= $rowVCatergory['CatergoryName'] ?>
                            </td>
                            <td><?php
                                $CustomerId = $row['CustomerName'];
                                $db = dbconn();
                                $sqlCustomer = "SELECT FirstName,LastName FROM customer WHERE CustomerID='$CustomerId'";
                                $resultCustomer = $db->query($sqlCustomer); // Run Query"
                                $rowCustomer = $resultCustomer->fetch_assoc();
                                ?>
                                <?= $rowCustomer['FirstName'] . ' ' . $rowCustomer['LastName'] ?>
                            </td>
                            <td>
                                <?php
                                $InspectionStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($InspectionStatus) {
                                    case 1:
                                        $statusDescription = "Inspection Done";
                                        $statusColor = "btn btn-warning btn-sm";
                                        break;
                                    case 2:
                                        $statusDescription = "Customer Selected Item";
                                        $statusColor = "btn btn-success btn-sm";
                                        break;
                                    case 3:
                                        $statusDescription = "Estimate Sent";
                                        $statusColor = "btn btn-primary btn-sm";
                                        break;
                                    case 4:
                                        $statusDescription = "Estimate Confirmed";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    case 5:
                                        $statusDescription = "Repair Pending";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    case 6:
                                        $statusDescription = "Repair In progress";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    case 7:
                                        $statusDescription = "Repair Completed";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    case 8:
                                        $statusDescription = "Repair Completed";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "btn btn-secondary btn-sm";
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <td>

                            </td>
                            <td>
                                <form method='post' action="customerSelectedRepairs.php" class="btn-group">
                                    <input type="hidden" name="InspectionId" value="<?= $row['InspectionId'] ?>">
                                    <button class="btn btn-dark btn-sm" type="submit" name="action" value="edit">Add Requirements</button>
                                </form>
                                <form method='post' action="estimate.php" class="btn-group" >
                                    <input type="hidden" name="InspectionId" value="<?= $row['InspectionId'] ?>">
                                    <button class="btn btn-success btn-sm" type="submit" name="action" value="add">Add Estimate</button>
                                </form>
                                <form method='post' action="InspectionReport.php" class="btn-group">
                                    <input type="hidden" name="InspectionId" value="<?= $row['InspectionId'] ?>">
                                    <button class="btn btn-primary btn-sm" type="submit" name="action" value="view">View</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $n++;
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
</main>
<?php include'../footer.php'; ?>
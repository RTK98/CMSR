<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Inspections</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <!--            <div class="btn-group me-2">
                            <a href="addInspectionRegCustomer.php" class="btn btn-sm btn-outline-secondary">Add Registered Inspection</a>
                        </div>
                        <div class="btn-group me-2">
                            <a href="addInspection.php" class="btn btn-sm btn-outline-secondary">Add Non Reg Customer Inspection</a>
                        </div>-->
<!--            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>-->
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
                                        $statusColor = "badge bg-warning text-dark";
                                        $createJobCardButton = false;
                                        $showViewButton = true;
                                        break;
                                    case 2:
                                        $statusDescription = "Estimate Confirmed";
                                        $statusColor = "badge bg-success";
                                        $createJobCardButton = true;
                                        $showViewButton = true;
                                        break;
                                    case 3:
                                        $statusDescription = "Repair Pending";
                                        $statusColor = "badge bg-danger";
                                        $createJobCardButton = false;
                                        $showViewButton = true;
                                        break;
                                    case 4:
                                        $statusDescription = "Repair In progress";
                                        $statusColor = "badge bg-secondary";
                                        $createJobCardButton = false;
                                        $showViewButton = true;
                                        break;
                                    case 5:
                                        $statusDescription = "Repair Completed";
                                        $statusColor = "badge bg-primary";
                                        $createJobCardButton = false;
                                        $showViewButton = true;
                                        break;
                                    case 6:
                                        $statusDescription = "Inspection Fee Paid";
                                        $statusColor = "badge bg-danger";
                                        $createJobCardButton = false;
                                        $showViewButton = true;
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
                                <?php if ($showViewButton) { ?>
                                    <form method='post' action="viewInspectionReport.php" class="btn-group">
                                        <input type="hidden" name="InspectionId" value="<?= $row['InspectionId'] ?>">
                                        <button class="btn btn-dark btn-sm" type="submit" name="action" value="view">View</button>
                                    </form>
                                <?php } ?>
                                <?php if ($createJobCardButton) { ?>
                                    <form method='post' action="<?= SYSTEM_PATH ?>jobCard/addJobCardRepair.php" class="btn-group">
                                        <input type="hidden" name="InspectionId" value="<?= $row['InspectionId'] ?>">
                                        <button class="btn btn-primary btn-sm" type="submit" name="action" value="add">Create Job Card</button>
                                    </form>
                                <?php } ?>
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
<?php include'../../footer.php'; ?>
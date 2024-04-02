<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Inspections</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addInspectionRegCustomer.php" class="btn btn-sm btn-dark">Add Inspection</a>
            </div>
<!--            <div class="btn-group me-2">
                <a href="addInspection.php" class="btn btn-sm btn-outline-secondary">Add Non Reg Customer Inspection</a>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>-->
        </div>
    </div>
    <h2>Inspection List</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT est.EstimateID,"
                . "est.EstimateNo,"
                . "est.AddDate,"
                . "est.InspectionId,"
                . "est.EstimateStatus,"
                . "ins.InspectionNo,"
                . "cv.registerLetter,"
                . "cv.RegistrationNo,"
                . "vc.CatergoryName,"
                . "cus.FirstName,"
                . "cus.LastName FROM estimate est "
                . "LEFT JOIN inspections ins ON ins.InspectionId=est.InspectionId "
                . "LEFT JOIN customervehicles cv ON ins.VehicleNo=cv.vehicleId "
                . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType= vc.VCatergoryId "
                . "LEFT JOIN customer cus ON ins.CustomerName=cus.CustomerID "
                . "ORDER BY est.AddDate DESC;";
        $result = $db->query($sql); // Run Query"
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Estimate No</th>
                    <th scope="col">Inspection No</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Vehicle Category</th>
                    <th scope="col">Customer Name</th>
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
                            <td><?= $row['EstimateNo'] ?></td>
                            <td><?= $row['InspectionNo'] ?></td>
                            <td> <?= $row['registerLetter'] . ' - ' . $row['RegistrationNo'] ?></td>
                            <td><?= $row['CatergoryName'] ?> </td>
                            <td><?= $row['FirstName'] . ' ' . $row['LastName'] ?>
                            </td>
                            <td>
                                <?php
                                $EstimateStatus = $row['EstimateStatus'];
                                $statusDescription = '';

                                switch ($EstimateStatus) {
                                    case 1:
                                        $statusDescription = "Estimate Confirmed";
                                        $statusColor = "badge bg-success";
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "badge bg-secondary";
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <td>
                                <form method='post' action="EstimateReport.php" class="btn-group">
                                    <input type="hidden" name="EstimateId" value="<?= $row['EstimateID'] ?>">
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
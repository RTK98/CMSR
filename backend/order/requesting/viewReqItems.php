<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Orders</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
<!--            <div class="btn-group me-2">
                <a href="reqForm.php" class="btn btn-sm btn-outline-secondary">Add Orders</a>
            </div>-->
<!--            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary"> View Black List Suppliers</button>
            </div>-->
<!--            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>-->
        </div>
    </div>
    <h2>Order List by Technician's</h2>
    <div class="table-responsive">
        <?php
        $userId = $_SESSION['userId'];
        $db = dbconn();
        $sql = "SELECT od.id AS 'OrderId',"
                . "od.orderNo,"
                . "od.AddDate,"
                . "od.Status,"
                . "jbr.AppointmentId,"
                . "jbr.Inspectionid,"
                . "jbr.id,jbr."
                . "JobCardNo,"
                . "cus.FirstName,"
                . "cus.LastName,"
                . "us.FirstName AS 'EmpFirstName',"
                . "us.LastName AS 'EmpLastName',"
                . " vc.CatergoryName,cv.registerLetter,"
                . "cv.RegistrationNo FROM orders od "
                . "LEFT JOIN job_cards jbr ON jbr.id=od.JobCardNo "
                . "LEFT JOIN customer cus ON cus.CustomerID=od.CustomerName "
                . "LEFT JOIN customervehicles cv ON cv.vehicleId=od.VehicleNo "
                . "LEFT JOIN users us ON us.UserId=od.AddUser "
                . "LEFT JOIN vehicle_catergories vc ON vc.VCatergoryId=cv.VehicleType "
                . "ORDER by od.id AND od.AddDate DESC";
        $result = $db->query($sql); // Run Query
//        print_r($result);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order No</th>
                    <th scope="col">Job card No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Vehicle Type</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
//                        print_r($row)
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $row['orderNo'] ?></td>
                            <td><?= $row['JobCardNo'] ?></td>
                            <td><?= $row['FirstName'] . ' ' . $row['LastName'] ?></td>
                            <td><?= $row['registerLetter'] . '-' . $row['RegistrationNo'] ?></td>
                            <td><?= $row['CatergoryName'] ?></td>
                            <td><?= $row['AddDate'] ?></td>
                            <td><?php
                                $OrderStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($OrderStatus) {
                                    case 1:
                                        $statusDescription = "Order Request Sent";
                                        $statusColor = "badge rounded-pill bg-warning text-dark";
                                        $showViewBtn = true;
                                        $showReleaseItems = true;
                                        break;
                                    case 2:
                                        $statusDescription = "Item Recieved";
                                        $statusColor = "badge rounded-pill bg-success";
                                        $showViewBtn = true;
                                        $showReleaseItems = false;
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "badge rounded-pill bg-secondary";
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span></td>
                            <?php if ($showViewBtn) { ?>
                                <td>
                                    <form method='post' action="viewOrderItems.php">
                                        <input type="hidden" name="JobCardId" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="OrderId" value="<?= $row['OrderId'] ?>">
                                        <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <input type="hidden" name="Inspectionid" value="<?= $row['Inspectionid'] ?>">
                                        <button type="hidden" name="action" value="edit" class="btn btn-sm btn-primary">View Items</button>
                                    </form>
                                </td>
                            <?php } ?>
                            <?php if ($showReleaseItems) { ?>
                                <td>

                                    <?php
//                                $OrderStatus;
//                                if ($OrderStatus == 2) {
//                                    $disabled = "disabled";
//                                } else {
//                                    $disabled = "";
//                                }
                                    ?>
                                    <form method='post' action="../../jobCard/editJobCardStockKeeper.php">
                                        <input type="hidden" name="OrderId" value="<?= $row['OrderId'] ?>">
                                        <input type="hidden" name="JobCardId" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <input type="hidden" name="Inspectionid" value="<?= $row['Inspectionid'] ?>">
                                        <button type="submit" name="action" value="release" class="btn btn-sm btn-primary">Release Items</button>
                                    </form>
                                </td>
                            <?php } ?>
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

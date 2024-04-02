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
    <h2>Release Items</h2>
    <div class="table-responsive">
        <?php
        $userId = $_SESSION['userId'];
        $db = dbconn();
         $sql = "SELECT rel.ReleaseItemId,"
        . "rel.ReleaseNo,"
        . "rel.AddDate,"
        . "rel.Status,"
        . "od.orderNo,"
        . "jbr.JobCardNo,"
        . "jbr.id,"
        . "ins.InspectionId,"
        . "jbr.AppointmentId,"
        . "app.AppointmentNo,"
        . "ins.InspectionNo,"
        . "cus.FirstName,"
        . "cus.LastName,"
        . "cv.registerLetter,"
        . "cv.RegistrationNo FROM relaeseitems rel "
        . "LEFT JOIN orders od ON rel.OrderId=od.id "
        . "LEFT JOIN job_cards jbr ON od.JobCardNo=jbr.id "
        . "LEFT JOIN inspections ins ON rel.InpsectionId=ins.InspectionId "
        . "LEFT JOIN appointments app ON jbr.AppointmentId=app.AppointmentId "
        . "LEFT JOIN customer cus ON rel.CustomerName=cus.CustomerID "
        . "LEFT JOIN customervehicles cv ON rel.VehicleNo=cv.vehicleId "
        . "WHERE rel.Status='1' ORDER BY rel.AddDate DESC";
        $result = $db->query($sql); // Run Query
//        print_r($result);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Release No</th>
                    <th scope="col">Order No</th>
                    <th scope="col">Description</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Release Date</th>
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
                            <td><?= $row['ReleaseNo'] ?></td>
                            <td><?= $row['orderNo'] ?></td>
                            <td><?= $row['JobCardNo'] ?></td>
                            <td><?= $row['FirstName'] . '' . $row['LastName'] ?></td>
                            <td><?= $row['registerLetter'] . '-' . $row['RegistrationNo'] ?></td>
                            <td><?= $row['AddDate'] ?></td>
                            <td><?php
                                $RelItemStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($RelItemStatus) {
                                    case 1:
                                        $statusDescription = "Order Released";
                                        $statusColor = "btn btn-success btn-sm";
                                        break;
                                    case 0:
                                        $statusDescription = "Not Recieved";
                                        $statusColor = "btn btn-success btn-sm";
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "btn btn-secondary btn-sm";
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span></td>
                            <td>
                                <form method='post' action="viewReleasedAll.php">
                                    <input type="hidden" name="jobCardsRepairId" value="  <?= $row['id'] ?>">
                                    <input type="hidden" name="JobCardsInspetionId" value="<?= $row['InspectionId'] ? $row['InspectionId'] : null ?>">
                                    <input type="hidden" name="JobCardsAppointmentId" value="<?= $row['AppointmentId'] ? $row['AppointmentId'] : null ?>">
                                    <input type="hidden" name="ReleaseItemId" value="<?= $row['ReleaseItemId'] ?>">
                                    <button type="submit" name="action" value="edit" class="btn btn-sm btn-primary">View Items</button>
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
<?php include'../../footer.php'; ?>

<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Job Cards</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
             <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>jobCard/viewReqItemRepairTech.php" class="btn btn-sm btn-dark">Request Items</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>order/requesting/viewMyReqItems.php" class="btn btn-sm btn-dark">My Orders</a>
            </div>
              <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>jobCard/viewJobCardRepairTech.php" class="btn btn-sm btn-dark">My Orders</a>
            </div>
        </div>
    </div>
    <h2>Job Card List</h2>
    <div class="table-responsive">
        <?php
        $userId = $_SESSION['userId'];
        $db = dbconn();
        $sql = "SELECT jbr.AddDate,"
                . "jbr.JobCardNo,"
                . "jbr.id,"
                . "jbr.empId,"
                . "jbr.Inspectionid,"
                . "jbr.AppointmentId,"
                . "jbr.AppointmentNo,"
                . "jbr.InspectionNo,"
                . "jbr.Status,"
                . "cus.FirstName,"
                . "cus.LastName,"
                . "cv.registerLetter,"
                . "cv.RegistrationNo "
                . "FROM job_cards jbr "
                . "LEFT JOIN customer cus ON cus.CustomerID=jbr.CustomerId "
                . "LEFT JOIN customervehicles cv ON jbr.VehicleNo=cv.vehicleId "
                . "WHERE jbr.Status='2' AND jbr.empId='$userId'"
                . "ORDER BY jbr.AddDate DESC";
        $result = $db->query($sql); // Run Query
//        print_r($result);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Job Card No</th>
                    <th scope="col">Job Card Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
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
                            <td><?= $row['JobCardNo'] ?></td>
                            <td><?= $row['AddDate'] ?></td>
                            <td> <?=
                                @$row['AppointmentNo'];
                                @$row['InspectionNo'];
                                ?></td>
                            <td> <?= $row['FirstName'] . ' ' . $row['LastName'] ?></td>
                            <td> <?= $row['registerLetter'] . "-" . $row['RegistrationNo']; ?> </td>
                            <td><?php
                                $JobCardStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($JobCardStatus) {
                                    case 2:
                                        $statusDescription = "Repair in Progress";
                                        $statusColor = "badge rounded-pill bg-warning text-dark";
                                        break;
                                    case 3:
                                        $statusDescription = "Requested Items";
                                        $statusColor = "badge rounded-pill bg-info text-dark";
                                        break;
                                    case 5:
                                        $statusDescription = "Received Items";
                                        $statusColor = "badge rounded-pill bg-primary";
                                        break;
                                    case 6:
                                        $statusDescription = "Finished";
                                        $statusColor = "badge rounded-pill bg-success";
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "badge rounded-pill bg-secondary";
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>

                            </td>
                            <td>
                                <form method='post' action="../order/requesting/reqForm.php">
                                    <input type="hidden" name="jobCardId" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="AppointmentId" value="<?= @$row['AppointmentId'] ?>">
                                    <input type="hidden" name="InspectionNo" value="<?= @$row['Inspectionid'] ?>">
                                    <button type="submit" name="action" value="edit" class="btn btn-sm btn-primary">Request Items</button>
                                </form>

                            </td>
                        </tr>
                        <?php
                        $n++;
                    }
                } else {
                    // If no results are found, display a message in a single row
                    ?>
                    <tr>
                        <td colspan="8" style="text-align: center; color:red">No results found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php include'../footer.php'; ?>
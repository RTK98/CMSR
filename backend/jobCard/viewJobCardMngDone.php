<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Job Cards</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>jobCard/viewJobCardManager.php" class="btn btn-sm btn-dark">Not Paid Job Cards</a>
            </div>
        </div>
    </div>
    <h2>Job Card List</h2>
    <div class="table-responsive">
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'edit') {
            @$InspectionNo;
            @$AppointmentId;
            $jobCardId;
            if (@$InspectionNo) {
                $db = dbconn();
                $sql = "UPDATE inspections SET Status='6' WHERE InspectionId='$InspectionNo' ";
                $result = $db->query($sql);

                $sql2 = "UPDATE job_cards SET Status='7' WHERE id='$jobCardId' ";
                $result2 = $db->query($sql2);
            }
            if (@$AppointmentId) {
                $db = dbconn();
                $sql = "UPDATE job_cards SET Status='7' WHERE id='$jobCardId' ";
                $result = $db->query($sql);
            }
        }
        ?>



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
                . "WHERE jbr.Status='7'"
                . "ORDER BY jbr.AddDate DESC";
        $result = $db->query($sql); // Run Query
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
                            <td> <?php
                                if (@$row['AppointmentNo']) {
                                    echo $row['AppointmentNo'];
                                } else {
                                    echo $row['InspectionNo'];
                                }
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
                                        $showPaidButton = false;
                                        $showViewButton = false;
                                        break;
                                    case 3:
                                        $statusDescription = "Requested Items";
                                        $statusColor = "badge rounded-pill bg-info text-dark";
                                        $showPaidButton = false;
                                        $showViewButton = false;
                                        break;
                                    case 5:
                                        $statusDescription = "Received Items";
                                        $statusColor = "badge rounded-pill bg-primary";
                                        $showPaidButton = false;
                                        $showViewButton = false;
                                        break;
                                    case 6:
                                        $statusDescription = "Finished";
                                        $statusColor = "badge rounded-pill bg-success";
                                        $showPaidButton = true;
                                        $showViewButton = true;
                                        break;
                                    case 7:
                                        $statusDescription = "Paid";
                                        $statusColor = "badge rounded-pill bg-dark";
                                        $showPaidButton = false;
                                        $showViewButton = true;
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "badge rounded-pill bg-secondary";
                                        $showPaidButton = false;
                                        $showViewButton = false;
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <?php if ($showViewButton) { ?>
                                <td>
                                    <form method='post' action="JobCardDetailsCashier.php">
                                        <input type="hidden" name="jobCardId" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="AppointmentId" value="<?= @$row['AppointmentId'] ?>">
                                        <input type="hidden" name="InspectionNo" value="<?= @$row['Inspectionid'] ?>">
                                        <button type="submit" name="action" value="edit" class="btn btn-sm btn-primary">View</button>
                                    </form>
                                </td>
                            <?php } ?>
                            <?php if ($showPaidButton) { ?>
                                <td>
                                    <form method='post' action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
                                        <input type="hidden" name="jobCardId" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="AppointmentId" value="<?= @$row['AppointmentId'] ?>">
                                        <input type="hidden" name="InspectionNo" value="<?= @$row['Inspectionid'] ?>">
                                        <button type="hidden" name="action" value="edit" class="btn btn-sm btn-dark">Paid</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php
                        $n++;
                    }
                } else {
                    // If no results are found, display a message in a single row
                    ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color:red">No results found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php include'../footer.php'; ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Job Cards</h1>
    </div>
    <hr>
    <h2>Job Card Alerts - Supervision</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT jba.JobCardAlertId,"
                . "jba.AppointmentId,"
                . "jba.InspectionId,"
                . "jba.Status,"
                . "jba.AddDate,"
                . "jba.AddTime,"
                . "ins.InspectionNo,"
                . "app.AppointmentNo,"
                . "u.FirstName,"
                . "u.LastName,"
                . "jb.JobCardNo,"
                . "cv.registerLetter,"
                . "cv.RegistrationNo,"
                . "vc.CatergoryName FROM jobcardalerts jba "
                . "LEFT JOIN inspections ins ON ins.InspectionId=jba.InspectionId "
                . "LEFT JOIN appointments app ON app.AppointmentId=jba.AppointmentId "
                . "LEFT JOIN job_cards jb ON jb.id=jba.JObCardId "
                . "LEFT JOIN users u ON u.UserId=jba.AddUser "
                . "LEFT JOIN customervehicles cv ON cv.vehicleId=jb.VehicleNo "
                . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                . "ORDER BY jba.AddDate AND jba.AddTime DESC";
        $result = $db->query($sql); // Run Query
//        print_r($result);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Job Card No</th>
                    <th scope="col">INS NO / APP NO</th>
                    <th scope="col">Alert Date</th>
                    <th scope="col">Alert Time</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Status</th>
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
                            <td><?php if(!empty($row['AppointmentId'])){
                                 echo $row['AppointmentNo'];
                            }else{
                                  echo $row['InspectionNo'];
                            }?> </td>
                            <td><?= $row['AddDate'] ?></td>
                            <td><?= $row['AddTime'] ?></td>
                            <td> <?= $row['FirstName'] . ' ' . $row['LastName'] ?></td>
                            <td> <?= $row['registerLetter'] . "-" . $row['RegistrationNo']; ?> </td>
                            <td><?php
                                $JobCardStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($JobCardStatus) {
                                    case 1:
                                        $statusDescription = "Need To Review";
                                        $statusColor = "badge rounded-pill bg-warning text-dark";
                                        break;
                                    case 2:
                                        $statusDescription = "Review Completed";
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
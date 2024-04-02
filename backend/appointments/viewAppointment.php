<?php $appointment = "active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Appointments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
    <section>
        <div class="row">
            <div class="col-md-3">
                <?php
                $current = date("Y-m-d");
                $db = dbconn();
                $sqlToday = "SELECT * FROM appointments WHERE AppDate='$current'";
                $resultToday = $db->query($sqlToday);
                if ($resultToday->num_rows > 0) {
                    $todayCount = $resultToday->num_rows;
                } else {
                    $todayCount = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>appointments/todayAppointment" style="display: none;" id="hidden-link"></a>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="window.location.href = '<?= SYSTEM_PATH ?>appointments/todayAppointment';">
                    <div class="card-body">
                        <h5 class="card-title">Today Appointments</h5>
                        <h2><?= $todayCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/schedule.png">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                $tomorrow = date("Y-m-d", strtotime('+1 day'));
                $db = dbconn();
                $sqlTomorrow = "SELECT * FROM appointments WHERE AppDate='$tomorrow'";
                $resultTomorrow = $db->query($sqlTomorrow);
                if ($resultTomorrow->num_rows > 0) {
                    $tomorrowCount = $resultTomorrow->num_rows;
                } else {
                    $tomorrowCount = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>appointments/tommorrowAppointment" style="display: none;" id="hidden-link"></a>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="window.location.href = '<?= SYSTEM_PATH ?>appointments/tommorrowAppointment';">
                    <div class="card-body">
                        <h5 class="card-title">Tommorow Appointments</h5>
                        <h2><?= $tomorrowCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/schedule.png">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                $db = dbconn();
                $sqlApproved = "SELECT * FROM appointments WHERE appointmentStatus='2'";
                $resultApproved = $db->query($sqlApproved);
                if ($resultApproved->num_rows > 0) {
                    $ApprovedCount = $resultApproved->num_rows;
                } else {
                    $ApprovedCount = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>appointments/ApprovedAppointment.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="window.location.href = '<?= SYSTEM_PATH ?>appointments/ApprovedAppointment.php';">
                    <div class="card-body">
                        <h5 class="card-title">Approved Appointments</h5>
                        <h2><?= $ApprovedCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/schedule.png">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                $db = dbconn();
                $sqlCanceldApp = "SELECT * FROM appointments WHERE appointmentStatus='4'";
                $resultCanceldApp = $db->query($sqlCanceldApp);
                if ($resultCanceldApp->num_rows > 0) {
                    $CanceledCount = $resultCanceldApp->num_rows;
                } else {
                    $CanceledCount = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>appointments/CanceledAppointment.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="window.location.href = '<?= SYSTEM_PATH ?>appointments/CanceledAppointment.php';">
                    <!--                    <div class="card-header">Canceled  Appointments</div>-->
                    <div class="card-body">
                        <h5 class="card-title">Canceled  Appointments</h5>
                        <h2><?= $CanceledCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/schedule.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <h2> Today Appointments</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT ap.AppointmentId,ap.AppointmentNo,ap.AppDate,ap.appointmentStatus,cus.FirstName,cus.LastName,cv.registerLetter,cv.RegistrationNo,vc.CatergoryName,tms.TimeSlotStart,tms.TimeSlotEnd,sv.ServiceName FROM appointments ap "
                . "LEFT JOIN customer cus ON ap.CustomerID = cus.CustomerID LEFT JOIN customervehicles cv ON ap.VehicleNo=cv.vehicleId "
                . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                . "LEFT JOIN timeslots tms ON ap.TimeSlotStart=tms.TimeSlotId "
                . "LEFT JOIN service sv ON ap.ServiceType=sv.ServiceId WHERE ap.AppDate='$current'";
        $result = $db->query($sql); // Run Query
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Appoinment No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Vehicle No</th>
                    <th scope="col">Vehicle Type</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Time Slot</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Appointment Status</th>
                    <th scope="col">Action</th>
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
                            <td><?= $row['AppointmentNo'] ?></td>
                            <td>
                                <?= $row['FirstName'] . ' ' . $row['LastName'] ?>
                            </td>
                            <td>
                                <?= $row['registerLetter'] . "-" . $row['RegistrationNo']; ?>
                            </td>
                            <!--VehicleType Find-->
                            <td>
                                <?= $row['CatergoryName'] ?>
                            </td>
                            <td><?= $row['AppDate'] ?></td>
                            <td>
                                <?= $row['TimeSlotStart'] . " " . "-" . " " . $row['TimeSlotEnd']; ?>

                            </td>
                            <td>
                                <?= $row['ServiceName'] ?>

                            </td>
                            <td>
                                <?php
                                $appointmentStatus = $row['appointmentStatus'];
                                $statusDescription = '';

                                switch ($appointmentStatus) {
                                    case 1:
                                        $statusDescription = "Pending";
                                        $statusColor = "badge bg-warning text-dark btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = true;

                                        //timegap validating

                                        $bookedDate = $row['AppDate'];
                                        $DateBooked = strtotime($bookedDate);
                                        $currentdate = date('Y-m-d');
                                        $DateCurrent = strtotime($currentdate);
                                        $prev_date1 = date('Y-m-d', strtotime($currentdate . ' -1 day'));
                                        if ($DateBooked < $DateCurrent) {
                                            $showCreateJobCard = false;
                                        }
                                        else if ($DateBooked == $DateCurrent) {
                                            $showCreateJobCard = true;
                                        }
                                        break;
                                    case 2:
                                        $statusDescription = "In Porgress";
                                        $statusColor = "badge bg-success btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = false;
                                        break;
                                    case 3:
                                        $statusDescription = "Complete";
                                        $statusColor = "badge bg-primary btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = false;
                                        break;
                                    case 4:
                                        $statusDescription = "Canceled";
                                        $statusColor = "badge bg-danger btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = false;
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "badge bg-secondary btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = false;
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <?php if ($showViewBill) { ?>
                                <td>
                                    <form method='post' action="appViewBill.php" class="btn-group">
                                        <input type="hidden" name="appointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <button type="submit" class="btn btn-primary" name="action" value="viewBill" <?= @$disabled ?>>View Bill</button>
                                    </form>
                                </td>
                            <?php } ?>
                            <?php if ($showCreateJobCard) { ?>
                                <td>
                                    <form method='post' action="../jobCard/addJobCard.php">
                                        <input type="hidden" name="TimeSlotStart" value="<?= $row['TimeSlotStart'] ?>">
                                        <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <button type="submit" class="btn btn-success" name="action" value="edit"<?= @$disabled ?>>Create Job Card</button>
                                    </form>
                                </td>
                            <?php } ?>
                            <?php if ($showCancelButton) { ?>
                                <td>
                                    <form method='post' action="appCancel.php">
                                        <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <button type="submit" class="btn btn-danger" name="action" value="delete" <?= @$disabled ?>>Cancel</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php
                        $n++;
                    }
                } else {
                    echo'<td></td>'
                    . '<td colspan="5"><strong><h5 class="btn btn-warning" style="align-items:center;">Today No Appointments Found</h5></strong></td>'
                    . '<td></td>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>
    <h2> All Appointments</h2>


    <?php
    // Check if filters are set
    $filterDate = isset($_POST['filter_date']) ? $_POST['filter_date'] : '';
    //$filterNIC = isset($_POST['filter_nic']) ? $_POST['filter_nic'] : '';
    // Build the SQL query
    $sql = "SELECT ap.AppointmentId,ap.AppointmentNo,ap.AppDate,ap.appointmentStatus,cus.FirstName,cus.LastName,cv.registerLetter,cv.RegistrationNo,vc.CatergoryName,tms.TimeSlotStart,tms.TimeSlotEnd,sv.ServiceName FROM appointments ap "
            . "LEFT JOIN customer cus ON ap.CustomerID = cus.CustomerID LEFT JOIN customervehicles cv ON ap.VehicleNo=cv.vehicleId "
            . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
            . "LEFT JOIN timeslots tms ON ap.TimeSlotStart=tms.TimeSlotId "
            . "LEFT JOIN service sv ON ap.ServiceType=sv.ServiceId";

    // Add the filter conditions if dates or NIC are provided
    if (!empty($filterDate)) {
        // Escape the input to prevent SQL injection
        $filterDate = mysqli_real_escape_string($db, $filterDate);

        // Append the filter condition to the SQL query
        $sql .= " WHERE AppDate = '$filterDate'";
    }

//    if (!empty($filterNIC)) {
//        // Escape the input to prevent SQL injection
//        $filterNIC = mysqli_real_escape_string($db, $filterNIC);
//
//        // Append the filter condition to the SQL query
//        $sql .= " AND Nic = '$filterNIC'";
//    }

    $result = $db->query($sql);
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <label for="filter_date">Filter by Joined Date:</label>
        <input type="date" name="filter_date" id="filter_date" value="<?php echo $filterDate; ?>">
        <!--        <label for="filter_nic">Filter by NIC:</label>
                <input type="text" name="filter_nic" id="filter_nic" value="<?php echo $filterNIC; ?>">-->
        <button type="submit">Filter</button>
    </form>
    <div class="table-responsive">
        <?php
//        $db = dbconn();
//        $sql = "SELECT * FROM appointments";
//        $result = $db->query($sql); // Run Query
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Appoinment No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Vehicle No</th>
                    <th scope="col">Vehicle Type</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Time Slot</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Appointment Status</th>
                    <th scope="col">Action</th>
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
                            <td><?= $row['AppointmentNo'] ?></td>
                            <td>
                                <?= $row['FirstName'] . ' ' . $row['LastName'] ?>
                            </td>
                            <td>
                                <?= $row['registerLetter'] . "-" . $row['RegistrationNo']; ?>
                            </td>
                            <!--VehicleType Find-->
                            <td>
                                <?= $row['CatergoryName'] ?>
                            </td>
                            <td><?= $row['AppDate'] ?></td>
                            <td>
                                <?= $row['TimeSlotStart'] . " " . "-" . " " . $row['TimeSlotEnd']; ?>

                            </td>
                            <td>
                                <?= $row['ServiceName'] ?>

                            </td>
                            <td>
                                <?php
                                $appointmentStatus = $row['appointmentStatus'];
                                $statusDescription = '';

                                switch ($appointmentStatus) {
                                    case 1:
                                        $statusDescription = "Pending";
                                        $statusColor = "badge bg-warning text-dark btn-sm";
                                        $showViewBill = false;
                                       $showCreateJobCard = false;
                                        $showCancelButton = true;

                                        //timegap validating

                                        $bookedDate = $row['AppDate'];
                                        $DateBooked = strtotime($bookedDate);
                                        $currentdate = date('Y-m-d');
                                        $DateCurrent = strtotime($currentdate);
                                        $prev_date1 = date('Y-m-d', strtotime($currentdate . ' -1 day'));
                                        if ($DateBooked < $DateCurrent) {
                                            $showCreateJobCard = false;
                                        }
                                        else if ($DateBooked == $DateCurrent) {
                                            $showCreateJobCard = true;
                                        }
                                        break;
                                    case 2:
                                        $statusDescription = "In Porgress";
                                        $statusColor = "badge bg-success btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = false;
                                        break;
                                    case 3:
                                        $statusDescription = "Complete";
                                        $statusColor = "badge bg-primary btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = false;
                                        break;
                                    case 4:
                                        $statusDescription = "Canceled";
                                        $statusColor = "badge bg-danger btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = false;
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "badge bg-secondary btn-sm";
                                        $showViewBill = false;
                                        $showCreateJobCard = false;
                                        $showCancelButton = false;
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <?php if ($showViewBill) { ?>
                                <td>
                                    <form method='post' action="appViewBill.php" class="btn-group">
                                        <input type="hidden" name="appointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <button type="submit" class="btn btn-primary btn-sm" name="action" value="viewBill" <?= @$disabled ?>>View Bill</button>
                                    </form>
                                </td>
                            <?php } ?>
                            <?php if ($showCreateJobCard) { ?>
                                <td>
                                    <form method='post' action="../jobCard/addJobCard.php">
                                        <input type="hidden" name="TimeSlotStart" value="<?= $row['TimeSlotStart'] ?>">
                                        <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <button type="submit" class="btn btn-success btn-sm" name="action" value="edit"<?= @$disabled ?>>Create Job Card</button>
                                    </form>
                                </td>
                            <?php } ?>
                            <?php if ($showCancelButton) { ?>
                                <td>
                                    <form method='post' action="appCancel.php">
                                        <input type="hidden" name="appointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="delete" <?= @$disabled ?>>Cancel</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php
                        $n++;
                    }
                } else {
                    echo'<td></td>'
                    . '<td colspan="5"><strong><h5 class="btn btn-warning" style="align-items:center;">No Result Found</h5></strong></td>'
                    . '<td></td>';
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php include'../footer.php'; ?>
<script>
    function redirectToPage(url) {
        window.location.href = url;
    }

</script>
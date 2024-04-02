<?php ob_start(); ?>
<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Appointments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addAppointment.php" class="btn btn-sm btn-outline-secondary">Add Appointments</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
<?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {
        $db = dbConn();
        $sql = "SELECT * FROM appointments WHERE AppointmentId='$AppointmentId'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $AppointmentNo = $row["AppointmentNo"];
        $CustomerID = $row["CustomerID"];
        $VehicleNo = $row["VehicleNo"];
        $AppDate = $row["AppDate"];
    }
    ?>
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
                <a href="todayAppointment.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="document.getElementById('hidden-link').click();">
                    <div class="card-body">
                        <h5 class="card-title">Today Appointments</h5>
                        <h2><?= $todayCount ?></h2>
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
                <a href="tommorrowAppointment.php" style="display: none;" id="hidden-linkTomrrrow "></a>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="document.getElementById('hidden-linkTomrrrow').click();">
                    <div class="card-body">
                        <h5 class="card-title">Tommorow Appointments</h5>
                        <h2><?= $tomorrowCount ?></h2>
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
                <a href="ApprovedAppointment.php" style="display: none;" id="hidden-link2 "></a>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="document.getElementById('hidden-link2').click();">
                    <div class="card-body">
                        <h5 class="card-title">Approved Appointments</h5>
                        <h2><?= $ApprovedCount ?></h2>
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
                <a href="CanceledAppointment.php" style="display: none;" id="hidden-link3 "></a>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="document.getElementById('hidden-link3').click();">
                    <!--                    <div class="card-header">Canceled  Appointments</div>-->
                    <div class="card-body">
                        <h5 class="card-title">Canceled  Appointments</h5>
                        <h2><?= $CanceledCount ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <h2> Today Appointments</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT * FROM appointments WHERE AppDate='$current'";
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
                                <?php
                                $CusName = $row['CustomerID'];
                                $sqlName = "SELECT * FROM customer WHERE CustomerID='$CusName'";
                                $resultCusName = $db->query($sqlName);
                                $rowName = $resultCusName->fetch_assoc();
                                ?>
                                <?= $rowName['FirstName'] . ' ' . $rowName['LastName'] ?>

                            </td>
                            <td>
                                <?php
                                $vehicle = $row['VehicleNo'];
                                $sqlVehicle = "SELECT * FROM customervehicles WHERE vehicleId='$vehicle'";
                                $resultVehicle = $db->query($sqlVehicle);
                                $rowVehicle = $resultVehicle->fetch_assoc();
                                ?>
                                <?= $rowVehicle['registerLetter'] . "-" . $rowVehicle['RegistrationNo']; ?>
                            </td>
                            <!--VehicleType Find-->
                            <td>
                                <?php
                                $vehicle = $row['VehicleNo'];
                                $sqlVehicle1Cat = "SELECT * FROM appointments a JOIN customervehicles v ON a.VehicleNo = v.vehicleId JOIN vehicle_catergories vc ON v.VehicleType = vc.VCatergoryId WHERE a.VehicleNo = $vehicle";
                                $resultVehicle1 = $db->query($sqlVehicle1Cat);
                                $rowVehicle1 = $resultVehicle1->fetch_assoc();
                                ?>
                                <?= $rowVehicle1['CatergoryName'] ?>
                            </td>
                            <td><?= $row['AppDate'] ?></td>
                            <td>
                                <?php
                                $TimeSlotName = $row['TimeSlotStart'];
                                $sqlTimeSlot = "SELECT * FROM timeslots WHERE TimeSlotId='$TimeSlotName'";
                                $resultTimeSlot = $db->query($sqlTimeSlot);
                                $rowTimeSlot = $resultTimeSlot->fetch_assoc();
                                ?>
                                <?= $rowTimeSlot['TimeSlotStart'] . " " . "-" . " " . $rowTimeSlot['TimeSlotEnd']; ?>


                            </td>
                            <td>
                                <?php
                                $ServiceName = $row['ServiceType'];
                                $sqlService = "SELECT * FROM service WHERE ServiceId='$ServiceName'";
                                $resultServiceName = $db->query($sqlService);
                                $rowServiceName = $resultServiceName->fetch_assoc();
                                ?>
                                <?= $rowServiceName['ServiceName'] ?>
                            </td>
                            <td>
                                <?php
                                $appointmentStatus = $row['appointmentStatus'];
                                $statusDescription = '';

                                switch ($appointmentStatus) {
                                    case 1:
                                        $statusDescription = "Pending";
                                        $statusColor = "btn btn-warning btn-sm";
                                        break;
                                    case 2:
                                        $statusDescription = "In Porgress";
                                        $statusColor = "btn btn-success btn-sm";
                                        break;
                                    case 3:
                                        $statusDescription = "Complete";
                                        $statusColor = "btn btn-primary btn-sm";
                                        break;
                                    case 4:
                                        $statusDescription = "Canceled";
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
                                <?php
                                $appointmentStatus;
                                if ($appointmentStatus == 4) {
                                    $disabled = "disabled";
                                } else {
                                    $disabled = "";
                                }
                                ?>
                                <form method='post' action="appViewBill.php" class="btn-group">
                                    <input type="hidden" name="appointmentId" value="<?= $row['AppointmentId'] ?>">
                                    <button type="submit" class="btn btn-primary" name="action" value="viewBill" <?= @$disabled ?>>View Bill</button>
                                </form>
                            </td>
                            <td>
                                <form method='post' action="../jobCard/addJobCard.php">
                                    <input type="hidden" name="TimeSlotStart" value="<?= $row['TimeSlotStart'] ?>">
                                    <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                    <button type="submit" class="btn btn-success" name="action" value="edit"<?= @$disabled ?>>Create Job Card</button>
                                </form>
                            </td>
                            <td>
                                <form method='post' action="delete.php">
                                    <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                    <button type="submit" class="btn btn-danger" name="action" value="delete" <?= @$disabled ?>>Cancel</button>
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

<?php ob_end_flush(); ?>

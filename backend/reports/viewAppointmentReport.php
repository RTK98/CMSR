<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Reports</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewAppointmentReport.php" class="btn btn-sm btn-outline-secondary">View Appointment Report</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <div class="btn-group me-2">
                <a href="addJobCard.php" class="btn btn-sm btn-outline-secondary">View Report List</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
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
    <h2> All Appointments</h2>


    <?php
    // Check if filters are set
    $filterDate = isset($_POST['filter_date']) ? $_POST['filter_date'] : '';
    $filter_Vehicle_regLetter = isset($_POST['filter_Vehicle_regLetter']) ? $_POST['filter_Vehicle_regLetter'] : '';
    $filter_Vehicle_regNo = isset($_POST['filter_Vehicle_regNo']) ? $_POST['filter_Vehicle_regNo'] : '';
    // Build the SQL query
     $sql = "SELECT * FROM appointments INNER JOIN customervehicles ON customervehicles.vehicleId=appointments.VehicleNo";

    // Add the filter conditions if dates or NIC are provided
    if (!empty($filterDate)) {
        // Escape the input to prevent SQL injection
        $filterDate = mysqli_real_escape_string($db, $filterDate);

        // Append the filter condition to the SQL query
         $sql .= " WHERE AppDate = '$filterDate'";
    }

    if (!empty($filter_Vehicle_regLetter)) {
        // Escape the input to prevent SQL injection
        $filterVehicleNo = mysqli_real_escape_string($db, $filter_Vehicle_regLetter);

        // Append the filter condition to the SQL query
         $sql .= " AND registerLetter = '$filter_Vehicle_regLetter'";
    }
    if (!empty($filter_Vehicle_regNo)) {
        // Escape the input to prevent SQL injection
        $filter_Vehicle_regNo = mysqli_real_escape_string($db, $filter_Vehicle_regNo);

        // Append the filter condition to the SQL query
         $sql .= " AND RegistrationNo = '$filter_Vehicle_regNo'";
    }

    $result = $db->query($sql);
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <label for="filter_date">Filter by Joined Date:</label>
        <input type="date" name="filter_date" id="filter_date" value="<?php echo $filterDate; ?>">
        <label for="filter_Vehicle_regLetter">Filter by Vehicle  Registered Letter:</label>
        <input type="text" name="filter_Vehicle_regLetter" id="filter_Vehicle_regLetter" value="<?php echo $filter_Vehicle_regLetter; ?>">
        <label for="filter_Vehicle_regNo">Filter by Vehicle Registered No:</label>
        <input type="text" name="filter_Vehicle_regNo" id="filter_Vehicle_regNo" value="<?php echo $filter_Vehicle_regNo; ?>">
        <button type="submit">Filter</button>
    </form>
    <div class="table-responsive">
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
                                <form method='post' action="../jobCard/addJobCard.php">

                                    <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">

                                    <button type="submit" class="btn btn-success" name="action" value="edit">Create Job
                                        Card</button>
                                </form>

                            </td>
                            <td>
                                <form method='post' action="delete.php">
                                    <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                    <button type="submit" class="btn btn-danger" name="action" value="delete">Cancel</button>
                                </form>

                            </td>
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
<?php
include'../header.php';
include'../menu.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 my-appointment" style="background-color: white;"">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Appointments </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Go Back</button>
            </div>
        </div>
    </div>
    <div>
    </div>

    <?php
    extract($_POST);
    $customerId = $_SESSION['CustomerID'];
    $sql = "SELECT "
            . "app.AppointmentNo,"
            . "app.AppointmentId,"
            . "app.AppDate,"
            . "app.appointmentStatus,"
            . "tm.TimeSlotStart,"
            . "tm.TimeSlotEnd,"
            . "cv.registerLetter,"
            . "cv.RegistrationNo,"
            . "vm.ModelName,"
            . "sv.ServiceName "
            . "FROM appointments app "
            . "LEFT JOIN customervehicles cv ON cv.vehicleId=app.VehicleNo "
            . "LEFT JOIN vehiclemodels vm ON cv.VehicleModel=vm.VehicleModelsId "
            . "LEFT JOIN timeslots tm ON app.TimeSlotStart=tm.TimeSlotId "
            . "LEFT JOIN service sv ON sv.ServiceId=app.ServiceType "
            . "WHERE app.CustomerID='$customerId' ORDER BY app.AppDate DESC";
    $db = dbconn();
    $result = $db->query($sql);
    ?>
    <div class="table-responsive" style="background-color: white;">
        <table class="table table-striped table-bordered table-sm table table-hover table-custom">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Appointment No.</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Vehicle Number</th>
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
                            <td>
                                <?= $n ?>
                            </td>
                            <td>
                                <?= $row['AppointmentNo'] ?> 
                            </td>
                            <td>
                                <?= $row['AppDate'] ?> 
                            </td>
                            <td>
                                <?= $row['TimeSlotStart'] . ' - ' . $row['TimeSlotStart'] ?> 
                            </td>

                            <td>
                                <?= $row['registerLetter'] . "-" . $row['RegistrationNo']; ?>
                            </td>
                            <td>
                                <?= ucwords($row['ServiceName']) ?> 
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
                                        $showAddComplaint = false;
                                        $showCancelButton = true;

                                        //timegap validating

                                        $bookedDate = $row['AppDate'];
                                        $DateBooked = strtotime($bookedDate);
                                        $currentdate = date('Y-m-d');
                                        $DateCurrent = strtotime($currentdate);
                                        $prev_date = date('Y-m-d', strtotime($bookedDate . ' -2 day'));
                                        $DateCanceled = strtotime($prev_date);
                                        $prev_date1 = date('Y-m-d', strtotime($currentdate . ' -1 day'));
                                        $DateCanceled1 = strtotime($prev_date1);
                                        $timegap = $DateBooked - $DateCurrent;
                                        $StaticDate = ($DateCurrent - $DateCanceled1) * 2;
                                        if ($timegap <= $StaticDate) {
                                            $showCancelButton = false;
                                        }

                                        break;
                                    case 2:
                                        $statusDescription = "In Progress";
                                        $statusColor = "badge bg-success btn-sm";
                                        $showViewBill = false;
                                        $showAddComplaint = false;
                                        $showCancelButton = false;
                                        break;
                                    case 3:
                                        $statusDescription = "Complete";
                                        $statusColor = "badge bg-primary btn-sm";
                                        $showViewBill = true;
                                        $showAddComplaint = true;
                                        $showCancelButton = false;
                                        break;
                                    case 4:
                                        $statusDescription = "Canceled";
                                        $statusColor = "badge bg-danger btn-sm";
                                        $showViewBill = false;
                                        $showAddComplaint = false;
                                        $showCancelButton = false;
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <td>
                                <?php if ($showViewBill) { ?>
                                    <form method='post' action="appViewBill.php" class="btn-group">
                                        <input type="hidden" name="appointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <button class="btn btn-primary" name="action" value="viewBill">View Bill</button>
                                    </form>
                                <?php } ?>
                                <?php if ($showAddComplaint) { ?>
                                    <form method='post' action="appComplaints.php" class="btn-group">
                                        <input type="hidden" name="appointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <button class="btn btn-success" name="action" value="addComplaint">Add Complaint</button>
                                    </form>
                                <?php } ?>

                                <?php if ($showCancelButton) { ?>
                                    <form method='post' action="appCancel.php" class="btn-group">
                                        <input type="hidden" name="appointmentId" value="<?= $row['AppointmentId'] ?>">
                                        <button class="btn btn-danger btn-sm" name="action" value="cancel" >Cancel</button>
                                    </form>
                                <?php } ?>
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
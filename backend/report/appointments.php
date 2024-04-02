<?php $appointment = "active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Appointments</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group ">
                <a href="<?= SYSTEM_PATH?>report/report.php" class="btn btn-sm btn-dark">Reports</a>
            </div>
<!--            <div class="btn-group me-2">
                <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>

            </div>
            <div class="btn-group me-2">
                <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>

            </div> <div class="btn-group me-2">
                <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>

            </div> <div class="btn-group me-2">
                <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>

            </div> <div class="btn-group me-2">
                <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>

            </div>-->

        </div>

    </div>


    <hr>
    <h2> </h2>
    <form method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <div class="row g-3">
            <div class="col-sm-2">
                <input type="text" name="VehicleID" value="<?= @$VehicleID ?>" class="form-control" placeholder="Appointment No.">
            </div>
            <div class="col-sm-2">
                <?php
                $db = dbConn();
                $sql = "SELECT DISTINCT CustomerID,FirstName,LastName FROM customer";
                $result = $db->query($sql);
                ?>
                <select name="Model" class="form-control">
                    <option value="">--Customer Name--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['CustomerID'] ?>"><?= $row['FirstName'] . $row['LastName'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-sm-1">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM vehicle_catergories";
                $result = $db->query($sql);
                ?>
                <select name="type" class="form-control">
                    <option value="">--Type--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['VCatergoryId'] ?>"><?= $row['CatergoryName'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-2">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM `vehiclemodels`";
                $result = $db->query($sql);
                ?>
                <select name="modelvehicle" class="form-control">
                    <option value="">--Model--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['VehicleModelsId'] ?>"><?= $row['ModelName'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-2">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM `vehiclebrand`";
                $result = $db->query($sql);
                ?>
                <select name="brand" class="form-control">
                    <option value="">--brand--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['VehicleBrandId'] ?>"><?= $row['VehicleBrandName'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-2">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM service";
                $result = $db->query($sql);
                ?>
                <select name="servicet" class="form-control">
                    <option value="">--Service--</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?= $row['ServiceId'] ?>"><?= $row['ServiceName'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div> <div class="col-sm-2">

                <select name="appstatus" class="form-control">
                    <option value="">--Status--</option>

                    <option value="1">Pending</option>
                    <option value="2">In Porgress</option>
                    <option value="3">Complete</option>
                    <option value="4">Canceled</option>

                </select>
            </div>

            <div class="col-sm-2">
                <input type="date" class="form-control" name="from" placeholder="Enter From Date" max="<?php echo date("Y-m-d") ?>">
            </div>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="to" placeholder="Enter To Date" max="<?php echo date("Y-m-d") ?>" >
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-warning">Search</button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-secondary" onclick="printReport('report')">Print</button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-dark" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
            </div>


        </div>
    </form>

    <?php
    $db = dbConn();
    $where = null;
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!empty($VehicleID)) {
            $where .= " ap.AppointmentNo='$VehicleID' AND";
        }
        if (!empty($type)) {
            $where .= " vc.VCatergoryId='$type' AND";
        }
        if (!empty($Model)) {
            $where .= " cus.CustomerID='$Model' AND";
        }
        if (!empty($appstatus)) {
            $where .= " ap.appointmentStatus='$appstatus' AND";
        }
          if (!empty($servicet)) {
            $where .= " sv.ServiceId='$servicet' AND";
        }
        
        if (!empty($brand)) {
            $where .= " vb.VehicleBrandId='$brand' AND";
        }
        
        if (!empty($modelvehicle)) {
            $where .= " vm.VehicleModelsId='$modelvehicle' AND";
        }
        if (!empty($from) && empty($to)) {
            $where .= " ap.AppDate  = '$from' AND";
        }
        if (empty($from) && !empty($to)) {
            $where .= " ap.AppDate  = '$to' AND";
        }
        if (!empty($from) && !empty($to)) {
            $where .= " ap.AppDate  BETWEEN '$from' AND '$to' AND";
        }
    }

    if (!empty($where)) {
        $where = substr($where, 0, -3);
        $where = " WHERE $where";
    }


     $sql = "SELECT ap.AppointmentId,"
    . "ap.AppointmentNo,"
    . "ap.AppDate,"
    . "ap.appointmentStatus,"
    . "cus.CustomerID,"
    . "cus.FirstName,"
    . "cus.LastName,"
    . "cv.registerLetter,"
    . "cv.RegistrationNo,"
    . "vc.CatergoryName,"
    . "tms.TimeSlotStart,"
    . "tms.TimeSlotEnd,"
    . "sv.ServiceName,"
                . "sv.ServiceId,"
    . "vm.VehicleModelsId,"
    . "vm.ModelName,"
    . "vb.VehicleBrandId,"
    . "vc.VCatergoryId,"
    . "vb.VehicleBrandName "
    . "FROM appointments ap "
    . "LEFT JOIN customer cus ON ap.CustomerID = cus.CustomerID "
    . "LEFT JOIN customervehicles cv ON ap.VehicleNo=cv.vehicleId "
    . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
    . "LEFT JOIN vehiclebrand vb ON cv.VehicleBrand=vb.VehicleBrandId "
    . "LEFT JOIN vehiclemodels vm ON cv.VehicleModel=vm.VehicleModelsId "
    . "LEFT JOIN timeslots tms ON ap.TimeSlotStart=tms.TimeSlotId "
    . "LEFT JOIN service sv ON ap.ServiceType=sv.ServiceId $where";

    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $total = $result->num_rows;
    } else {
        $total = 0;
    }
    ?>

    <div class="table-responsive" id='report'>
        <h5><span class="badge bg-primary"><?= $total ?></span> Appointments</h5>

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
                    <th scope="col">Vehicle Model</th>
                    <th scope="col">Vehicle Brand</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Time Slot</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Appointment Status</th>

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
                                <?= ucwords($row['CatergoryName']) ?>
                            </td>
                            <td>
                                <?= ucwords($row['ModelName']) ?>
                            </td>
                            <td>
                                <?= ucwords($row['VehicleBrandName']) ?>
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
                                        } else if ($DateBooked == $DateCurrent) {
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
    function printReport(divid) {
        var divToPrint = document.getElementById(divid);

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);
    }
    var doc = new jsPDF();
    function exportReport(divId, title) {
        doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
        doc.save('div.pdf');
    }
</script>
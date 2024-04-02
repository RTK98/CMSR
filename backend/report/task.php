<?php $appointment = "active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Tasks</h1>

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

                <select name="stockstatus" class="form-control">
                    <option value="">--Status--</option>

                 
                    <option value="1">Task Assigned</option>
                    <option value="2">Task Accepted</option>
                    <option value="3">Task Completed</option>
                   


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
            $where .= " si.SerialNo='$VehicleID' AND";
        }

        if (!empty($Model)) {
            $where .= " pro.ProductId='$Model' AND";
        }

        if (!empty($batch)) {
            $where .= " b.BatchId='$batch' AND";
        }
        if (!empty($stockstatus)) {
            $where .= " tsk.Status='$stockstatus' AND";
        }

        if (!empty($from) && empty($to)) {
            $where .= " tsk.AddDate  = '$from' AND";
        }
        if (empty($from) && !empty($to)) {
            $where .= " tsk.AddDate = '$to' AND";
        }
        if (!empty($from) && !empty($to)) {
            $where .= " tsk.AddDate BETWEEN '$from' AND '$to' AND";
        }
    }

    if (!empty($where)) {
        $where = substr($where, 0, -3);
        $where = " WHERE $where";
    }

    $userId = $_SESSION['userId'];
    $adddate = date("Y-m-d");
    $db = dbconn();
    $UserId = $_SESSION['userId'];
    $sql = "SELECT tsk.TaskId,"
            . "tsk.AddDate,"
            . "tsk.AddTime,"
            . "tsk.UpdateDate,"
            . "tsk.UpdateTime,"
            . "tsk.FinishedDate,"
            . "tsk.FinishedTime,"
            . "tsk.Status,"
            . "app.AppointmentId,"
            . "app.AppointmentNo,"
            . "cv.vehicleId,"
            . "cv.registerLetter,"
            . "cv.registerLetter,"
            . "cv.RegistrationNo,"
            . "ins.InspectionId,"
            . "ins.InspectionNo,"
            . "u.UserId,"
            . "u.FirstName,"
            . "jb.JobCardNo,"
            . "jb.id,"
            . "u.LastName FROM tasks tsk "
            . "LEFT JOIN appointments app ON app.AppointmentId=tsk.Appointment_id "
            . "LEFT JOIN customervehicles cv ON cv.vehicleId=tsk.vehicleId "
            . "LEFT JOIN users u ON u.UserId=tsk.emp_id "
            . "LEFT JOIN job_cards jb ON jb.id=tsk.Job_cardId "
            . "LEFT JOIN inspections ins ON ins.InspectionId=tsk.InspectionId $where;";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $total = $result->num_rows;
    } else {
        $total = 0;
    }
    ?>


    <div class="table-responsive" id='report'>
        <h5><span class="badge bg-primary"><?= $total ?></span> Tasks</h5>
        </section>
        <div class="table-responsive">
         
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Job Card No</th>
                        <th scope="col">INS/APP NO</th>
                        <th scope="col">Job Card Date</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Vehicle No</th>
                       
                        <th scope="col">Assigned Date</th>
                        <th scope="col">Assigned time</th>
                        <th scope="col">Finish Date </th>
                        <th scope="col">Finish time </th>
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
                                <td><?php
                                    if ($row['InspectionNo']) {
                                        echo $row['InspectionNo'];
                                    } else {
                                        echo $row['AppointmentNo'];
                                    }
                                    ?></td>
                                <td> <?= $row['AddDate'] ?></td>
                                <td> <?= $row['FirstName'] . ' ' . $row['LastName'] ?></td>
                                <td> <?= $row['registerLetter'] . "-" . $row['RegistrationNo']; ?>
                                </td>
                                <td> <?= $row['AddDate'] ?></td>
                                <td><?= $row['AddTime'] ?></td>
                                <td> <?= $row['UpdateDate'] ?></td>
                                <td> <?= $row['UpdateTime'] ?></td>
                                <td>
                                    <?php
                                    $TaskStatus = $row['Status'];
                                    $statusDescription = '';

                                    switch ($TaskStatus) {
                                        case 1:
                                            $statusDescription = "Task Assigned";
                                            $statusColor = "badge bg-warning text-dark btn-sm";
                                            break;
                                        case 2:
                                            $statusDescription = "Task Accepted";
                                            $statusColor = "badge bg-success btn-sm";
                                            break;
                                        case 3:
                                            $statusDescription = "Task Completed";
                                            $statusColor = "badge bg-primary btn-sm";
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
                    }
                    ?>
                </tbody>
            </table>
        </div>
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
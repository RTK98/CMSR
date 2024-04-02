<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Job Cards</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addJobCard.php" class="btn btn-sm btn-outline-secondary">Add Job Card</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <h2>My Task List</h2>
    <section>
        <div class="row">
            <div class="col-md-3">
                <?php
                $current = date("Y-m-d");
                $empId = $_SESSION['userId'];
                $db = dbconn();
                $sqlToday = "SELECT * FROM tasks WHERE AddDate='$current'";
                $resultToday = $db->query($sqlToday);
                if ($resultToday->num_rows > 0) {
                    $todayCount = $resultToday->num_rows;
                } else {
                    $todayCount = 0;
                }
                ?>
                <a href="todayAppointment.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Today Tasks</h5>
                        <h2><?= $todayCount ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                $current = date("Y-m-d");
                $tomorrow = date("Y-m-d", strtotime('+1 day'));
                $db = dbconn();
                $sqlTomorrow = "SELECT * FROM tasks WHERE AddDate='$current' AND Status=2";
                $resultTomorrow = $db->query($sqlTomorrow);
                if ($resultTomorrow->num_rows > 0) {
                    $tomorrowCount = $resultTomorrow->num_rows;
                } else {
                    $tomorrowCount = 0;
                }
                ?>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Accepted Tasks</h5>
                        <h2><?= $tomorrowCount ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Pending Tasks</h5>
                        <h2><?php
                            $pendingTasks = $todayCount - $tomorrowCount;
                            echo $pendingTasks;
                            ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                $db = dbconn();
                $sqlAllTasks = "SELECT * FROM tasks";
                $resultallTaks = $db->query($sqlAllTasks);
                if ($resultallTaks->num_rows > 0) {
                    $allTasksCount = $resultallTaks->num_rows;
                } else {
                    $allTasksCount = 0;
                }
                ?>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <!--                    <div class="card-header">Canceled  Appointments</div>-->
                    <div class="card-body">
                        <h5 class="card-title">All Tasks</h5>
                        <h2><?= $allTasksCount ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="table-responsive">
        <?php
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
        . "LEFT JOIN inspections ins ON ins.InspectionId=tsk.InspectionId;";
        $result = $db->query($sql); // Run Query
//        print_r($result);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Job Card No</th>
                    <th scope="col">INS/APP NO</th>
                    <th scope="col">Job Card Date</th>
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
                            <td><?php if($row['InspectionNo']){
                               echo $row['InspectionNo'];
                            }else{
                                  echo $row['AppointmentNo'];
                            } ?></td>
                            <td> <?= $row['AddDate'] ?></td>
                            <td> <?= $row['FirstName'] . ' ' . $row['LastName'] ?></td>
                            <td> <?= $row['registerLetter'] . "-" . $row['RegistrationNo']; ?> </td>
                            <td>
                                         <?php
                                $TaskStatus= $row['Status'];
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
</main>
<?php include'../footer.php'; ?>
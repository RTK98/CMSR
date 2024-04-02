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
                <a href="<?= SYSTEM_PATH ?>order/requesting/viewMyRelItems.php" class="btn btn-sm btn-dark">Received Items</a>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

        $JobCardId;
        $UserId;
        @$AppointmentId;
        @$InspectionNo;
        @$Inspectionid;
        $messages = array();
        if ($AppointmentId) {
            if (empty($messages)) {
                $UpdateDate = date('Y-m-d');
                $UpdateUser = $_SESSION['userId'];
                $UpdateTime = date("H:i");
                $db = dbconn();
                $sql = "UPDATE tasks SET UpdateUser = '$UpdateUser', UpdateDate = '$UpdateDate',UpdateTime='$UpdateTime', Status = '2' WHERE Job_cardId= '$JobCardId'";
                $db->query($sql);

                $sql1 = "UPDATE job_cards SET UpdateUser = '$UpdateUser', UpdateDate = '$UpdateDate',UpdateTime='$UpdateTime', Status = '2' WHERE id= '$JobCardId'";
                $db->query($sql1);
                ?>
                <script>
                    Swal.fire({
                        //                            title: 'Success!',
                        //                            text: 'Password has been reset',
                        //                            icon: 'success',
                        //                            position: 'top-right',
                        //                            showConfirmButton: true,
                        toast: true,
                        icon: 'success',
                        title: 'Task Has been Started',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = '../jobCard/viewJobCardRepairTech.php'; // Redirect to success page
                    });
                    </script><?php
            }
        } else {
            if (empty($messages)) {
                $UpdateDate = date('Y-m-d');
                $UpdateUser = $_SESSION['userId'];
                $UpdateTime = date("H:i");
                $db = dbconn();
                $sql = "UPDATE tasks SET UpdateUser = '$UpdateUser', UpdateDate = '$UpdateDate',UpdateTime='$UpdateTime', Status = '2' WHERE Job_cardId= '$JobCardId'";
                $db->query($sql);

                $sql1 = "UPDATE job_cards SET UpdateUser = '$UpdateUser', UpdateDate = '$UpdateDate',UpdateTime='$UpdateTime', Status = '2' WHERE id= '$JobCardId'";
                $db->query($sql1);

                $sql2 = "UPDATE inspections SET Status = '4' WHERE InspectionId= '$Inspectionid'";
                $db->query($sql2);
                ?>
                <script>
                    Swal.fire({
                        //                            title: 'Success!',
                        //                            text: 'Password has been reset',
                        //                            icon: 'success',
                        //                            position: 'top-right',
                        //                            showConfirmButton: true,
                        toast: true,
                        icon: 'success',
                        title: 'Task Has been Started',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = '../jobCard/viewJobCardRepairTech.php'; // Redirect to success page
                    });
                    </script><?php
            }
        }
    }
    ?>

    <h2>My Task List</h2>
    <section>
        <div class="row">
            <div class="col-md-3">
                <?php
                $current = date("Y-m-d");
                $empId = $_SESSION['userId'];
                $db = dbconn();
                $sqlToday = "SELECT * FROM tasks WHERE AddDate='$current' AND emp_id='$empId'";
                $resultToday = $db->query($sqlToday);
                if ($resultToday->num_rows > 0) {
                    $todayCount = $resultToday->num_rows;
                } else {
                    $todayCount = 0;
                }
                ?>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="window.location.href = '<?= SYSTEM_PATH ?>tasks/todayTasks;'">
                    <div class="card-body">
                        <h5 class="card-title">Today Tasks</h5>
                        <h2><?= $todayCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/task.png">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                $tomorrow = date("Y-m-d", strtotime('+1 day'));
                $db = dbconn();
                $sqlTomorrow = "SELECT * FROM tasks WHERE AddDate='$current' AND emp_id='$empId' AND Status=2";
                $resultTomorrow = $db->query($sqlTomorrow);
                if ($resultTomorrow->num_rows > 0) {
                    $tomorrowCount = $resultTomorrow->num_rows;
                } else {
                    $tomorrowCount = 0;
                }
                ?>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="window.location.href = '<?= SYSTEM_PATH ?>tasks/acceptedTasks;'">
                    <div class="card-body">
                        <h5 class="card-title">Accepted Tasks</h5>
                        <h2><?= $tomorrowCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/task.png">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="window.location.href = '<?= SYSTEM_PATH ?>tasks/PendingTasks;'">
                    <div class="card-body">
                        <h5 class="card-title">Pending Tasks</h5>
                        <h2><?php
                            $pendingTasks = $todayCount - $tomorrowCount;
                            echo $pendingTasks;
                            ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/task.png">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                $db = dbconn();
                $sqlAllTasks = "SELECT * FROM tasks WHERE emp_id='$empId'";
                $resultallTaks = $db->query($sqlAllTasks);
                if ($resultallTaks->num_rows > 0) {
                    $allTasksCount = $resultallTaks->num_rows;
                } else {
                    $allTasksCount = 0;
                }
                ?>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" onclick="window.location.href = '<?= SYSTEM_PATH ?>tasks/AllTasks;'">
                    <!--                    <div class="card-header">Canceled  Appointments</div>-->
                    <div class="card-body">
                        <h5 class="card-title">All Tasks</h5>
                        <h2><?= $allTasksCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/task.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $UserId = $_SESSION['userId'];
        $sql = "SELECT jbr.AddDate,"
                . "jbr.JobCardNo,"
                . "jbr.id,"
                . "jbr.empId,"
                . "jbr.Inspectionid,"
                . "jbr.AppointmentId,"
                . "jbr.AppointmentNo,"
                . "jbr.InspectionNo,"
                . "cus.FirstName,"
                . "cus.LastName,"
                . "cv.registerLetter,"
                . "cv.RegistrationNo "
                . "FROM job_cards jbr "
                . "LEFT JOIN customer cus ON cus.CustomerID=jbr.CustomerId "
                . "LEFT JOIN customervehicles cv ON jbr.VehicleNo=cv.vehicleId "
                . "WHERE jbr.Status='1' AND jbr.empId='$UserId' "
                . "ORDER BY jbr.AddDate DESC;";
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
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
//                        var_dump($row);
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
                            <td>
                                <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="AppointmentId" value="<?= @$row['AppointmentId'] ?>">
                                    <input type="hidden" name="InspectionNo" value="<?= @$row['InspectionNo'] ?>">
                                    <input type="hidden" name="Inspectionid" value="<?= @$row['Inspectionid'] ?>">
                                    <input type="hidden" name="UserId" value="<?= $UserId ?>">
                                    <input type="hidden" name="JobCardId" value="<?= $row['id'] ?>">
                                    <button type="submit" name="action" value="edit" class="btn btn-primary btn-sm">Accept</button>
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
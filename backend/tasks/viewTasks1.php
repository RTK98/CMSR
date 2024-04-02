<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'edit') {

    $appointmentId;
    // echo  $TimeSlotStart=$row['$TimeSlotStart'];
    $messages = array();
    if (empty($appointmentId)) {
        $messages['error_Product_name'] = "The Product Name should not be blank..!";
    }
    if (empty($messages)) {
        $UpdateDate = date('Y-m-d');
        $UpdateUser = $_SESSION['userId'];
        $db = dbconn();
        $sql = "UPDATE tasks SET UpdateUser = '$UpdateUser', UpdateDate = '$UpdateDate', Status = '2' WHERE Appointment_id= '$appointmentId'";
        $db->query($sql);

//        header('Location:addSuccess.php');
    }
}
?>
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
                $sqlToday = "SELECT * FROM tasks WHERE AddDate='$current' AND User_id='$empId'";
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
                        <h5 class="card-title">Today Tasks</h5>
                        <h2><?= $todayCount ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                $tomorrow = date("Y-m-d", strtotime('+1 day'));
                $db = dbconn();
                $sqlTomorrow = "SELECT * FROM tasks WHERE AddDate='$current' AND User_id='$empId' AND Status=2";
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
                $sqlAllTasks = "SELECT * FROM tasks WHERE User_id='$empId'";
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
        $sql = "SELECT * FROM job_cards WHERE Status=1 ORDER BY job_cards.AppDate DESC";
        $result = $db->query($sql); // Run Query
//        print_r($result);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Appointment No</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Customer No</th>
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
                            <td><?= $row['AppointmentNo'] ?></td>
                            <td><?= $row['AppDate'] ?></td>

                            <td>


                                <?= $row['CustomerId'] ?></td>
                            <td>
                                <?php
                                $vehicle = $row['VehicleNo'];
                                $sqlVehicle = "SELECT * FROM customervehicles WHERE vehicleId='$vehicle'";
                                $resultVehicle = $db->query($sqlVehicle);
                                $rowVehicle = $resultVehicle->fetch_assoc();
                                ?>
                                <?= $rowVehicle['registerLetter'] . "-" . $rowVehicle['RegistrationNo']; ?>
                            </td>
                            <td><?= $row['CustomerNo'] ?></td>
                            <td>
                                <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="appointmentId" value="<?= $row['AppointmentId'] ?>">
                                    <button type="submit" name="action" value="edit" class="btn btn-primary">Accept</button>
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
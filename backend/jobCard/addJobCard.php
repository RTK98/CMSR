<?php
ob_start();
date_default_timezone_set("Asia/Colombo");
include'../header.php';
include'rand.php';
include'../menu.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Job Card</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewJobCard.php" class="btn btn-sm btn-dark">view Job Cards</a>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && (@$action == 'edit' || @$action == 'save')) {
        $AppointmentId;
        $db = dbconn();
        $sql = "SELECT "
                . "ap.AppointmentId,"
                . "ap.AppointmentNo,"
                . "ap.AppDate,"
                . "ap.CustomerID,"
                . "ap.appointmentStatus,"
                . "ap.VehicleNo,"
                . "ap.TimeSlotStart AS 'AppointmentTime'"
                . ",cus.FirstName,"
                . "cus.LastName,"
                . "cv.registerLetter,"
                . "cv.RegistrationNo,"
                . "vc.CatergoryName,"
                . "tms.TimeSlotStart,"
                . "tms.TimeSlotEnd,"
                . "sv.ServiceName,"
                . "vcm.ModelName,"
                . "cusmob.MobileNo "
                . "FROM appointments ap "
                . "LEFT JOIN customer cus ON ap.CustomerID = cus.CustomerID "
                . "LEFT JOIN customervehicles cv ON ap.VehicleNo=cv.vehicleId "
                . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                . "LEFT JOIN timeslots tms ON ap.TimeSlotStart=tms.TimeSlotId "
                . "LEFT JOIN service sv ON ap.ServiceType=sv.ServiceId  "
                . "LEFT JOIN vehiclemodels vcm ON cv.VehicleModel=vcm.VehicleModelsId "
                . "LEFT JOIN customer_mobile cusmob ON ap.CustomerID=cusmob.CustomerID WHERE ap.AppointmentId='$AppointmentId'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
    }
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {
        $AppointmentId;
        $db = dbconn();
        $sql = "SELECT "
                . "ap.AppointmentId,"
                . "ap.AppointmentNo,"
                . "ap.AppDate,"
                . "ap.CustomerID,"
                . "ap.appointmentStatus,"
                . "ap.VehicleNo,"
                . "ap.TimeSlotStart AS 'AppointmentTime'"
                . ",cus.FirstName,"
                . "cus.LastName,"
                . "cv.registerLetter,"
                . "cv.RegistrationNo,"
                . "vc.CatergoryName,"
                . "tms.TimeSlotStart,"
                . "tms.TimeSlotEnd,"
                . "sv.ServiceName,"
                . "vcm.ModelName,"
                . "cusmob.MobileNo "
                . "FROM appointments ap "
                . "LEFT JOIN customer cus ON ap.CustomerID = cus.CustomerID "
                . "LEFT JOIN customervehicles cv ON ap.VehicleNo=cv.vehicleId "
                . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                . "LEFT JOIN timeslots tms ON ap.TimeSlotStart=tms.TimeSlotId "
                . "LEFT JOIN service sv ON ap.ServiceType=sv.ServiceId  "
                . "LEFT JOIN vehiclemodels vcm ON cv.VehicleModel=vcm.VehicleModelsId "
                . "LEFT JOIN customer_mobile cusmob ON ap.CustomerID=cusmob.CustomerID WHERE ap.AppointmentId='$AppointmentId'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $AppDate = $row['AppDate'];
        $AppointmentNo = $row['AppointmentNo'];
        $CustomerID = $row['CustomerID'];
        echo $VehicleNo = $row['VehicleNo'];
        $CustomerNo = '0' . $row['MobileNo'];
        echo $TimeSlotStart = $row['AppointmentTime'];

        $AssignTaskEmp = inputTrim($AssignTaskEmp);
        $AppointmentId;
        $messages = array();
        if (empty($AssignTaskEmp)) {
            $messages['error_id'] = "The Product Qty should not be blank..!";
        }
        if (!empty($AppointmentId)) {
            $db = dbconn();
            $sql = "SELECT * FROM job_cards WHERE AppointmentId='$AppointmentId'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $messages['error_Job_card'] = "The Job Card Already Exists!";
            }
        }
        if (empty($messages)) {
            $AddDate = date('Y-m-d');
            $AddUser = $_SESSION['userId'];
            $AddTime = date("H:i");
            $db = dbconn();

            $timestamp = strtotime($AddDate);
            $currentdatenumber = date('Ymd', $timestamp);
            $randomNumber;
            $JobCardNo = 'JCS' . $currentdatenumber . $randomNumber;

            $sql = "INSERT INTO job_cards(JobCardNo,JobCardType,AppointmentId,empId,AppDate,AppointmentNo,"
                    . "CustomerId,VehicleNo,CustomerNo,timeslotidappointment,AddDate,AddUser,AddTime,Status) "
                    . "VALUES ('$JobCardNo','1','$AppointmentId','$AssignTaskEmp','$AppDate','$AppointmentNo',"
                    . "'$CustomerID','$VehicleNo','$CustomerNo','$TimeSlotStart','$AddDate','$AddUser','$AddTime','1')";
            $db->query($sql);
            $JobCardId = $db->insert_id;

            $sqlJbcNo = "SELECT JobCardNo FROM job_cards WHERE id='$JobCardId'";
            $db->query($sqlJbcNo);
            $resultjbcNo = $db->query($sqlJbcNo);
            $rowNo = $resultjbcNo->fetch_assoc();
            $Job_cardNo = $rowNo['JobCardNo'];

            $sql2 = "INSERT INTO tasks(Appointment_id,Job_cardId,Job_cardNo,vehicleId,emp_id,AppDate,TimeSlotId,AddUser,AddDate,AddTime,Status) "
                    . "VALUES ('$AppointmentId','$JobCardId','$Job_cardNo','$VehicleNo','$AssignTaskEmp','$AppDate','$TimeSlotStart','$AddUser','$AddDate','$AddTime','1')";
            $db->query($sql2);

            $sql3 = "UPDATE appointments SET appointmentStatus='2' WHERE AppointmentId='$AppointmentId'";
            $db->query($sql3);
        }
        ?>
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Job Card & Task Assigned has been Added Successfully',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
            }).then(() => {
                window.location.href = '<?= SYSTEM_PATH ?>appointments/viewAppointment.php'; // Redirect to success page
            });
        </script><?php
    }
    if (!empty($messages)) {
        ?>
        <script>
            Swal.fire({
                toast: true,
                icon: 'error',
                title: 'Something went wrong!',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
            }).then(() => {
                //                    window.location.href = 'addRepaircatergory.php'; // Redirect to success page
            });
        </script><?php
    }
    ?>  
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class = "card">
            <div class="card-body">
                <div class="text-danger"><?= @$messages['error_Job_card']; ?></div> 
                <section class="m-1">
                    <div class="card-header">
                        <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                             style="
                             display: block;
                             margin-left: auto;
                             margin-right: auto;
                             ">
                        <h5 class='m-1'style="text-align: center;">Replica Speed Motor Garage</h5>
                        <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
                        <p class='m-1' style="text-align: center;">0779 200 480</p>
                    </div>
                    <div class="card-body">
                        <div>
                            <h4 class='m-1'style="text-align: center; font-weight: bold;">Add Job Card</h4>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <p> Customer Name : <?= $row['FirstName'] . ' ' . $row['LastName']; ?></p>
                                </div>
                                <div>
                                    <p>Vehicle No : <?= $row['registerLetter'] . ' - ' . $row['RegistrationNo']; ?> </p>
                                </div>
                                <div>
                                    <p>Vehicle Type : <?= $row['CatergoryName']; ?></p>
                                </div>
                                <div>
                                    <p>Service Type : <?= $row['ServiceName']; ?></p>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <p> Appointment Date :  <?= $row['AppDate']; ?></p>
                                </div>
                                <div>
                                    <p> Appointment NO. : <?= $row['AppointmentNo']; ?></p>
                                </div>
                                <div>
                                    <p>Vehicle Model : <?= ucwords($row['ModelName']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <?php
                    $AddDate = date('Y-m-d');
                    $db = dbconn();
                    $sql = "SELECT empatt.EmpAttendanceId,u.UserId,u.FirstName,u.LastName,u.depId,u.UserRole FROM empattendance empatt "
                            . "LEFT JOIN users u ON empatt.EmpId=u.UserId "
                            . "WHERE empatt.Date = '$AddDate' "
                            . "AND u.UserRole='technician'"
                            . " AND u.depId='2'";
                    $result = $db->query($sql);
//                    $row = $result->fetch_assoc();
//                var_dump($row);
//                die();
                    ?>
                    <div class="mb-3">
                        <lable for="AssignTaskEmp" class="form-label">Title</lable>
                        <select for="AssignTaskEmp" name="AssignTaskEmp" class="form-select" aria-label="Default select example">
                            <option value="NoTaskEmp">--</option>
                            <?php
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['UserId'] ?>" <?php
                                    if (@$AssignTaskEmp == $row['UserId']) {
                                        echo "selected";
                                    }
                                    ?>><?= $row['FirstName'] . ' ' . $row['LastName'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>

                        </select>
                        <div class="text-danger"><?= @$messages['error_id']; ?></div> 
                    </div>
                </section>
            </div>
            <div class="card-footer">

                <input type="hidden" name="AppointmentId" value="<?= $AppointmentId ?>">
                <button type="submit" class="btn btn-primary" name="action" value="save">Save</button>
            </div>
        </div>
    </form>        
    <section>
        <h5><strong>Skill List</strong></h5>

        <?php
        $db = dbconn();
        $sqlTechnician = "SELECT * FROM users where UserRole='technician' AND depId=2";
        $resultName = $db->query($sqlTechnician);
        ?>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                $i = 1;
                while ($row11 = $resultName->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card-deck">
                            <div class="card">
                                <img class="card-img-top" src="<?= SYSTEM_PATH ?>assets/img/UserImages/<?= $row11['UserImage'] ?>" 
                                     alt="Card image cap" style="width:20rem; height:15rem;  display: flex; justify-content: center;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="card-title"><?= $row11["FirstName"] . " " . $row11["LastName"] ?></h4>
                                            <h5>Best Skills</h5>
                                            <?php
                                            $usertechid1 = $row11["UserId"];
                                            $sqlbestskill = "SELECT * FROM bestskills WHERE emp_id='$usertechid1'";
                                            $resultskills1 = $db->query($sqlbestskill);
//                                   $row123=$resultskills1->fetch_assoc();
//                                   var_dump($row123);
                                            if ($resultskills1->num_rows > 0) {

                                                while ($rowskills1 = $resultskills1->fetch_assoc()) {
                                                    $skill_id1 = $rowskills1['skill_id'];
                                                    $sqlSkillName1 = "SELECT * FROM skills WHERE SId='$skill_id1'";
                                                    $resultSkillName1 = $db->query($sqlSkillName1);
                                                    $row13 = $resultSkillName1->fetch_assoc();
                                                    ?>
                                                    <div class = "btn btn-success m-1">
                                                        <?= $row13['SkillName']; ?> </div> <?php
                                                    echo"<br>";
                                                }
                                            } else {
                                                echo "<div class='btn btn-danger'>No Best Skill Assgined</div>";
                                            }
                                            ?>

                                            <h5>General Skills</h5>
                                            <?php
                                            $usertechid = $row11["UserId"];
                                            $sqlGeneralskill = "SELECT * FROM nskills WHERE emp_id='$usertechid'";
                                            $resultGskills = $db->query($sqlGeneralskill);

                                            if ($resultGskills->num_rows > 0) {

                                                while ($rowGskills = $resultGskills->fetch_assoc()) {
                                                    $skill_id = $rowGskills['skill_id'];
                                                    $sqlSkillName = "SELECT * FROM skills WHERE SId='$skill_id'";
                                                    $resultSkillName = $db->query($sqlSkillName);
                                                    $row12 = $resultSkillName->fetch_assoc();
                                                    ?>
                                                    <div class = "btn btn-warning m-1">
                                                        <?= $row12['SkillName']; ?> </div> <?php
                                                    echo"<br>";
                                                }
                                            } else {
                                                echo "<div class='btn btn-danger'>No General Skill Assgined</div>";
                                            }
                                            ?>
                                        </div>
                                        <hr>
                                        <!--                                        Task Management-->
                                        <div class="row">
                                            <h5>Current Tasks</h5>
                                            <div class="col">
                                                <?php
                                                $sqlTask = "SELECT * FROM tasks WHERE emp_id='$usertechid' AND Status IN (1,2)";
                                                $resultTask = $db->query($sqlTask);

                                                if ($resultTask->num_rows > 0) {

                                                    while ($rowTask = $resultTask->fetch_assoc()) {
                                                        ?>
                                                        <div class = "alert alert-primary m-1" style="color:black;font-weight: bold;">
                                                            <?php
                                                            $AppointmentNo = $rowTask['Appointment_id'];
                                                            $sqlAppDetails = "SELECT "
                                                                    . "jbc.AppDate,"
                                                                    . "jbc.JobCardNo,"
                                                                    . "jbc.appointmentId,"
                                                                    . "jbc.AppointmentNo,"
                                                                    . "jbc.AddDate,"
                                                                    . "cv.registerLetter,"
                                                                    . "cv.RegistrationNo,"
                                                                    . "vc.CatergoryName"
                                                                    . " FROM job_cards jbc "
                                                                    . "LEFT JOIN customervehicles cv ON jbc.VehicleNo=cv.vehicleId "
                                                                    . "LEFT JOIN vehicle_catergories vc ON vc.VCatergoryId=cv.VehicleType"
                                                                    . " WHERE jbc.AppointmentId='$AppointmentNo'";
                                                            $resultAppDetails = $db->query($sqlAppDetails);
                                                            $rowAppNo = $resultAppDetails->fetch_assoc();
                                                            ?> 

                                                            <div class="row">
                                                                <div class="col-sm">
                                                                    Job Card No : <?= $rowAppNo['JobCardNo']; ?>
                                                                </div>
                                                                <div class="col-sm">
                                                                    Appointment No : <?= $rowAppNo['AppointmentNo']; ?>
                                                                </div>
                                                                <div class="col-sm">
                                                                    <?php
                                                                    $endTime = $rowTask['UpdateDate'] . $rowTask['UpdateTime'];
                                                                    // Specify the end time in the format "YYYY-MM-DD HH:MM:SS"

                                                                    if ($endTime === "") {
                                                                        // If UpdateDate or UpdateTime is null, set the remaining time to 0.
                                                                        $remainingTime = "00:00";
                                                                    } else {
                                                                        $currentTimestamp = time();
                                                                        $endTimestamp = strtotime($endTime);
                                                                        $remainingSeconds = $currentTimestamp - $endTimestamp;
                                                                        $remainingMinutes = floor($remainingSeconds / 60);

                                                                        if ($remainingMinutes <= 0) {
                                                                            $remainingHours = 0;
                                                                            $remainingMinutes = 0;
                                                                        } else {
                                                                            $remainingHours = floor($remainingMinutes / 60);
                                                                            $remainingMinutes %= 60;

                                                                            $remainingHours = max($remainingHours, 0);
                                                                        }

                                                                        $remainingTime = sprintf("%02d:%02d", $remainingHours, $remainingMinutes);
                                                                    }
                                                                    ?>

                                                                    <h5 class="btn btn-success"><strong>Job Ongoing (Since) : <?= $remainingTime ?></strong></h5>
                                                                </div>
                                                                <div class="col-sm">
                                                                    <?php
                                                                    $endTime = $rowTask['AddDate'] . $rowTask['AddTime'];
                                                                    // Specify the end time in the format "YYYY-MM-DD HH:MM:SS"

                                                                    $currentTimestamp = time();
                                                                    $endTimestamp = strtotime($endTime);
                                                                    $remainingSeconds = $currentTimestamp - $endTimestamp;
                                                                    $remainingMinutes = floor($remainingSeconds / 60);

                                                                    if ($remainingMinutes <= 0) {
                                                                        $remainingHours = 0;
                                                                        $remainingMinutes = 0;
                                                                    } else {
                                                                        $remainingHours = floor($remainingMinutes / 60);
                                                                        $remainingMinutes %= 60;

                                                                        $remainingHours = max($remainingHours, 0);
                                                                    }

                                                                    $remainingTime = sprintf("%02d:%02d", $remainingHours, $remainingMinutes);
                                                                    ?>

                                                                    <h5 class="btn btn-danger"><strong>Time Spent : <?= $remainingTime ?></strong></h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm">
                                                                    Date : <?= $rowAppNo['AddDate']; ?>
                                                                </div>
                                                                <div class="col-sm">

                                                                    Vehicle No.<?= $rowAppNo['registerLetter'] . "-" . $rowAppNo['RegistrationNo']; ?>

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm">

                                                                    Vehicle Type : <?= $rowAppNo['CatergoryName'] ?>
                                                                </div>
                                                                <div class="col-sm">
                                                                    <?php
                                                                    $appointmentName = $rowAppNo['appointmentId'];
                                                                    $sqlService = "SELECT st.ServiceName FROM appointments app LEFT JOIN service st ON app.ServiceType=st.ServiceId WHERE app.AppointmentId='$appointmentName'";
                                                                    $resultServiceName = $db->query($sqlService);
                                                                    $rowServiceName = $resultServiceName->fetch_assoc();
                                                                    ?>

                                                                    <p>Service Type :</p><p class="btn btn-warning btn-sm"><strong><?= $rowServiceName['ServiceName'] ?></strong></p>

                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <?php
                                                        echo"<br>";
                                                    }
                                                } else {
                                                    echo "<div class='btn btn-secondary'>I'm Free to do Job</div>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </section>
</main>
<?php include'../footer.php'; ?>

<?php ob_end_flush(); ?>

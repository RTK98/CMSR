<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Skills</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewSkills.php" class="btn btn-sm btn-dark">View Skill List</a>
            </div>
            <div class="btn-group me-2">
                <a href="viewEmpSkill.php" class="btn btn-sm btn-dark">Employee Skills</a>
            </div>
        </div>
    </div>

    <section>
        <h5><strong>Skill List</strong></h5>

        <?php
        $db = dbconn();
         $sqlTechnician = "SELECT * FROM users where UserRole='technician' AND depId=2";
        $resultName = $db->query($sqlTechnician);
        ?>
        <div class="row">
            <?php
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
            ?>
        </div>
    </section>
        <section>
        <h5><strong>Skill List</strong></h5>

        <?php
        $db = dbconn();
        $sqlTechnician = "SELECT * FROM users where UserRole='technician' AND depId='3'";
        $resultName = $db->query($sqlTechnician);
        ?>
        <div class="row">
            <?php
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
            ?>
        </div>
    </section>
</main>
<?php include'../footer.php'; ?>
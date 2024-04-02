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
                <a href="viewJobCard.php" class="btn btn-sm btn-outline-secondary">view Job Cards</a>
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'add') {
        $db = dbconn();
        $sql = "SELECT * FROM inspections WHERE InspectionId='$InspectionId'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $CustomerName = $row['CustomerName'];
        $vehicleName = $row['VehicleNo'];
        $InpectedDate = $row['AddDate'];
        $InspectionNo = $row['InspectionNo'];
        $UserId = $row['AddUser'];
    }
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {

        $db = dbconn();
        $sql = "SELECT * FROM inspections WHERE InspectionId='$InspectionId'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $CustomerName = $row['CustomerName'];
        $vehicleName = $row['VehicleNo'];
        $InpectedDate = $row['AddDate'];
        $InspectionNo = $row['InspectionNo'];
        $UserId = $row['AddUser'];

        $AssignTaskEmp = inputTrim($AssignTaskEmp);
        $InspectionId = inputTrim($InspectionId);
        $messages = array();
        if (empty($AssignTaskEmp)) {
            $messages['error_id'] = "The Product Qty should not be blank..!";
        }
        if (!empty($InspectionId)) {
            $db = dbconn();
            $sql = "SELECT * FROM job_cardsrepair WHERE InspectionId='$InspectionId'";
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
            $JobCardNo = 'JCR' . $currentdatenumber . $randomNumber;

             $sql = "INSERT INTO job_cardsrepair(JobCardNo,InspectionId,empId,AddUser,AddDate,AddTime,Status) "
            . "VALUES ('$JobCardNo','$InspectionId','$AssignTaskEmp','$AddUser','$AddDate','$AddTime','1')";
            $db->query($sql);

             $sql2 = "INSERT INTO tasksrepair(Inspection_id,User_id,AddUser,AddDate,AddTime,Status) VALUES ('$InspectionId','$AssignTaskEmp','$AddUser','$AddDate','$AddTime','1')";
            $db->query($sql2);

             $sql3 = "UPDATE inspections SET Status='5' WHERE InspectionId='$InspectionId' ";
            $db->query($sql3);

            die();
        }
    }
    ?>  
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class = "card">
            <div class="card-body">
                <div class="text-danger"><?= @$messages['error_Job_card']; ?></div> 
                <section class="m-1">
                    <div class="card-header">
                        <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                             styly=" 
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
                                    <?php
                                    $db = dbconn();
                                    $sqlCusName = "SELECT FirstName,LastName FROM customer WHERE CustomerID='$CustomerName'";
                                    $resultCusName = $db->query($sqlCusName);
                                    $rowCusName = $resultCusName->fetch_assoc();
                                    ?> 
                                    <p> Customer Name : <?= $rowCusName['FirstName'] . ' ' . $rowCusName['LastName']; ?>
                                    </p>
                                </div>
                                <div>
                                    <?php
                                    $db = dbconn();
                                    $sqlVname = "SELECT registerLetter,RegistrationNo,VehicleType FROM customervehicles WHERE vehicleId='$vehicleName'";
                                    $resultVname = $db->query($sqlVname);
                                    $rowVname = $resultVname->fetch_assoc();
                                    ?>
                                    <p>Vehicle No : <?= $rowVname['registerLetter'] . ' - ' . $rowVname['RegistrationNo']; ?> </p>
                                </div>
                                <div>
                                    <?php
                                    $VehicleCatId = $rowVname['VehicleType'];
                                    $db = dbconn();
                                    $sqlCatName = "SELECT CatergoryName FROM vehicle_catergories WHERE VCatergoryId='$VehicleCatId'";
                                    $resultCatName = $db->query($sqlCatName);
                                    $rowCatName = $resultCatName->fetch_assoc();
                                    $catName = $rowCatName['CatergoryName'];
                                    ?>
                                    <p>Vehicle Type : <?= $rowCatName['CatergoryName']; ?></p>
                                </div>
                                <div>
                                    <p>Millage : <?= $row['Millege']; ?></p>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <p> INS Date :  <?= $InpectedDate ?></p>
                                </div>
                                <div>
                                    <p> INS NO. : <?= $InspectionNo ?></p>
                                </div>
                                <div>
                                    <?php
                                    $db = dbconn();
                                    $sqlAddUser = "SELECT FirstName,LastName FROM users WHERE UserId='$UserId'";
                                    $resultAddUser = $db->query($sqlAddUser);
                                    $rowAddUser = $resultAddUser->fetch_assoc();
                                    ?>
                                    <p>Inspection Officer : <?= $rowAddUser['FirstName'] . ' ' . $rowAddUser['LastName']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <?php
                    $db = dbconn();
                     $sql = "SELECT UserId,FirstName,LastName,UserRole from users LEFT JOIN attendance ON users.UserId=attendance.User_Id WHERE users.UserRole='technician' AND attendance.Status='1' AND users.depId='3';";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
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

                <input type="text" name="InspectionId" value="<?= $InspectionId ?>">
                <button type="submit" class="btn btn-primary" name="action" value="save">Save</button>
            </div>
        </div>
    </form>        
    <section>
        <h5><strong>Skill List</strong></h5>

        <?php
        $db = dbconn();
//$sqlTechnician = "SELECT nskills.emp_id, users.FirstName,users.lastName, nskills.skill_id FROM nskills INNER JOIN users ON nskills.emp_id=users.UserId;";
        $sqlTechnician = "SELECT * FROM users where UserRole='technician' AND depId=3";
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
                                                $sqlTask = "SELECT * FROM tasksrepair WHERE User_id='$usertechid' AND Status=1";
                                                $resultTask = $db->query($sqlTask);

                                                if ($resultTask->num_rows > 0) {

                                                    while ($rowTask = $resultTask->fetch_assoc()) {
                                                        ?>
                                                        <div class = "alert alert-primary m-1" style="color:black;font-weight: bold;">
                                                            <?php
                                                            $InspectionName = $rowTask['Inspection_id'];
                                                            $sqlAppDetails = "SELECT * FROM job_cardsrepair WHERE InspectionId='$InspectionName'";
                                                            $resultAppDetails = $db->query($sqlAppDetails);
                                                            $rowAppNo = $resultAppDetails->fetch_assoc();
                                                            ?> 

                                                            <div class="row">
                                                                <div class="col-sm">
                                                                    Job Card No : <?= $rowAppNo['JobCardNo']; ?>
                                                                </div>
                                                                <div class="col-sm">
                                                                    Inspection No : <?= $rowAppNo['InspectionId']; ?>
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
                                                                    <?php
                                                                    $InsNo = $rowAppNo['InspectionId'];
                                                                    $sqlInspection = "SELECT * FROM inspections WHERE InspectionId='$InsNo'";
                                                                    $resultInspection = $db->query($sqlInspection);
                                                                    $rowIns = $resultInspection->fetch_assoc();

                                                                    $vehicle = $rowAppNo['VehicleNo'];
                                                                    $sqlVehicle = "SELECT * FROM customervehicles WHERE vehicleId='$vehicle'";
                                                                    $resultVehicle = $db->query($sqlVehicle);
                                                                    $rowVehicle = $resultVehicle->fetch_assoc();
                                                                    ?>
                                                                    Vehicle No.<?= $rowVehicle['registerLetter'] . "-" . $rowVehicle['RegistrationNo']; ?>

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm">
                                                                    <?php
                                                                    $vehicle = $rowAppNo['VehicleNo'];
                                                                    $sqlVehicle1Cat = "SELECT * FROM appointments a JOIN customervehicles v ON a.VehicleNo = v.vehicleId JOIN vehicle_catergories vc ON v.VehicleType = vc.VCatergoryId WHERE a.VehicleNo = $vehicle";
                                                                    $resultVehicle1 = $db->query($sqlVehicle1Cat);
                                                                    $rowVehicle1 = $resultVehicle1->fetch_assoc();
                                                                    ?>
                                                                    Vehicle Type : <?= $rowVehicle1['CatergoryName'] ?>
                                                                </div>
                                                                <div class="col-sm">
                                                                    <?php
                                                                    $ServiceName = $rowAppNo['ServiceType'];
                                                                    $sqlService = "SELECT * FROM service WHERE ServiceId='$ServiceName'";
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

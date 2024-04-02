<?php ob_start(); ?>
<?php date_default_timezone_set("Asia/Colombo"); ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && (@$action == 'edit' || @$action ='save')) {
        $db = dbConn();
        $sql = "SELECT * FROM appointments WHERE AppointmentId='$AppointmentId'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $AppointmentNo = $row["AppointmentNo"];
        $CustomerID = $row["CustomerID"];
        $VehicleNo = $row["VehicleNo"];
        $AppDate = $row["AppDate"];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'save') {
        // echo  $TimeSlotStart=$row['$TimeSlotStart'];
        $AppointmentNo = $row["AppointmentNo"];
        $CustomerID = $row["CustomerID"];
        $VehicleNo = $row["VehicleNo"];
        $AppDate = $row["AppDate"];

        $messages = array();
        if (empty($AppointmentNo)) {
            $messages['error_Product_name'] = "The Product Name should not be blank..!";
        }
        if (empty($CustomerName)) {
            $messages['error_Product_price'] = "The Product Price should not be blank..!";
        }
        if (empty($VehicleNo)) {
            $messages['error_Product_qty'] = "The Product Qty should not be blank..!";
        }
        if (empty($CustomerNo)) {
            $messages['error_Product_qty'] = "The Product Qty should not be blank..!";
        }
        if (empty($AppDate)) {
            $messages['error_Product_qty'] = "The Product Qty should not be blank..!";
        }

        if (empty($AssignTaskEmp)) {
            $messages['error_id'] = "The Product Qty should not be blank..!";
        }
        if (!empty($AppointmentNo)) {
            $db = dbconn();
            $sql = "SELECT * FROM job_cards WHERE AppointmentNo='$AppointmentNo'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $messages['error_Job_card'] = "The Job Card Already Exists!";
            }
        }
        if (empty($messages)) {
            $AddDate = date('Y-m-d');
            $AddUser = $_SESSION['userId'];
            $db = dbconn();
             $sql = "INSERT INTO job_cards(AppointmentId,AppDate,AppointmentNo,CustomerId,VehicleNo,CustomerNo,timeslotidappointment,empId) "
            . "VALUES ('$AppointmentId','$AppDate','$AppointmentNo','$CustomerID','$VehicleNo','$CustomerID','$TimeSlotStart','$AssignTaskEmp')";
            $db->query($sql);

            $TaskId = $db->insert_id;
            $AddTime = date("H:i");
             $sql2 = "INSERT INTO tasks(Appointment_id,User_id,AppDate,AddTime,TimeSlotId,AddUser,AddDate,Status) VALUES ('$AppointmentId','$AssignTaskEmp','$AppDate','$AddTime','$TimeSlotStart','$AddUser','$AddDate',1)";
            $db->query($sql2);
            die();

            header('Location:addSuccess.php');
        }
    }
    ?>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="card">
            <div class="card-header">
                New Job Card
            </div>
            <div class="text-danger"><?= @$messages['error_Job_card']; ?></div>
            <div class="mb-3">
                <label for="AppointmentNo" class="form-label">Appointment No</label>
                <input type="hidden" class="form-control" id="AppointmentNo" name="AppointmentNo" value="<?= @$AppointmentNo ?>">
                <input type="text" class="form-control" id="AppointmentNo1" name="AppointmentNo1" value="<?= @$AppointmentNo ?>"
                       disabled>
            </div>
            <div class="mb-3">
                <label for="AppointmentDate" class="form-label">Appointment Date</label>
                <input type="hidden" class="form-control" id="AppointmentDate" name="AppointmentDate" value="<?= @$AppDate ?>">
                <input type="text" class="form-control" id="AppointmentDate1" name="AppointmentDate1" value="<?= @$AppDate ?>"
                       disabled>

            </div>
            <div class="mb-3">
                <label for="CustomerName" class="form-label">Name</label>
                <?php
                $CustomerID = $row['CustomerID'];
                 $sqlCustomer = "SELECT FirstName,LastName,HouseNo,Lane,Street,City FROM customer WHERE CustomerID='$CustomerID'";
                $db = dbconn();
                $resultCustomer = $db->query($sqlCustomer);
                $rowCustomer = $resultCustomer->fetch_assoc();
                ?>
                <input type="hidden" class="form-control" id="CustomerName" name="CustomerName" value="<?= @$CustomerID ?>">
                <input type="text" class="form-control" id="CustomerName1" name="CustomerName1" value="<?= $rowCustomer['FirstName'] . " " . $rowCustomer['LastName']; ?>"
                       disabled>
            </div>
            <div class="mb-3">
                <?php
                $CustomerID = $row['CustomerID'];
                 $sqlCustomerNo = "SELECT MobileNo,countryCode FROM customer_mobile WHERE CustomerID='$CustomerID'";
                $db = dbconn();
                $resultCustomerNumber = $db->query($sqlCustomerNo);
                $rowCustomerNumber = $resultCustomerNumber->fetch_assoc();
                ?>
                <label for="CustomerNo" class="form-label">Telephone</label>
                <input type="hidden" class="form-control" id="CustomerNo" name="CustomerNo" value="<?= @$CustomerID ?>">
                <input type="text" class="form-control" id="CustomerNo1" name="CustomerNo1" value="<?= $rowCustomerNumber['countryCode'] . $rowCustomerNumber['MobileNo']; ?>"
                       disabled>

            </div>
            <div class="mb-3">

                <label for="CustomerAddres" class="form-label">Address</label>
                <input type="hidden" class="form-control" id="CustomerAddres" name="CustomerAddres" value="<?= @$CustomerID ?>">
                <input type="text" class="form-control" id="CustomerAddres1" name="CustomerAddres1"
                       value="<?= $rowCustomer['HouseNo'] . "," . $rowCustomer['Lane'] . "," . $rowCustomer['Street'] . "," . $rowCustomer['City'] . "."; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="VehicleNo" class="form-label">Vehicle No.</label>
                <?php
                $vehicle = $row['VehicleNo'];
                $sqlVehicle = "SELECT * FROM customervehicles WHERE vehicleId='$vehicle'";
                $db = dbconn();
                $resultVehicle = $db->query($sqlVehicle);
                $rowVehicle = $resultVehicle->fetch_assoc();
                ?>
                <input type="hidden" id="VehicleNo" name="VehicleNo" value=" <?= $VehicleNo ?>">
                <input type="text" class="form-control" id="VehicleNoR" name="VehicleNoR" value=" <?= $rowVehicle['registerLetter'] . "-" . $rowVehicle['RegistrationNo']; ?>" disabled>
            </div>
            <div class="card-body">
                <?php
                $db = dbconn();
                $AddDate = date('Y-m-d');
                 $sql = "SELECT u.FirstName,u.LastName,u.UserId FROM empattendance empatt LEFT JOIN users u ON empatt.EmpId=u.UserId "
                . "WHERE empatt.Date='$AddDate'";
                $result = $db->query($sql);
//                $row = $result->fetch_assoc();
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
                <div class="card-footer">
                    <input type="text" name="AppointmentId" value="<?= $AppointmentId ?>">
                    <input type="text" name="TimeSlotStart" value="<?= $_POST ['TimeSlotStart'] ?>" >
                    <button type="submit" class="btn btn-primary" name="action" value="save">Save</button>
                </div>
            </div>
        </div>
        <section>
            <h5><strong>Skill List</strong></h5>

            <?php
            $db = dbconn();
//$sqlTechnician = "SELECT nskills.emp_id, users.FirstName,users.lastName, nskills.skill_id FROM nskills INNER JOIN users ON nskills.emp_id=users.UserId;";
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
                                            <div class="row">
                                                <h5>Current Tasks</h5>
                                                <div class="col">
                                                    <?php
                                                    $usertechid = $row11["UserId"];
                                                    $sqlTask = "SELECT * FROM tasks WHERE User_id='$usertechid' AND Status=1";
                                                    $resultTask = $db->query($sqlTask);

                                                    if ($resultTask->num_rows > 0) {

                                                        while ($rowTask = $resultTask->fetch_assoc()) {
                                                            ?>
                                                            <div class = "alert alert-primary m-1" style="color:black;font-weight: bold;">
                                                                <?php
                                                                $AppointmentName = $rowTask['Appointment_id'];
                                                                $sqlAppDetails = "SELECT * FROM appointments WHERE AppointmentId='$AppointmentName'";
                                                                $resultAppDetails = $db->query($sqlAppDetails);
                                                                $rowAppNo = $resultAppDetails->fetch_assoc();
                                                                ?> 

                                                                <div class="row">
                                                                    <div class="col-sm">
                                                                        Appointment No : <?= $rowAppNo['AppointmentNo']; ?>
                                                                    </div>
                                                                    <div class="col-sm">
                                                                        <?php
                                                                        $endTimeSlot = $rowTask['Appointment_id'];
                                                                        $sqlAppTimeSlot = "SELECT * FROM tasks WHERE Appointment_id='$endTimeSlot'";
                                                                        $resultAppTimeSlot = $db->query($sqlAppTimeSlot);
                                                                        $rowAppTimeSlot = $resultAppTimeSlot->fetch_assoc();

                                                                        $endTime = $rowAppTimeSlot['AddDate'] . $rowAppTimeSlot['AddTime'];
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
                                                                        Date : <?= $rowAppNo['AppDate']; ?>
                                                                    </div>
                                                                    <div class="col-sm">
                                                                        <?php
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


    </form>
</main>
<?php include'../footer.php'; ?>

<?php ob_end_flush(); ?>

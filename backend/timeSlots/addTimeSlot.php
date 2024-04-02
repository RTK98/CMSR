<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Time Slots</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="ViewTimeSlots.php" class="btn btn-sm btn-dark">View Time Slots</a> 
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                 style="
                 display: block;
                 margin-left: auto;
                 margin-right: auto;
                 ">
            <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
            <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
            <p class='m-1' style="text-align: center;">0779 200 480</p>

        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $TimeSlotName = inputTrim($TimeSlotName);
            $messages = array();
            if (empty($TimeSlotName)) {
                $messages['error_TimeSlot_name'] = "The Time Slot Name should not be blank..!";
            }
            if (empty($PerVehicles)) {
                $messages['error_Per_Vehicles'] = "The Per Vehicle Slot should not be blank..!";
            }
            if (!isset($TimeSlotStart)) {
                $messages['error_TimeSlot_Start'] = "The Starting Time should not be blank..!";
            }
            if (!isset($TimeSlotEnd)) {
                $messages['error_TimeSlot_End'] = "The End Time should not be blank..!";
            }
            if (!isset($TimeSlotStatus)) {
                $messages['error_TimeSlot_Status'] = "The Time Slot Status should not be blank..!";
            }
            //checking time slot 
            $startTime = $TimeSlotStart;
            echo $StrTime = strtotime($startTime);
            echo '<br>';
            $endTime = $TimeSlotEnd;
            echo $EndTime = strtotime($endTime);

            if ((isset($StrTime) && ($EndTime))) {
                if ($StrTime < $EndTime) {
                    
                } else {
                    $messages['error_TimeSlot_TimeRange'] = "Invalid Time Range..!";
                }
            } else {
                echo "Invalid time format.";
            }
            //advance validation
            if (!empty($TimeSlotStart)) {
                $db = dbconn();
                $sql = "SELECT * FROM timeslots WHERE TimeSlotStart='$TimeSlotStart' AND TimeSlotName='$TimeSlotName'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    $messages['error_TimeSlot_name'] = "The TimeSlot Already Exists!";
                }
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $sql = "INSERT INTO timeslots(day_Id,TimeSlotName,TimeSlotStart,TimeSlotEnd,TimeSlotStatus,PerVehicles,AddUser,AddDate) VALUES ('$id','$TimeSlotName', '$TimeSlotStart', '$TimeSlotEnd', '$TimeSlotStatus','$PerVehicles','1','$AddDate')";
                $db->query($sql);
            }
            ?>
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Time Slot has been Added Successfully',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = 'ViewTimeSlots.php'; // Redirect to success page
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
        //min="08:00" max="12:00"
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div>
                <h4 class='m-1'style="text-align: center; font-weight: bold;">Add Time Slot</h4>
            </div>
            <div class="card-body">
                <div class='row'>
                    <div class="col-5">
                        <label for="TimeSlotName" class="form-label">Time Slot Name :</label>
                        <input type="text" class="form-control" id="TimeSlotName" name="TimeSlotName"
                               placeholder="Enter Time Slot Name">
                        <div class="text-danger"><?= @$messages['error_TimeSlot_name']; ?></div>
                    </div>
                    <div class="col-7">

                    </div>

                    <div class="col-3">
                        <br>
                        <label for="TimeSlotStart" class="form-label">Time Slot Start Time :</label>
                        <input type="time" class="form-control" id="TimeSlotStart" name="TimeSlotStart"
                               placeholder="Enter Time Slot Start Time" min="08:00" max="17:00">
                        <div class="text-danger"><?= @$messages['error_TimeSlot_Start']; ?></div>
                    </div>
                    <div class="col-3">
                        <br>
                        <label for="TimeSlotEnd" class="form-label">Time Slot End Time :</label>
                        <input type="time" class="form-control" id="TimeSlotEnd" name="TimeSlotEnd"
                               placeholder="Enter Time Slot End Time" min="08:00" max="17:00">
                        <div class="text-danger"><?= @$messages['error_TimeSlot_End']; ?></div>
                    </div>
                    <div class="col-3">
                        <br>
                        <label for="PerVehicles" class="form-label">Per Vehicles.</label>
                        <input type="number" class="form-control" id="PerVehicles" name="PerVehicles"
                               min='1' placeholder="Please Enter Vehicle per slot">
                        <div class="text-danger"><?= @$messages['error_Per_Vehicles']; ?></div>
                    </div>
                    <div class="col-3">

                    </div>
                    <div class="col-4">
                        <br>
                        <label>Select Day</label>
                        <?php
                        $db = dbConn();
                        $sql = "SELECT id,name FROM days";
                        $result = $db->query($sql);
                        ?>
                        <select name="id">
                            <option value="">--</option>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-8">

                    </div>
                    <div class="col-3">
                        <br>
                        <label for="TimeSlotStatus" class="form-label">Time Slot Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TimeSlotStatus" id="Yes" value="1">
                            <label class="form-check-label" for="Yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TimeSlotStatus" id="No" value="0">
                            <label class="form-check-label" for="No">No</label>
                        </div>
                        <div class="text-danger"><?= @$messages['error_TimeSlot_Status']; ?></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </div>
</main>
<?php include'../footer.php'; ?>
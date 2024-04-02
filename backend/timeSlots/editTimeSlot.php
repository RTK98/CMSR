<?php ob_start(); ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Time Slot</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="ViewTimeSlots.php" class="btn btn-sm btn-outline-secondary">View Time Slots</a>
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
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "edit") {
            $db = dbConn();
            $sql = "SELECT * FROM timeslots WHERE TimeSlotId='$TimeSlotId'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            $TimeSlotName = $row["TimeSlotName"];
            $TimeSlotStart = $row["TimeSlotStart"];
            $TimeSlotEnd = $row["TimeSlotEnd"];
            $PerVehicles = $row["PerVehicles"];
            $TimeSlotStatus = $row['TimeSlotStatus'];
        }
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "cancel") {
            header("Location:ViewTimeSlots.php");
        }
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "update") {
            $TimeSlotName = inputTrim($TimeSlotName);
            $PerVehicles = inputTrim($PerVehicles);
            $messages = array();
            if (empty($TimeSlotName)) {
                $messages['error_Product_name'] = "The Product Name should not be blank..!";
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
            // advance validation
            if (!empty($TimeSlotStart)) {
                $db = dbconn();
                $sql = "SELECT * FROM timeslots WHERE TimeSlotStart='$TimeSlotStart' AND TimeSlotId='$TimeSlotId'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    $messages['error_Timeslot_Error'] = "The Time Slot Already Exists!";
                }
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                // $UserId =$_SESSION['userId'];
                 $sql = "UPDATE timeslots SET TimeSlotName='$TimeSlotName',TimeSlotStart='$TimeSlotStart',TimeSlotEnd='$TimeSlotEnd',TimeSlotStatus='$TimeSlotStatus',PerVehicles='$PerVehicles',UpdateUser='1',`UpdateDate`='$AddDate' WHERE TimeSlotId='$TimeSlotId'";
                $db->query($sql);
            }
            ?>
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Time Slot has been Update Successfully',
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
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div>
                <h4 class='m-1'style="text-align: center; font-weight: bold;">Edit Time Slot</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="TimeSlotName" class="form-label">Time Slot Name</label>
                    <input type="text" class="form-control" id="TimeSlotName" name="TimeSlotName"
                           placeholder="Enter Time Slot Name" value='<?= @$TimeSlotName ?>'>
                    <div class="text-danger"><?= @$messages['error_TimeSlot_name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="TimeSlotStart" class="form-label">Time Slot Start Time</label>
                    <input type="time" class="form-control" id="TimeSlotStart" name="TimeSlotStart"
                           placeholder="Enter Time Slot Start Time" min="08:00" max="12:00" value='<?= @$TimeSlotStart ?>'>
                    <div class="text-danger"><?= @$messages['error_TimeSlot_Start']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="TimeSlotEnd" class="form-label">Time Slot End Time</label>
                    <input type="time" class="form-control" id="TimeSlotEnd" name="TimeSlotEnd"
                           placeholder="Enter Time Slot End Time" min="08:00" max="12:00" value='<?= @$TimeSlotEnd ?>'>
                    <div class="text-danger"><?= @$messages['error_TimeSlot_End']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="PerVehicles" class="form-label">Per Vehicles.</label>
                    <input type="text" class="form-control" id="PerVehicles" name="PerVehicles"
                           placeholder="Please Enter Vehicle per slot" value='<?= @$PerVehicles ?>'>
                    <div class="text-danger"><?= @$messages['error_Per_Vehicles']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="TimeSlotStatus" class="form-label">Time Slot Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="TimeSlotStatus" id="Yes" value="1"
                        <?php
                        if (@$TimeSlotStatus == '1') {
                            echo 'checked';
                        }
                        ?>>
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="TimeSlotStatus" id="No" value="0"
                        <?php
                        if (@$TimeSlotStatus == '0') {
                            echo 'checked';
                        }
                        ?>>
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_TimeSlot_Status']; ?></div>
                </div>
            </div>
        </form>
        <div class="card-footer">
            <input type="hidden" name="TimeSlotId" value="<?= $TimeSlotId ?>">
            <button type="submit" class="btn btn-primary btn-sm" name="action" value="update">Submit</button>
             <a href="ViewTimeSlots.php" class="btn btn-sm btn-danger">Cancel</a>
        </div>
    </div>
</main>
<?php include'../footer.php'; ?>
<?php ob_end_flush(); ?>
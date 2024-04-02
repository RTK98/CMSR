
<?php
ob_start();
include'../header.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Appointments</h1>
    </div>
    <div class="card">
        <div class="card-header">
            Make Appointments
        </div>
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
//            echo $vehiclenoid;
            echo $dateww;
            echo $timezz;
            echo $ServiceType;
            $customeridzz = $_SESSION['CustomerID'];
            $messages = array();

            if ($ServiceType == 'NoService') {
                $messages['error_First_Name'] = "The First Name should not be blank..!";
            }
//            if (empty($vehiclenoid)) {
//                $messages['error_vehicle'] = "The First Name should not be blank..!";
//            }
            if (empty($messages)) {
                $db = dbConn();
                $AddDate = date('Y-m-d');
                $timestamp = strtotime($AddDate);
                $currentdatenumber = date('Ymd', $timestamp);
                $rand = rand();
                $AppointmentNo = $currentdatenumber . $rand;
                $sqlqwe = "INSERT INTO appointments(AppointmentNo, CustomerID, VehicleNo, AppDate, TimeSlotStart, ServiceType, appointmentStatus) VALUES ('$AppointmentNo','$customeridzz','$vehicleId','$dateww','$timezz','$ServiceType','1')";
                $resultasd = $db->query($sqlqwe);
                // echo

                $ProductId = $db->insert_id;
                echo $sql3 = "INSERT INTO appointmenthandling(TimeSlotId, AppointmentId, AppDate) VALUES ('$timezz','$ProductId','$dateww')";
                $db->query($sql3);
            }
        }
        ?>
        <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" id="formcustomer">
            <div class="card-body">
                <div class="text-danger"><?= @$messages['error_Appointment_TimeSlot']; ?></div>
                <?php
                $db = dbConn();
                $customeridz = $_SESSION['CustomerID'];

                $sqlaa = "SELECT * FROM customervehicles WHERE CustomerID='$customeridz' ";
                $resultaa = $db->query($sqlaa);
//                $row = $resultaa->fetch_assoc();
//                var_dump($row);
                ?>
                <div class="row">
                    <?php
                    if ($resultaa->num_rows > 0) {
                        $id = 0;
                        while ($row = $resultaa->fetch_assoc()) {
                            ?>
                            <div class="col-md-4">  
                                <div class="card-group">
                                    <div class="card">
                                        <img src="<?= SYSTEM_PATH ?>assets/img/myVehicleImage/<?= $row['VehicleImage'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $row['VehicleModel'] ?></h5>
                                            <p class="card-text"><?= $row['registerLetter'] . " - " . $row['RegistrationNo'] ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <div  class="form-check form-check-inline">
                                                <?php echo $id = $row['vehicleId'] ?>

                                                <input type="radio" id="vehicleId" name="vehicleId" value="<?= $id ?>">   
                                                <!-- <input type="hidden" id="vehicleType-<?= $row['VehicleType'] ?>" name="vehicleType" value="<?= $row['VehicleType'] ?>" onclick="test()"> -->

                                            </div>

                                            <div class="text-danger"><?= @$messages['error_Product_status']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }$id = 0;
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <?php $datezz = $_SESSION['reqdate'] ?>
                    <label for="AppDate" class="form-label">Appointment Date</label>
                    <input disabled type="date" class="form-control" value="<?= $datezz ?>" id="AppDate" name="AppDate"
                           placeholder="Enter Appointment Date" min="<?php echo date('Y-m-d'); ?>"
                           max='<?php echo date("Y-m-d", strtotime("+4 days")); ?>'>
                    <input type="hidden" name="dateww" value="<?= $datezz ?>">
                    <div class="text-danger"><?= @$messages['error_Appointment_Date']; ?></div>
                </div>
                <div class="mb-3">
                    <?php
                    $timeslot = $_SESSION['slotnameid'];
                    $db = dbconn();
                    $sqlzzz = "SELECT * FROM timeslots WHERE  TimeSlotId='$timeslot'";
                    $resultzzz = $db->query($sqlzzz);
                    $rowzz = $resultzzz->fetch_assoc();
                    $slotnamezz = $rowzz['TimeSlotName'];
                    ?>
                    <label for="AppDate" class="form-label">Appointment Time</label>
                    <input disabled type="text" class="form-control" value="<?= $slotnamezz ?>" id="AppDate" name="Apptime" >
                    <input type="hidden" name="timezz" value="<?= $timeslot ?>">

                    <div class="text-danger"><?= @$messages['error_Appointment_Date']; ?></div>
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT ServiceName FROM service";
                $result = $db->query($sql);
                ?>
                <div class="mb-3">
                    <label for="ServiceType" class="form-label">Service Type</label>
                    <select class="form-select" aria-label="Default select example" name="ServiceType" id="ServiceType" onchange="loadbill()">
                        <!-- Success data will  display -->
                    </select>
                    <div class="text-danger"><?= @$messages['error_First_Name']; ?></div>
                </div>
                <p id="demo"name="ServiceId" id="ServiceId">
                    <>
                </p>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</main>
<?php include'../footer.php'; ?>

<script>

    $('input[name="vehicleId"]').on("click", function () {
        var car = $('input[name="vehicleId"]:checked').val();
        $.ajax({
            url: "appointmentService.php",
            method: "POST",
            data: {vehicleId: car},
            success: function (data)
            {
                $('#ServiceType').html(data);

            }
        });
    });
</script>

<script>
    function loadbill() {
        var formData = $('#formcustomer').serialize();
        alert('abc');
//        $.ajax({
//            type: 'POST',
//            url: 'check.php',
//            data: formData,
//            success: function (response) {
//               $('#productlist').html(response);
//                //$('#citylist').modal('show');
//                //alert(response)
//            },
//            error: function () {
//                alert('Error submitting the form!');
//            }
//        });
    }
</script>


<?php ob_end_flush(); ?>
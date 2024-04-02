
<?php
ob_start();
include'../header.php';
include'rand.php';
include '../assets/phpmail/mail.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 addappointment-main">
    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        extract($_POST);
//            echo $vehiclenoid;
        $dateww;
        $timezz;
        $ServiceType;
        $vehicleId;
        $customeridzz = $_SESSION['CustomerID'];
        $messages = array();

        if ($ServiceType == '0') {
            $messages['error_Vehicle_TimeSlot_Date'] = "Please select the Servie Type...!";
        }


        if (!isset($vehicleId)) {
            $messages['error_Vehicle_TimeSlot_Date'] = "Please select the Vehicle...!";
        }
//            if (empty($vehiclenoid)) {
//                $messages['error_vehicle'] = "The First Name should not be blank..!";
//            }
        if (!empty($timezz && $dateww && $vehicleId)) {
            $db = dbconn();
            $sql = "SELECT * FROM appointmenthandling WHERE TimeSlotId='$timezz' AND AppDate='$dateww' AND Vehicle_Id='$vehicleId'";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                $messages['error_Vehicle_TimeSlot_Date'] = "The Vehicle Already Exists on Time Slot!";
            }
        }
        if (empty($messages)) {
            $db = dbConn();
            $AddDate = date('Y-m-d');
            $timestamp = strtotime($AddDate);
            $currentdatenumber = date('Ymd', $timestamp);
            $randomNumber;
            $AppointmentNo = 'APP' . $currentdatenumber . $randomNumber;
            $sqlqwe = "INSERT INTO appointments(AppointmentNo, CustomerID, VehicleNo, AppDate, TimeSlotStart, ServiceType, appointmentStatus) VALUES ('$AppointmentNo','$customeridzz','$vehicleId','$dateww','$timezz','$ServiceType','1')";
            $resultasd = $db->query($sqlqwe);

            // echo
            $ProductId = $db->insert_id;
            $sql3 = "INSERT INTO appointmenthandling(TimeSlotId, AppointmentId, AppDate,Vehicle_Id) VALUES ('$timezz','$ProductId','$dateww','$vehicleId')";
            $db->query($sql3);

            //this queries for the email body

            $CustomerID = $_SESSION['CustomerID'];
            $db = dbconn();
            $sqlAppNum = "SELECT * FROM appointments WHERE CustomerID=$CustomerID ORDER BY appointments.AppointmentId DESC LIMIT 1";
            $resultAppNum = $db->query($sqlAppNum);
            $row = $resultAppNum->fetch_assoc();
            $appNum = $row["AppointmentNo"];
            $appDate = $row["AppDate"];

            $VehicleNO = $row["VehicleNo"];
            $db = dbconn();
            $sqlGetVehicle = "SELECT registerLetter,RegistrationNo FROM customervehicles WHERE CustomerID=$CustomerID AND vehicleId=$VehicleNO";
            $resultVehicleNum = $db->query($sqlGetVehicle);
            $row1 = $resultVehicleNum->fetch_assoc();
            $vehicleNumber = $row1["registerLetter"] . '-' . $row1["RegistrationNo"];

            $TimeSlot = $row["TimeSlotStart"];
            $db = dbconn();
            $sqlTimeSlot = "SELECT * FROM timeslots WHERE TimeSlotId=$TimeSlot";
            $resultTimeSlotName = $db->query($sqlTimeSlot);
            $row2 = $resultTimeSlotName->fetch_assoc();
            $timeSlot = $row2["TimeSlotStart"] . ' ' . '-' . ' ' . $row2["TimeSlotEnd"];
            $timeSlotName = $row2["TimeSlotName"];

            $ServiceType = $row["ServiceType"];
            $db = dbconn();
            $sqlSType = "SELECT ServiceName FROM service WHERE serviceId=$ServiceType";
            $resultSname = $db->query($sqlSType);
            $row3 = $resultSname->fetch_assoc();
            $serviceName = $row3["ServiceName"];
            //end of the email body content sql
            //Start Email Sending Part
            $FirstName = $_SESSION['FirstName'];
            $LastName = $_SESSION['LastName'];
            $email = $_SESSION['Email'];

            echo $to = $email;
            echo $toname = $FirstName . $LastName;
            echo $subject = "Successfully Added Apointment" . $vehicleNumber . " " . $dateww . " " . $serviceName;
            $body = '<!doctype html>
                <html lang="en-US">
                    <head>
                        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                        <title>Appointment Successfully Added</title>
                        <meta name="description" content="Reset Password Email">
                        <style type="text/css">
                            body{
                                background-image:url(https://www.dropbox.com/s/d8fqrtfnmh6x3a0/background.png?raw=1);
                            }
                            a:hover {
                                text-decoration: underline !important;
                            }
                        </style>
                    </head>

                    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                        <!--100% body table-->
                        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                               style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
                            <tr>
                                <td>
                                    <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                                           align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="height:80px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                                <a href="#" title="logo" target="_blank">
                                                    <img width="60" src="https://www.dropbox.com/s/h8nzlij6m45t6cr/logo.png?raw=1" title="logo" alt="logo">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:20px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                       style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                    <tr>
                                                        <td style="height:40px;">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0 35px;">
                                                           <p><strong> Your Appointment Id :' . $appNum . '</strong><br/>
            <p>Your Vehicle Id :' . $vehicleNumber . '<br/>
            <p style="color:red; font-weight: bold;">Your Appointment Date : ' . $appDate . '<br/>
            <p>Your Time Slot Name : ' . $timeSlotName . '<br/>
            <p style ="color:red; font-weight: bold;">Your Time Slot :' . $timeSlot . '<br/>
            <p>Your Service Type : ' . $serviceName . '<br/>
            <p  style ="color:red; font-weight: bold; font-size: 18px;" >Please Visit the Service Area Before 10 minutes on Your Booked Time</p> 
            <p style ="color:green; font-weight: bold; font-size: 15px;">We received your Appointment request;<br/> we will be in touch shortly!</p>
                </td>
                </tr>
                <tr>
                <td style = "height:40px;">&nbsp;
                </td>
                </tr>
                </table>
                </td>
                <tr>
                <td style = "height:20px;">&nbsp;
                </td>
                </tr>
                <tr>
                <td style = "text-align:center;">
                <p style = "font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy;
                <strong>Replica Speed Motor Garage V.1.0</strong></p>
                </td>
                </tr>
                <tr>
                <td style = "height:20px;">&nbsp;
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                <!--/100% body table-->
                </body>

                </html>';
            echo $alt = "Appointment";
            send_email($to, $toname, $subject, $body, $alt);

            if ($results) {
                echo "";
            }
            header("Location:successMessage.php");
        }
        //End Email Sending Part
    }
    ?>
    <?php $datezz = $_SESSION['reqdate'] ?>
    <a type="button" class="btn btn-primary btn-sm" href="http://localhost/CMSR/web/appointments/viewAppointment.php?date=<?= $datezz ?>">Go Back</a>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Appointments</h1>
    </div>
    <div class="card card-appointment">
        <div class="card-header">
            Make Appointments
        </div>
        <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="formapp">
            <?php if (@$messages['error_Vehicle_TimeSlot_Date']) {
                ?>
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <?= @$messages['error_Vehicle_TimeSlot_Date']; ?>
                    </div>
                <?php } ?>
                <?php
                $db = dbConn();
                $customeridz = $_SESSION['CustomerID'];

                $sqlaa = "SELECT cv.vehicleId,cv.VehicleImage,cv.registerLetter,cv.RegistrationNo,vm.ModelName "
                        . "FROM customervehicles cv "
                        . "LEFT JOIN vehiclemodels vm ON cv.VehicleModel=vm.VehicleModelsId "
                        . "WHERE CustomerID='$customeridz' ";
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
                                    <div class="card card-v">
                                        <img src="<?= SYSTEM_PATH ?>assets/img/myVehicleImage/<?= $row['VehicleImage'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= ucwords($row['ModelName']) ?></h5>
                                            <p class="card-text"><?= $row['registerLetter'] . " - " . $row['RegistrationNo'] ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <div  class="form-check form-check-inline">
                                                <?php $id = $row['vehicleId'] ?>
                                                <input type="radio" id="vehicleId" name="vehicleId" value="<?= $id ?>">
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
                           max='<?php echo date("Y-m-d", strtotime("+4 days"));
                    ?>'>
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
                <div class="mb-3">
                    <label for="ServiceType" class="form-label">Service Type</label>
                    <select class="form-select" aria-label="Default select example" name="ServiceType" id="ServiceType" onChange="myFunction()">

                    </select>
                    <div class="text-danger"><?= @$messages['error_First_Name']; ?></div>
                </div>
                <p id="demo"name="ServiceId" id="ServiceId">

                </p>
                <div class="" id="listproduct" >

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <div class="btn-group me-2">
                        <a href="<?= SYSTEM_PATH ?>index.php" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
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
    function myFunction() {
        var formData = $('#formapp').serialize();
        $.ajax({
            type: 'POST',
            url: 'checkprice.php',
            data: formData,
            success: function (response) {
                $('#listproduct').html(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>
<?php ob_end_flush(); ?>
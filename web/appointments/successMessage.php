<?php
ob_start();
include'../header.php';
?>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    </head>
    <style>
        body {
            text-align: center;
            /* padding: 40px 0; */
            background: #EBF0F5;
        }
        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }
        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size:20px;
            margin: 0;
        }
        i {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left:-15px;
        }
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
    </style>
    <body>
        <div class="card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
<!--                <i class="checkmark">✓</i>-->
                <i class="checkmark"><img src="../assets/img/Success.png" alt="alt" style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;"/></i>
            </div>
            <h1>Success</h1> 
            <?php
            $CustomerID = $_SESSION['CustomerID'];
            $db = dbconn();
            $sqlAppNum = "SELECT * FROM appointments WHERE CustomerID=$CustomerID ORDER BY appointments.AppointmentId DESC LIMIT 1";
            $resultAppNum = $db->query($sqlAppNum);
            $row = $resultAppNum->fetch_assoc();

            $VehicleNO = $row["VehicleNo"];
            $db = dbconn();
            $sqlGetVehicle = "SELECT registerLetter,RegistrationNo FROM customervehicles WHERE CustomerID=$CustomerID AND vehicleId=$VehicleNO";
            $resultVehicleNum = $db->query($sqlGetVehicle);
            $row1 = $resultVehicleNum->fetch_assoc();

            $TimeSlot = $row["TimeSlotStart"];
            $db = dbconn();
            $sqlTimeSlot = "SELECT * FROM timeslots WHERE TimeSlotId=$TimeSlot";
            $resultTimeSlotName = $db->query($sqlTimeSlot);
            $row2 = $resultTimeSlotName->fetch_assoc();

            $ServiceType = $row["ServiceType"];
            $db = dbconn();
            $sqlSType = "SELECT ServiceName FROM service WHERE serviceId=$ServiceType";
            $resultSname = $db->query($sqlSType);
            $row3 = $resultSname->fetch_assoc();
            ?>
            <p><strong> Your Appointment Id : <?= $row["AppointmentNo"] ?></strong><br/>
            <p>Your Vehicle Id : <?= $row1["registerLetter"] . '-' . $row1["RegistrationNo"] ?><br/>
            <p style="color:red; font-weight: bold;">Your Appointment Date : <?= $row["AppDate"] ?><br/>
            <p>Your Time Slot Name : <?= $row2["TimeSlotName"] ?><br/>
            <p style ="color:red; font-weight: bold;">Your Time Slot : <?= $row2["TimeSlotStart"] . ' ' . '-' . ' ' . $row2["TimeSlotEnd"] ?><br/>
            <p>Your Service Type : <?= $row3["ServiceName"] ?><br/>
            <p  style ="color:red; font-weight: bold; font-size: 18px;" >Please Visit the Service Area Before 10 minutes on Your Booked Time</p> 
            <p style ="color:green; font-weight: bold; font-size: 15px;">We received your Appointment request;<br/> we'll be in touch shortly!</p>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>appointments/myAppointments.php" class="btn btn-danger">Close</a>
            </div>
        </div>
    </body>
</html>
<?php include'../footer.php'; ?>
<?php ob_end_flush(); ?>
<?php
ob_start();
include'../header.php';
include'../menu.php';

include '../assets/phpmail/mail.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style='background-color: white;'>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cancel Appointment</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">Appointment List</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'delete') {
                        $appointmentId;
                        $db = dbconn();
                        $sql = "SELECT * FROM appointments WHERE AppointmentId='$appointmentId'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();

                        $AppoinmentNo = $row['AppointmentNo'];
                        $CustomerName = $row['CustomerID'];
                        $VehicleNo = $row['VehicleNo'];
                        $AppointmentDate = $row['AppDate'];
                        $TimeSlot = $row['TimeSlotStart'];
                        $ServiceType = $row['ServiceType'];
                        $AppointmentStatus = $row['appointmentStatus'];
                    }
                    ?>
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'add') {
                        $addeduser = $_SESSION['CustomerID'];
                        $adddate = date("Y-m-d");
                        $appointmentId;
                        $CancelReason = inputTrim($CancelReason);
                        $messages = array();
                        if (!isset($CancelReason)) {
                            $messages['error_Cancel_Reason'] = "The Reason should not be blank..!";
                        }
                        if (empty($messages)) {
                            $db = dbConn();
                            $CustomerName;
                             $sqlCancelReason = "INSERT INTO appointmentcanceled(AppCanceledId,CustomerId,Reason,UpdateUser,UpdateDate) VALUES ('$appointmentId','$CustomerName','$CancelReason','$addeduser','$adddate')";
                            $resultCancelReason = $db->query($sqlCancelReason);

                             $sqlCancelUpdate = "UPDATE appointments SET appointmentStatus='4' WHERE AppointmentId='$appointmentId'";
                            $db->query($sqlCancelUpdate);

                             $sqlCancelDelete = "DELETE FROM appointmenthandling WHERE AppointmentId='$appointmentId'";
                            $db->query($sqlCancelDelete);
//                             email body items = $_SESSION['CustomerID'];
                            $db = dbconn();
                             $sqlAppNum = "SELECT * FROM appointments INNER JOIN appointmentcanceled ON appointmentcanceled.AppCanceledId=appointments.AppointmentId WHERE appointments.CustomerID='$addeduser' ORDER BY appointmentcanceled.AppCanceledId DESC LIMIT 1;";
                            $resultAppNum = $db->query($sqlAppNum);
                            $row = $resultAppNum->fetch_assoc();
                            $appNum = $row["AppointmentNo"];
                            $appDate = $row["AppDate"];

                            $VehicleNo = $row['VehicleNo'];
                            $db = dbconn();
                            $sqlGetVehicle = "SELECT registerLetter,RegistrationNo FROM customervehicles WHERE CustomerID='$addeduser' AND vehicleId='$VehicleNo'";
                            $resultVehicleNum = $db->query($sqlGetVehicle);
                            $row1 = $resultVehicleNum->fetch_assoc();
                            $vehicleNumber = $row1["registerLetter"] . '-' . $row1["RegistrationNo"];

                            $TimeSlot = $row["TimeSlotStart"];
                            $db = dbconn();
                            $sqlTimeSlot = "SELECT * FROM timeslots WHERE TimeSlotId='$TimeSlot'";
                            $resultTimeSlotName = $db->query($sqlTimeSlot);
                            $row2 = $resultTimeSlotName->fetch_assoc();
                            $timeSlot = $row2["TimeSlotStart"] . ' ' . '-' . ' ' . $row2["TimeSlotEnd"];
                            $timeSlotName = $row2["TimeSlotName"];

                            $ServiceType = $row["ServiceType"];
                            $db = dbconn();
                            $sqlSType = "SELECT ServiceName FROM service WHERE serviceId='$ServiceType'";
                            $resultSname = $db->query($sqlSType);
                            $row3 = $resultSname->fetch_assoc();
                            $serviceName = $row3["ServiceName"];
                            //end of the email body content sql
                            //Start Email Sending Part
                            $db = dbconn();
                            $CustomerName = $row['CustomerID'];
                            $sqlCusName = "SELECT FirstName,LastName,Email FROM customer WHERE CustomerID='$CustomerName'";
                            $resultCusName = $db->query($sqlCusName);
                            $rowCusName = $resultCusName->fetch_assoc();

                            echo $FirstName = $rowCusName['FirstName'];
                            echo $LastName = $rowCusName['LastName'];
                            echo $email = $rowCusName['Email'];
                            $to = $email;
                            $toname = $FirstName . $LastName;
                            $subject = "You have Canceled the Apointment" . " " . $vehicleNumber . " " . $dateww . " " . $serviceName;
                            $body = '<!doctype html>
                <html lang="en-US">
                    <head>
                        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                        <title>Appointment Successfully Canceld</title>
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
            <p  style ="color:red; font-weight: bold; font-size: 18px;" >Your Appointment is Cancel</p> 
            <p style ="color:green; font-weight: bold; font-size: 15px;">We understand that circumstances may change, and we are here to assist you with any further inquiries or alternative arrangements you may require.;<br/>Thank you for choosing Replica Speed Motor Garage!</p>
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
                            header("Location:viewAppointment.php");
                        }
                    }
                    ?>
                    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <div class="card-body">
                            <section class="m-1">
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
                                <div class="card-body">
                                    <div>
                                        <h4 class='m-1'style="text-align: center; font-weight: bold;">Appointment Report</h4>
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
                                                $sqlVname = "SELECT registerLetter,RegistrationNo,VehicleType FROM customervehicles WHERE vehicleId='$VehicleNo'";
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
                                                <?php
                                                $db = dbconn();
                                                $sqlTimeSlot = "SELECT TimeSlotName,TimeSlotStart,TimeSlotEnd FROM timeslots WHERE TimeSlotId='$TimeSlot'";
                                                $resultTimeSlotName = $db->query($sqlTimeSlot);
                                                $rowTimeSlot = $resultTimeSlotName->fetch_assoc();
                                                ?>
                                                <p>Time Slot : <?= $rowTimeSlot['TimeSlotName']; ?></p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <p> Appointment Date :  <?= $AppointmentDate ?></p>
                                            </div>
                                            <div>
                                                <p> Appointment NO. : <?= $AppoinmentNo ?></p>
                                            </div>
                                            <div>
                                                <?php
                                                $appointmentStatus = $row['appointmentStatus'];
                                                $statusDescription = '';

                                                switch ($appointmentStatus) {
                                                    case 1:
                                                        $statusDescription = "Pending";
                                                        $statusColor = "btn btn-warning btn-sm";
                                                        break;
                                                    case 2:
                                                        $statusDescription = "In Porgress";
                                                        $statusColor = "btn btn-success btn-sm";
                                                        break;
                                                    case 3:
                                                        $statusDescription = "Complete";
                                                        $statusColor = "btn btn-primary btn-sm";
                                                        break;
                                                    case 4:
                                                        $statusDescription = "Canceled";
                                                        $statusColor = "btn btn-danger btn-sm";
                                                        break;
                                                    default:
                                                        $statusDescription = "Not Available";
                                                        $statusColor = "btn btn-secondary btn-sm";
                                                        break;
                                                }
                                                ?>
                                                <p>Appointment  :  <span class='<?= $statusColor; ?>'><?= $statusDescription; ?></span></p>
                                            </div>
                                            <div>
                                                <p>Time : <?= $rowTimeSlot['TimeSlotStart'] . ' - ' . $rowTimeSlot['TimeSlotEnd']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="mb-3">
                                    <label>Cancel Reason</label>
                                    <?php
                                    $db = dbConn();
                                    $sqlCategory = "SELECT * FROM cancelreasoninternal";
                                    $resultCategory = $db->query($sqlCategory);
                                    ?>
                                    <select name="CancelReason" id='CancelReason'>
                                        <option value="">--</option>
                                        <?php
                                        if ($resultCategory->num_rows > 0) {
                                            while ($row = $resultCategory->fetch_assoc()) {
                                                ?>
                                                <option value="<?= $row['ReasonId'] ?>" <?php
                                                if (@$SupplierName == ucwords($row['ReasonName'])) {
                                                    echo "selected";
                                                }
                                                ?>><?= ucwords($row['ReasonName']) ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                    </select>
                                </div>
                            </section>
                                <input type="text" name="CustomerName" value="<?= $CustomerName ?>">
                            <input type="text" name="appointmentId" value="<?= $appointmentId ?>">
                            <button type="submit" class="btn btn-primary" name="action" value="add" onclick="return confirm('Are you sure to Cancel Appointment?')" >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include'../footer.php'; ?>
<script>
    function loadCustomerName() {
////        alert("loadCustomerName");
//        var formData = $('#addSkills').serialize();
        var selectedOption = $('#CategoryName').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadProducts.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#ProductName').html(response);
//                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
//    $(document).ready(function(){
//    $('#CategoryName').on('change', function(){
//    var CategoryId = $(this).val();
//            console.log('CategoryId');
//            if (CategoryId){
//    $.ajax({
//    type:'POST',
//            url:'loadProducts.php',
//            data:'CatergoryID=' + CategoryId,
//            success:function(html){
//            $('#ProductName').html(html);
//            }
//    });
//    });
//    }};
</script>
<?php ob_end_flush(); ?>s
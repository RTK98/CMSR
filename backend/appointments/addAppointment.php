<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
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
         if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $VehicleNo = inputTrim($VehicleNo);
            $messages = array();
            if(empty($VehicleNo)){
                $messages['error_Vehicle_No'] = "The Vehicle Number should not be blank..!";
            }
            if(!isset($AppointmentTime)){
                $messages['error_Appointment_Time'] = "The Appointment Time should not be blank..!";
            }
            if(!isset($AppDate)){
                $messages['error_Appointment_Date'] = "The Appointment Date should not be blank..!";
            }
           //advance validation
            if(!empty($VehicleNo)){
                $db = dbconn();
                $sql="SELECT * FROM appointments WHERE VehicleNo='$VehicleNo'";
                $result=$db->query($sql);
                if($result->num_rows>0){
                    $messages['error_Vehicle_No'] = "The Vehicle Already Exists!";
                }
            }
            if(isset($AppointmentTime)){
                $db=dbconn();
                $sql="SELECT * FROM appointmenthandling  WHERE  TimeSlotId='$AppointmentTime' AND AppDate='$AppDate'";
                $results = $db->query($sql);
                if($results->num_rows == 0){
                    $timeidslot = $AppointmentTime;
                    $rowcount = 0;
                } else{
                    $rowcount=mysqli_num_rows($results);
                    $row = $results->fetch_assoc();
                    print_r($row);
    
                   echo  $timeidslot= $row['TimeSlotId'];

                }
               


                //$sql="SELECT * FROM appointmenthandling,timeslots  WHERE appointmenthandling.AppHandling=timeslots.TimeSlotId  AND TimeSlotId='$AppointmentTime' AND AppDate='$AppDate' "; 
                //TimeSlotId='$AppointmentTime' AND AppDate='$AppDate'
                //echo $sql="SELECT  appointmenthandling.AppHandling AS AppHandling, appointmenthandling.TimeSlotId AS timeslotidapp, appointmenthandling.AppointmentId AS AppointmentId, appointmenthandling.AppDate AS AppDate, timeslots.TimeSlotId AS TimeSlotIdtime, timeslots.PerVehicles AS PerVehicles FROM appointmenthandling,timeslots WHERE appointmenthandling.TimeSlotId = timeslots.TimeSlotId AND appointmenthandling.TimeSlotId='$AppointmentTime' AND appointmenthandling.AppDate='$AppDate';";
                //$result=$db->query($sql);
                
             
             if($rowcount == 0){

                $sql="SELECT * FROM timeslots WHERE TimeSlotId=$timeidslot";
                $results = $db->query($sql);
                @$row= @$results->fetch_assoc();
                echo "<br>";

                echo $appointmentcount=$row['PerVehicles'];

             }else{
                $sql="SELECT * FROM timeslots WHERE TimeSlotId=$timeidslot";
                $results = $db->query($sql);
                @$row= @$results->fetch_assoc();
                echo "<br>";

                echo $appointmentcount=$row['PerVehicles'];

             }
               
echo "<br>";

            // print_r($rowxx);
            // echo $abc=$rowxx['TimeSlotId'];
            //  print_r($rowxx);
                if ( $rowcount ==null){
                    echo $rowcount . "null ";
                }else{
                    echo $rowcount . "not null";
                }
                
                

                // die();
               
                if($rowcount == null || $rowcount < $appointmentcount){
                    // echo 'record5 ta adui PerVehicles';
                    $sql2="INSERT INTO appointmenthandling(TimeSlotId, AppDate) VALUES ('$AppointmentTime','$AppDate')";
                    $result2=$db->query($sql2);
                    $timeslotid=$db->insert_id;
                  
                }else{
                    echo 'record5 ta wadi';
                    $messages['error_Appointment_TimeSlot']="The TimeSlot Already Exists!";
                }
            }
            if(empty($messages)){
                $db=dbconn();
                $AddDate=date('Y-m-d');
                $timestamp = strtotime($AddDate);
                $currentdatenumber = date('Ymd', $timestamp);
                $rand=rand();
                $AppointmentNo = $currentdatenumber.$rand;
                $CustomerId =$_SESSION['userId'];
                 $sql="INSERT INTO appointments(AppointmentNo,CustomerId,VehicleNo,AppDate,TimeSlotStart,ServiceType,AddUser,AddDate) VALUES ('$AppointmentNo','$CustomerId','$VehicleNo', '$AppDate', '$AppointmentTime', '$ServiceType','1','$AddDate')";
                $db->query($sql);
                $AppointmentId=$db->insert_id;
                $sql3="UPDATE appointmenthandling SET AppointmentId='$AppointmentId' WHERE AppHandling='$timeslotid' ";
                $db->query($sql3);
                }
         }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF'];?>">
            <div class="card-body">
                <div class="text-danger"><?= @$messages['error_Appointment_TimeSlot']; ?></div>
                <div class="mb-3">
                    <label for="VehicleNo" class="form-label">Vehicle No</label>
                    <input type="text" class="form-control" id="VehicleNo" name="VehicleNo"
                        placeholder="Enter Vehicle No ">
                    <div class="text-danger"><?= @$messages['error_Vehicle_No']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="AppDate" class="form-label">Appointment Date</label>
                    <input type="date" class="form-control" id="AppDate" name="AppDate"
                        placeholder="Enter Appointment Date" min="<?php echo date('Y-m-d'); ?>"
                        max='<?php echo date("Y-m-d", strtotime("+4 days")); ?>'>
                    <div class="text-danger"><?= @$messages['error_Appointment_Date']; ?></div>
                </div>
                <?php
                $db=dbconn();
                $sql="SELECT TimeSlotStart,TimeSlotEnd,TimeSlotId,PerVehicles FROM timeslots";
                $result=$db->query($sql);
                ?>
                <div class="mb-3">
                    <label for="AppointmentTime" class="form-label">Appointment Time</label>
                    <select class="form-select" aria-label="Default select example" name="AppointmentTime">
                        <option value="NotimeSlot">--</option>
                        <?php
                        if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?=$row['TimeSlotId']?>" <?php if(@$AppointmenTime == $row['TimeSlotStart']){
                            echo "selected";
                        }?>><?=$row['TimeSlotStart']?> - <?=$row['TimeSlotEnd']?> </option>
                        <?php
                        }
                    }
                        ?>
                        <div class="text-danger"><?= @$messages['error_Appointment_Time']; ?></div>
                    </select>
                </div>
                <?php
                $db=dbconn();
                $sql="SELECT ServiceName FROM service";
                $result=$db->query($sql);
                ?>
                <div class="mb-3">
                    <label for="ServiceType" class="form-label">Service Type</label>
                    <select class="form-select" aria-label="Default select example" name="ServiceType">
                        <option value="NoService">--</option>
                        <?php
                        if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?=$row['ServiceName']?>" <?php if(@$ServiceType == $row['ServiceName']){
                            echo "selected";
                        }?>><?=$row['ServiceName']?></option>
                        <?php
                        }
                    }
                        ?>
                        <div class="text-danger"><?= @$messages['error_Service_Type']; ?></div>
                    </select>
                </div>
                <!-- <div class="mb-3">
                    <label for="ServiceType" class="form-label">Service Type</label>
                    <select class="form-select form-control" id="ServiceType" name="ServiceType"
                        aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">Full Service</option>
                        <option value="2">Under Wash</option>
                        <option value="3">Body Wash</option>
                        <option value="4">Interior Clean</option>
                    </select>
                </div> -->

                <!-- <input type="select" class="form-control" id="Catergories" name="Catergories"
                        placeholder="Select Catergories"> -->
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    </div>
    </div>
    </form>
    </div>
    </div>
</main>
<?php include'../footer.php'; ?>
<!--session_start();-->
<?php include'../header.php'; ?>



<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "appointment") {
    extract($_POST);
    $AppDatez = date('D', strtotime($AppDate));

    echo $AppDatez . "meka line 12";
    echo '<br>';
//    echo $TimeSlotId;
    echo '<br>';
    $sql0 = "SELECT id,dayName FROM days WHERE dayName='$AppDatez'";
    $db = dbconn();
    $resultsq = $db->query($sql0);
    $row0 = $resultsq->fetch_assoc();
    echo '<br>';

    echo $day_id = $row0['id'];

    ECHO $sql1 = "SELECT * FROM timeslots WHERE day_Id='$day_id' ";
    $db = dbconn();
    $resultsz = $db->query($sql1);
    $row1 = $resultsz->fetch_assoc();
    if ($resultsz->num_rows != null) {
        while ($row = $resultsz->fetch_assoc()) {

            echo $Newsession = $row1['TimeSlotId'];
            echo $sql85 = "SELECT * FROM appointmenthandling WHERE TimeSlotId='$Newsession' AND AppDate='$AppDate'";

            $resultszzz = $db->query($sql85);
            if ($resultszzz->num_rows == null) {
                echo '<br>';
                echo "aaaaaaaaaa";
                echo '<br>';
            } else {
                echo '<br>';
                echo "xxxxxxx";
                echo '<br>';
            }
            $rowaaa = $resultszzz->fetch_assoc();

            echo '<br>';
            echo $row['TimeSlotId'] . " " . "session id";
            echo '<br>';
            echo $vehiclez = $row['PerVehicles'] . "vehicles";
            echo '<br>';
            echo $vehicle = $row['PerVehicles'];
            echo '<br>';
            $Newsession = $row['TimeSlotId'];
            echo '<br>';

            echo '<br>';
            echo $rowaaa['Count'];
            echo '<br>';

            echo $aaaa = $rowaaa['Count'];
            echo '<br>';
//            if ($aaaa == 0) {
//                echo '<br>';
//                echo 'aaa';
//                echo '<br>';
//            } else {
//                echo '<br>';
//                echo 'anc';
//                echo '<br>';
//            }

            echo "Available slots Counts : " . " " . $availablecount = $vehicle - $aaaa;

//            if($resultszzz->num_rows == null){
//                echo 'pervehicle default value';
//            }elseif($resultszzz->num_rows>null){
//                echo $resultszzz->num_rows;
//            }
//             $rowxxx=$resultszzz->fetch_assoc();
//                        echo $rowxxx['Count'];
//                        print_r($rowxxx)      ;      
        }
    }
//    die();
    echo $maxvehicale = $row1['PerVehicles'];
    echo '<br>';
// 
//    
    $sql2 = "SELECT * FROM appointmenthandling WHERE AppDate='$AppDate' AND TimeSlotId='$Newsession' ";
    $db = dbconn();
    $results = $db->query($sql2);
    $results->fetch_assoc();
    if ($results->num_rows == null) {
        $count = 0;
        echo'records 0';
    } else if ($results->num_rows <= $maxvehicale) {
        $count = $results->num_rows;
        echo '<br>';
        echo '0ta wadi 5ta adui';
    } else {
        echo '<br>';
        echo 'booked';
    }



//
//    $sql = "SELECT SUM(PerVehicles)FROM timeslots;";
//    $db = dbconn();
//    $results = $db->query($sql);
//    $row = $results->fetch_assoc();
//    echo $sumofpervehicle = $row['SUM(PerVehicles)'];
//
//    $shouldavailableslots = $sumofpervehicle * $days;
//
//    echo $sql2 = "SELECT * FROM appointmenthandling WHERE AppDate BETWEEN '$AppDateStart' AND '$AppDate' ";
//    $results2 = $db->query($sql2);
//
//    print_r($row);
//    
//    
//    $sql4="SELECT * FROM appointmenthandling,timeslots ORDER BY appointmenthandling.AppDate ASC";
//     $results4 = $db->query($sql4);
//    
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Appointments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addAppointment.php" class="btn btn-sm btn-outline-secondary">Add Appointments</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <h2>Appointments</h2>'
    <div class="table-responsive" style="background-color: white;">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col"> Looking Date </th>
                    <th scope="col"> Looking Time name</th>
                    <th scope="col">Looking Time time </th>
                    <th scope="col">Booked count </th>
                    <th scope="col">Available count</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">should be appointment </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <?= $AppDate ?></td>

                    <td><?php
                        $sql3 = "SELECT * FROM timeslots WHERE TimeSlotId='$Newsession' ";
                        $db = dbconn();
                        $results3 = $db->query($sql3);
                        $row3 = $results3->fetch_assoc();
                        echo $maxvehicale3 = $row3['TimeSlotName']
                        ?> </td>

                    <td><?php
                        $sql4 = "SELECT * FROM timeslots WHERE TimeSlotId='$Newsession' ";
                        $db = dbconn();
                        $results4 = $db->query($sql4);
                        $row4 = $results4->fetch_assoc();
                        echo $maxvehicale4 = $row4['TimeSlotStart'] . "--" . $row4['TimeSlotEnd']
                        ?> </td>

                    <td>

                        <?= $count ?>
                    </td>
                    <td>
                        <?php echo $availablecount = $maxvehicale - $count ?> 
                    </td>

                    <td>
                        <?php if ($availablecount >= $maxvehicale) { ?>

                            <button class="btn btn-lg btn-primary"> Book Now</button><?php
                        } else {
                            ?>
                            <button class="btn btn-secondary btn-lg" disabled> Book Now</button><?php
                        }
//                           
                        ?>
                    </td>
                </tr>



            </tbody>
        </table>
    </div>

    <!--    <h2>Booked Appointments </h2>'
        <div class="table-responsive" style="background-color: white;">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Appointment handling</th>
                        <th scope="col">TimeSlotId</th>
                        <th scope="col">AppointmentId</th>
                        <th scope="col">AppDate</th>
    
                    </tr>
                </thead>
                <tbody>
    
    
                    </tr>
                </tbody>
            </table>
        </div>-->

    <!--
        <h2>Appointments couting</h2>'
        <div class="table-responsive" style="background-color: white;">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Slotid</th>
                        <th scope="col">bookedcount</th>
                        <th scope="col">availablecount</th>
                        <th scope="col">Date</th>
    
                    </tr>
                </thead>
                <tbody>
    
    
                    </tr>
                </tbody>
            </table>
        </div>-->


</main>

<?php include'../footer.php'; ?>
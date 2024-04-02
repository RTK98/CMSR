
<?php
ob_start();
date_default_timezone_set("Asia/Colombo");
include'../header.php';
?>
<?php
$dates = $_GET['date'];
$datecheck = $_GET['date'];

extract($_POST);
$newDate = date('N', strtotime($dates));

$sql = "SELECT * FROM timeslots WHERE day_Id='$newDate' AND TimeSlotStatus='1' ";
$db = dbconn();
$result = $db->query($sql);

if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == "appointment") {
    extract($_POST);

    echo $AppDate;
    echo '<br>';
    echo $TimeSlotId;
    echo '<br>';
    $sql1 = "SELECT * FROM timeslots WHERE TimeSlotId='$TimeSlotId' AND TimeSlotStatus='1' ";
    $db = dbconn();
    $resultsz = $db->query($sql1);
    $row1 = $resultsz->fetch_assoc();
    echo $maxvehicale = $row1['PerVehicles'];
    echo '<br>';

    $sql2 = "SELECT * FROM appointmenthandling WHERE AppDate='$AppDate' AND TimeSlotId='$TimeSlotId' ";
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
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 view-appointment-card">
    <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Go Back</button>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Search Appointments </h1>
    </div>
    <div>
        <h5><strong><?= $dates ?> </strong></h5>
        <h5><strong> The time is <?= date("H:iA"); ?></h5></strong> 
    </div>
    <div class="table-responsive" style="background-color: white;">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">TIme Slot Name</th>
                    <th scope="col">Starting Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Per Vehicles</th>
                    <th scope="col">Booked count </th>
                    <th scope="col">Available count</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $currenttotaltime = 0;
                    $selecteddateandtime = 0;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?= $row['TimeSlotName'] ?>
                            </td>



                            <td>
                                <?php echo $timestart = $row['TimeSlotStart'] ?> 
                            </td>
                            <td>
                                <?= $row['TimeSlotEnd'] ?> 
                            </td>
                            <td>
                                <?php echo $percount = $row['PerVehicles'] ?> 
                            </td>
                            <td>
                                <?php
                                $timeslotid = $row['TimeSlotId'];
                                $sql22 = "SELECT * FROM appointmenthandling WHERE TimeSlotId='$timeslotid' and AppDate='$dates' ";
                                $result22 = $db->query($sql22);
                                $row22 = $result22->fetch_assoc();

                                if ($result22->num_rows == null) {
                                    echo $bookedcount = 0;
                                } else {
                                    echo $bookedcount = $result22->num_rows;
                                }
                                ?> 
                            </td>
                            <td>
                                <?php
                                echo $availablecount = $percount - $bookedcount;
                                ?>
                            </td>

                            <td>
                                <form action="redirect.php" method="POST">

                                    <?php
                                    //timestart=Time Slot starting Time
                                    $timestamp = strtotime($timestart);

                                    $selecteddate = strtotime($datecheck);
                                    $selecteddateandtime = $timestamp + $selecteddate;

                                    $currentdatez = date('Y-m-d');

                                    $currentdatez = strtotime($currentdatez);

                                    $currenttime = time();
                                    $selecteddateandtime;
                                    $currenttotaltime = $currentdatez + $currenttime;
                                    if ($currenttotaltime > $selecteddateandtime) {
                                        $disa = "disabled";
                                    } else {
                                        $disa = "";
                                    }
                                    ?>

                                    <?php if ($availablecount > 0) { ?> 

                                        <button type="submit" class="btn btn-primary" <?= @$disa ?> name="action" value="redirectz"> Book Now</button>
                                        <input type="hidden" name="slotnameid" value="<?= $timeslotid ?>">
                                        <input type="hidden" name="requestdate" value="<?= $dates ?>">
                                    <?php } else {
                                        ?>
                                        <button  type="" class="btn btn-light"disabled> Book Now</button><?php
                                    }
                                    ?>
                                </form>
                            </td>

                        </tr>
                        <?php
                    }$currenttotaltime = 0;
                    $selecteddateandtime = 0;
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include'../footer.php'; ?>
<?php
include'../header.php';
include'../menu.php';
?>
<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'viewAppointment') {

    $db = dbconn();
    $customerId = $_SESSION['CustomerID'];
    $VehicleId;
    $sql = "SELECT * FROM appointments WHERE CustomerID='$customerId' AND VehicleNo='$VehicleId' ";
    $db = dbconn();
    $result = $db->query($sql);
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="
      background-color: white;
         position: relative;
         z-index: 1;
         ">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
         >
        <h1 class="h2">My Appointments </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Go Back</button>
            </div>
        </div>
    </div>
    <div>
    </div>
    <div class="table-responsive" style="background-color: white;">
        <table class="table table-striped table-bordered table-sm table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Appointment No.</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Vehicle Number</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Appointment Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
//                        
                        ?>
                        <tr>
                            <td>
                                <?= $n ?>
                            </td>
                            <td>
                                <?= $row['AppointmentNo'] ?> 
                            </td>
                            <td>
                                <?= $row['AppDate'] ?> 
                            </td>
                            <td>
                                <?php
                                $vehicle = $row['VehicleNo'];
                                $sqlVehicle = "SELECT * FROM customervehicles WHERE vehicleId='$vehicle'";
                                $resultVehicle = $db->query($sqlVehicle);
                                $rowVehicle = $resultVehicle->fetch_assoc();
                                ?>
                                <?= $rowVehicle['registerLetter'] . "-" . $rowVehicle['RegistrationNo']; ?>
                            </td>
                            <td>
                                <?= $row['ServiceType'] ?> 
                            </td>
                            <td>
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
                                        $statusDescription = "Cancelled";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "btn btn-secondary btn-sm";
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary">View Bill</button>
                                <button type="button" class="btn btn-warning">Add Complaint</button>

                            </td>
                        </tr>
                        <?php
                        $n++;
                    }
                } else {
                    // Display "No results found" message
                    ?>
                    <tr>
                        <td  colspan="7"><p style='text-align: center; font-weight: bold;'>No results found.</p></td>
                    </tr>
                    <?php
                }
                ?>
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include'../footer.php'; ?>
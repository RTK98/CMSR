<?php include'../header.php'; ?>
<?php
extract($_POST);
$customerId = $_SESSION['CustomerID'];
$sql = "SELECT * FROM appointments WHERE CustomerID='$customerId'";
$db = dbconn();
$result = $db->query($sql);
$row = $result->fetch_assoc();
//var_dump($row);
//die();
//echo $sql = "SELECT * FROM appointments WHERE CustomerID='$customerId'(SELECT  appointments.VehicleNo, customervehicles.CustomerID, customervehicles.RegistrationNo 
//FROM appointments
//LEFT JOIN customervehicles
//ON appointments.VehicleNo = customervehicles.CustomerID WHERE customervehicles.CustomerID= $customerId)";
//$sql = "SELECT * FROM(SELECT * FROM appointments) a LEFT JOIN ( SELECT vehicleId, CustomerID, RegistrationNo FROM customervehicles WHERE CustomerID='$customerId') b ON a.CustomerID = b.vehicleId";
//$sql = "SELECT  * FROM appointments o LEFT JOIN customervehicles p ON p.VehicleId=o.VehicleNo";

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Go Back</button>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Appointments </h1>
    </div>
    <div>

    </div>
    <div class="table-responsive" style="background-color: white;">
        <table class="table table-striped table-sm">
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
//                if ($result->num_rows > 0) {
//                    $n = 1;
//                    while ($row = $result->fetch_assoc()) {
//                        ?>
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
//                                $sql = "SELECT  * FROM customervehicles";

//                                $db = dbconn();
//                                $result = $db->query($sql);
//                                $row['registerLetter'] . "-" . $row['RegistrationNo'];
                                ?>
                            </td>
                            <td>
        <?= $row['ServiceType'] ?> 
                            </td>
                            <td>
        <?= $row['appointmentStatus'] ?> 
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary">View Bill</button>
                                <button type="button" class="btn btn-warning">Add Complaint</button>

                            </td>
                        </tr>
                        <?php
//                        $n++;
//                    }
//                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include'../footer.php'; ?>
<?php include'../header.php'; ?>
<?php
$cusid = $_SESSION['CustomerID'];
$db = dbConn();
echo $sql = "SELECT * FROM appointments WHERE CustomerID='$cusid'";
$resultshistory = $db->query($sql);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Go Back</button>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Appointments </h1>
    </div>
    <div>

    </div>

    <table class="table table-bordered  table-hover">
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
if ($resultshistory->num_rows > 0) {
    while ($row = $resultshistory->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <?= $row['AppointmentNo'] ?>
                </td>
                <td>
                    <?php  $vehicle=$row['VehicleNo'];
                    $sqlvehicle="SELECT * FROM customervehicles WHERE vehicleId='$vehicle'";
                    $resultvehicle=$db->query($sqlvehicle);
                    $rowvehicle= $resultvehicle->fetch_assoc();
                    echo $rowvehicle['RegistrationNo'];
                    ?>
                </td>
                <td>

                </td>
                <td>

                </td>

            </tr>
<?php }}?>
        </tbody>
    </table>

</main>

<?php include'../footer.php'; ?>
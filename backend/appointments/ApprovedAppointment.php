<?php $appointment = "active" ?> 
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Appointments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewAppointment.php" class="btn btn-sm btn-outline-secondary">View All Appointments</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <h2> Today Appointments</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sqlApproved = "SELECT * FROM appointments WHERE appointmentStatus='2'";
        $resultApproved = $db->query($sqlApproved);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Appoinment No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Vehicle No</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Time Slot</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultApproved->num_rows > 0) {
                    $n = 1;
                    while ($row = $resultApproved->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $row['AppointmentNo'] ?></td>
                            <td><?= $row['CustomerID'] ?></td>
                            <td>
                                <?php
                                $vehicle = $row['VehicleNo'];
                                $sqlVehicle = "SELECT * FROM customervehicles WHERE vehicleId='$vehicle'";
                                $resultVehicle = $db->query($sqlVehicle);
                                $rowVehicle = $resultVehicle->fetch_assoc();
                                ?>
                                <?= $rowVehicle['registerLetter'] . "-" . $rowVehicle['RegistrationNo']; ?>
                            </td>
                            <td><?= $row['AppDate'] ?></td>
                            <td><?= $row['TimeSlotStart'] ?></td>
                            <td><?= $row['ServiceType'] ?></td>
                            <td>
                                <form method='post' action="../jobCard/addJobCard.php">
                                    <input type="text" name="TimeSlotStart" value="<?= $row['TimeSlotStart'] ?>">
                                    <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                    <button type="submit" class="btn btn-success" name="action" value="edit">Create Job Card</button>
                                </form>

                            </td>
                            <td>
                                <form method='post' action="delete.php">
                                    <input type="hidden" name="AppointmentId" value="<?= $row['AppointmentId'] ?>">
                                    <button type="submit" class="btn btn-danger" name="action" value="delete">Cancel</button>
                                </form>

                            </td>
                        </tr>
                        <?php
                        $n++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php include'../footer.php'; ?>
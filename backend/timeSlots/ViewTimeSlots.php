<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Time Slots</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addTimeSlot.php" class="btn btn-sm btn-dark">Add New Time Slot</a>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'update') {
        echo $TimeSlotId;
        $db = dbConn();
        $sqlDeactiveItems = "UPDATE timeslots SET ProductStatus='0' WHERE TimeSlotStatus='$TimeSlotId'";
        $db->query($sqlDeactiveItems);
        ?>
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Time slot has been Deactive Successfully',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
            }).then(() => {
                window.location.href = 'ViewTimeSlots.php'; // Redirect to success page
            });
        </script><?php
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'active') {
        echo $TimeSlotId;
        $db = dbConn();
        $sqlActiveItems = "UPDATE timeslots SET ProductStatus='1' WHERE TimeSlotStatus='$TimeSlotId'";
        $db->query($sqlActiveItems);
        ?>
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Timesot has been active Successfully',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
            }).then(() => {
                window.location.href = 'ViewTimeSlots.php'; // Redirect to success page
            });
        </script><?php
    }
    ?>
    <h2>Time Slot</h2>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT * FROM timeslots";
        $result = $db->query($sql); // Run Query
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Time Slot Name</th>
                    <th scope="col">Starting Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Per Vehicles</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $row['TimeSlotName'] ?></td>
                            <td><?= $row['TimeSlotStart'] ?></td>
                            <td><?= $row['TimeSlotEnd'] ?></td>
                            <td><?= $row['PerVehicles'] ?></td>
                            <td><?php
                                $TimeSlotStatus = $row['TimeSlotStatus'];
                                $statusDescription = '';

                                switch ($TimeSlotStatus) {
                                    case 1:
                                        $statusDescription = "Active";
                                        $statusColor = "badge bg-success btn-sm";
                                        $showEdit = true;
                                        $showDelete = true;
                                        $showActive = false;
                                        break;
                                    case 0:
                                        $statusDescription = "Deactive";
                                        $statusColor = "badge bg-danger btn-sm";
                                        $showEdit = false;
                                        $showDelete = false;
                                        $showActive = true;
                                        break;
                                    case 2:
                                        $statusDescription = "Not Available";
                                        $statusColor = "badge bg-danger btn-sm";
                                        $showEdit = false;
                                        $showDelete = true;
                                        $showActive = false;
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <?php if ($showEdit) { ?>
                                <td>
                                    <form method='post' action="editTimeSlot.php">
                                        <input type="hidden" name="TimeSlotId" value="<?= $row['TimeSlotId'] ?>">
                                        <button type="submit" name="action" class='btn btn-sm btn-primary' value="edit">Edit</button>
                                    </form>
                                </td>
                            <?php } ?>
                            <?php if ($showDelete) { ?>
                                <td>
                                    <form method='post' action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                        <input type="hidden" name="TimeSlotId" value="<?= $row['TimeSlotId'] ?>">
                                        <button type="submit" name="action" value="update" class='btn btn-sm btn-danger' onclick="return confirm('Are you sure you want to deactive this item?')">Deactive</button>
                                    </form>
                                </td>
                            <?php } ?>
                            <?php if ($showActive) { ?>
                                <td>
                                    <form method='post' action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                        <input type="hidden" name="TimeSlotId" value="<?= $row['TimeSlotId'] ?>">
                                        <button type="submit" name="action" value="active" class='btn btn-sm btn-success' onclick="return confirm('Are you sure you want to sctive this item?')">Active</button>
                                    </form>
                                </td>
                            <?php } ?>
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
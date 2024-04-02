<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="addRepaircatergory.php" class="btn btn-sm btn-dark">Add New Repair</a>
        </div>
    </div>
    <h2>Repair List</h2>
    <?php
    $db = dbconn();
    $sql = "SELECT rc.RepairId,"
            . "rc.RepairName,"
            . "rc.RepairPrice,"
            . "rc.RepairCost,"
            . "rc.RepairStatus,"
            . "wt.WarrentyName "
            . "FROM repaircatergory rc "
            . "LEFT JOIN warranty wt ON rc.WarrantyType=wt.WarrentyId";
    $result = $db->query($sql); // Run Query
    ?>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Repair Name</th>
                    <th scope="col">Repair Cost</th>
                    <th scope="col">Repair Price</th>
<!--                    <th scope="col">Repair Warranty</th> -->
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
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
                            <td><?= ucwords($row['RepairName']) ?></td>
                            <td><?= $row['RepairCost'] ?></td>
                            <td><?= $row['RepairPrice'] ?></td>
<!--                            <td><?= $row['WarrentyName'] ?></td>-->
                            <td> <?php
                                $RepairStatus = $row['RepairStatus'];
                                $statusDescription = '';

                                switch ($RepairStatus) {
                                    case 1:
                                        $statusDescription = "Active";
                                        $statusColor = "badge bg-success btn-sm";
                                        break;
                                    case 0:
                                        $statusDescription = "Deactive";
                                        $statusColor = "badge bg-danger btn-sm";
                                        break;
                                }
                                ?>
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <td>
                                <form method='post' action="editRepaircatergory.php">
                                    <input type="hidden" name="RepairId" value='<?= $row['RepairId'] ?>'>
                                    <button type="submit" name="action" value="edit" class="btn btn-warning btn-sm">Edit</button>
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
<?php include'../../footer.php'; ?>
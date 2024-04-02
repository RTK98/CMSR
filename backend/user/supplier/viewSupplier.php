<?php $supplier = "active" ?>
<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Supplier</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>user/supplier/addSupplier.php" class="btn btn-sm btn-dark">Add Supplier</a>
            </div>
        </div>
    </div>
    <h2>Supplier List</h2>
    <section>
        <div class="row">
            <div class="row">
                <div class="col-md-4">
                    <?php
                    $db = dbconn();
                    $sqlAllSup = "SELECT * FROM supplier";
                    $resultAllSup = $db->query($sqlAllSup);
                    if ($resultAllSup->num_rows > 0) {
                        $AllSupCount = $resultAllSup->num_rows;
                    } else {
                        $AllSupCount = 0;
                    }
                    ?>
                    <a href="<?= SYSTEM_PATH ?>reports/admin/AllSuppliers.php" style="display: none;" id="hidden-link"></a>
                    <div class="card text-white mb-3" style="max-width: 18rem; background-color: #13656e;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/AllSuppliers.php';">
                        <div class="card-body">
                            <h5 class="card-title">All Suppliers</h5>
                            <h1><?= $AllSupCount ?></h1>
                            <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/truck.png">
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <?php
                    $db = dbconn();
                    $sqlSupActive = "SELECT * FROM supplier WHERE Status='1'";
                    $resultSupActive = $db->query($sqlSupActive);
                    if ($resultSupActive->num_rows > 0) {
                        $SupActiveCount = $resultSupActive->num_rows;
                    } else {
                        $SupActiveCount = 0;
                    }
                    ?>
                    <a href="<?= SYSTEM_PATH ?>reports/admin/ActiveSuppliers.php" style="display: none;" id="hidden-link"></a>
                    <div class="card text-white mb-3" style="max-width: 18rem; background-color: #13656e;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/ActiveSuppliers.php';">
                        <div class="card-body">
                            <h5 class="card-title">Active Suppliers</h5>
                            <h2><?= $SupActiveCount ?></h2>
                            <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/truck.png">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    $db = dbconn();
                    $sqlSupDeactive = "SELECT * FROM supplier WHERE Status='0'";
                    $resultSupDeactive = $db->query($sqlSupDeactive);
                    if ($resultSupDeactive->num_rows > 0) {
                        $SupDeactiveCount = $resultSupDeactive->num_rows;
                    } else {
                        $SupDeactiveCount = 0;
                    }
                    ?>
                    <a href="<?= SYSTEM_PATH ?>reports/admin/NonActiveSuppliers.php" style="display: none;" id="hidden-link"></a>
                    <div class="card text-white mb-3" style="max-width: 18rem; background-color: #13656e;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/NonActiveSuppliers.php';">
                        <div class="card-body">
                            <h5 class="card-title">Non Activated Suppliers</h5>
                            <h1><?= $SupDeactiveCount ?></h1>
                            <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/truck.png">
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'delete') {
        $supplierId;
        $db = dbConn();
        $sql = "UPDATE supplier SET Status='0' WHERE SupplierId='$supplierId' ";
        $db->query($sql);
    }
    ?>
    <?php
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'active') {
        $supplierId;
        $db = dbConn();
        $sql = "UPDATE supplier SET Status='1' WHERE SupplierId='$supplierId' ";
        $db->query($sql);
    }
    ?>

    <?php
    $db = dbconn();
    $sql = "SELECT * FROM supplier";
    $result = $db->query($sql);
    ?>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Registered Date</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Email</th>
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
                            <td><?php
                                $SupplierName = $row['SupplierName'];
                                echo ucwords($SupplierName);
                                ?></td>
                            <td><?= $row['AddDate'] ?></td>
                            <td><?= $row['ContactNo'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?php
                                $SupplierStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($SupplierStatus) {
                                    case 1:
                                        $statusDescription = "Active";
                                        $statusColor = "badge bg-success";
                                        break;
                                    case 0:
                                        $statusDescription = "Deactive";
                                        $statusColor = "badge bg-danger";
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "badge bg-secondary";
                                        break;
                                }
                                ?>
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>

                            <td>
                                <?php
                                if ($SupplierStatus == 0) {
                                    ?>
                                    <form method='post' action="<?= $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="supplierId" value="<?= $row['SupplierId'] ?>">
                                        <button type="submit" name="action" value="active" class="btn btn-success" onclick="return confirm('Do you really want to Active supplier?')">Active</button>
                                    </form>
                                <?php } else {
                                    ?>
                                    <form method = 'post' action = "<?= $_SERVER['PHP_SELF']; ?>">
                                        <input type = "hidden" name = "supplierId" value = "<?= $row['SupplierId'] ?>">
                                        <button type = "submit" name = "action" value = "delete" class = "btn btn-danger" onclick = "return confirm('Do you really want to deactive supplier?')">Delete</button>
                                    </form>
                                    <?php
                                }
                                ?>
                            </td>

                            <td>
                                <form method='post' action="viewSupplierDetails.php">
                                    <input type="hidden" name="supplierId" value="<?= $row['SupplierId'] ?>">
                                    <button type="submit" name="action" value="view" class="btn btn-primary">View</button>
                                </form>
                            </td>
                            <td>
                                <form method='post' action="editSupplier.php">
                                    <input type="hidden" name="supplierId" value="<?= $supplierId = $row['SupplierId'] ?>">
                                    <button type="submit" name="action" value="edit" class=" btn btn-warning">Edit</button>
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
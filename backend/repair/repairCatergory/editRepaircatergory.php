<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Repair catergory</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <!-- <a href="add.php" class="btn btn-sm btn-outline-secondary">Add New Product</a> -->
                <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
            </div>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button> -->
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                 style="
                 display: block;
                 margin-left: auto;
                 margin-right: auto;
                 ">
            <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
            <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
            <p class='m-1' style="text-align: center;">0779 200 480</p>

        </div>
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && ($action == 'edit' || $action == 'save')) {
            $RepairId;
            $db = dbconn();
            $sql = "SELECT rc.RepairId,"
                    . "rc.RepairName,"
                    . "rc.RepairPrice,"
                    . "rc.RepairCost,"
                    . "rc.RepairStatus,"
                    . "wt.WarrentyName,"
                    . "wt.WarrentyId "
                    . "FROM repaircatergory rc "
                    . "LEFT JOIN warranty wt ON rc.WarrantyType=wt.WarrentyId WHERE rc.RepairId='$RepairId' ";
            $result = $db->query($sql); // Run Query
            $row = $result->fetch_assoc();
            $RepairName = ucwords($row['RepairName']);
            $RepairPrice = $row['RepairPrice'];
            $RepairCost = $row['RepairCost'];
            $RepairStatus = $row['RepairStatus'];
            $WarrantyType = $row['WarrentyId'];
        }
        ?>
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && ($action == 'save')) {

            $RepairName = strtolower(inputTrim($RepairName));
            $messages = array();
            if (empty($RepairPrice)) {
                $messages['error_Repair_Price'] = "The Repair Cost should not be blank..!";
            }
            if (empty($RepairCost)) {
                $messages['error_Repair_Price'] = "The Repair Price should not be blank..!";
            }
            if ($RepairPrice <= $RepairCost) {
                $messages['error_Repair_Price'] = "The Repair Price Greater thand the Repair Cost..!";
            }
            if (!isset($WarrantyType)) {
                $messages['error_Repair_Type'] = "The Repair Warranty should not be blank..!";
            }
            if (!isset($RepairStatus)) {
                $messages['error_Repair_Status'] = "The Repair Warranty not be blank..!";
            }

            if (empty($messages)) {
                $RepairId;
                $db = dbconn();
                $AddDate = date('Y-m-d');
                echo $AddUser = $_SESSION['userId'];
                 $sql = "UPDATE repaircatergory SET RepairPrice='$RepairPrice',RepairCost='$RepairCost',"
                . "WarrantyType='$WarrantyType',RepairStatus='$RepairStatus',UpdateUser='$AddUser',UpdateDate='$AddDate' WHERE RepairId='$RepairId' ";
                $db->query($sql);
            }
            ?>
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Repair has been Update Successfully',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = 'viewRepairs.php'; // Redirect to success page
                });
        </script><?php
        }
        if (!empty($messages)) {
            ?>
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: 'Something went wrong!',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                }).then(() => {
                    //                    window.location.href = 'addRepaircatergory.php'; // Redirect to success page
                });
        </script><?php
        }
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                   <div>
                <h4 class='m-1'style="text-align: center; font-weight: bold;">Edit Repair</h4>
            </div>
                <div class="mb-3">
                    <label for="RepairName" class="form-label">Repair Name</label>
                    <input type="text" class="form-control" id="RepairName" name="RepairName"
                           placeholder="Enter Repair Name" value='<?= @$RepairName ?>' readonly>
                    <div class="text-danger"><?= @$messages['error_Repair_Price']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="RepairCost" class="form-label">Repair Cost (Rs.)</label>
                    <input type="number" class="form-control" id="RepairCost" name="RepairCost"
                           min='0' value='<?= @$RepairCost ?>'>
                    <div class="text-danger"><?= @$messages['error_Repair_Price']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="RepairPrice" class="form-label">Repair Price (Rs.)</label>
                    <input type="number" class="form-control" id="RepairPrice" name="RepairPrice"
                           min='0' value='<?= @$RepairPrice ?>'>
                    <div class="text-danger"><?= @$messages['error_Repair_Price']; ?></div>
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT WarrentyId, WarrentyName FROM warranty";
                $result = $db->query($sql);
                ?>
                <div class="mb-3">
                    <lable for="WarrantyType" class="form-label">Warranty Type</lable>
                    <select class="form-select" aria-label="Default select example" name="WarrantyType">
                        <option value="NoWarranty">--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['WarrentyId'] ?>" <?php
                                if (@$WarrantyType == $row['WarrentyId']) {
                                    echo "selected";
                                }
                                ?>><?= $row['WarrentyName'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                    <div class="text-danger"><?= @$messages['error_Repair_Type']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="RepairStatus" class="form-label">Repair Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="RepairStatus" id="Yes" value="1" <?php
                        if (@$RepairStatus == '1') {
                            echo 'checked';
                        }
                        ?>>
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="RepairStatus" id="No" value="0" <?php
                        if (@$RepairStatus == '0') {
                            echo 'checked';
                        }
                        ?>>
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_Repair_Status']; ?></div>
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="RepairId" value='<?= $RepairId ?>'>
                <button type="submit" name="action" value="save" class="btn btn-primary btn-sm">Save</button>
            </div>
        </form>
    </div>
</main>
<?php include'../../footer.php'; ?>
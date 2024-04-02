<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Repair catergory</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewRepairs.php" class="btn btn-sm btn-dark">View Repair List</a> 
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
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $RepairName = strtolower(inputTrim($RepairName));
            $messages = array();
            if (empty($RepairName)) {
                $messages['error_Repair_Name'] = "The Repair Code should not be blank..!";
            }
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
            //advance validation
            if (!empty($RepairName)) {
                $db = dbconn();
                $sql = "SELECT * FROM repaircatergory WHERE RepairName='$RepairName'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Repair_Name'] = "The Repair Already Exists!";
                }
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                 $sql = "INSERT INTO repaircatergory(RepairName,RepairPrice,RepairCost,WarrantyType,RepairStatus,AddUser,AddDate) VALUES ('$RepairName', '$RepairPrice','$RepairCost', '$WarrantyType','$RepairStatus','1','$AddDate')";
                $db->query($sql);
            }
            ?>
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Repair has been Create Successfully',
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
                    animation: false, F
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
            <div>
                <h4 class='m-1'style="text-align: center; font-weight: bold;">Add Repair</h4>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label for="RepairName" class="form-label">Repair Name</label>
                    <input type="text" class="form-control" id="RepairName" name="RepairName"
                           placeholder="Enter Repair Name" value='<?= @$RepairName ?>'>
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
                        <input class="form-check-input" type="radio" name="RepairStatus" id="Yes" value="1">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="RepairStatus" id="No" value="0">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_Repair_Status']; ?></div>
                </div>
            </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
</div>
</div>
</main>
<?php include'../../footer.php'; ?>
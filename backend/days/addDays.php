<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Days</h1>
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
            New Product
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $DayName = inputTrim($DayName);
            $messages = array();
            if (empty($DayName)) {
                $messages['error_Day_name'] = "The Day Name should not be blank..!";
            }
            if (!isset($DayStatus)) {
                $messages['error_Day_Status'] = "The Day Status should not be blank..!";
            }

            //advance validation
            if (!empty($DayName)) {
                $db = dbconn();
                $sql = "SELECT * FROM days WHERE name='$DayName'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    $messages['error_TimeSlot_name'] = "The Day Already Exists!";
                }
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $sql = "INSERT INTO days(name,status) VALUES ('$DayName', '$DayStatus')";
                $db->query($sql);
            }
        }
        //min="08:00" max="12:00"
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <div class="card-body">
                <div class="mb-3">
                    <label for="DayName" class="form-label">Time Slot Name</label>
                    <input type="text" class="form-control" id="DayName" name="DayName"
                           placeholder="Enter Day Name">
                    <div class="text-danger"><?= @$messages['error_Day_name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="DayStatus" class="form-label">Day Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="DayStatus" id="Yes" value="1">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="DayStatus" id="No" value="0">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_Day_Status']; ?></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </div>
</div>


</form>
</div>
</div>
</main>
<?php include'../footer.php'; ?>
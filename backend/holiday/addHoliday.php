<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewHoliday.php" class="btn btn-sm btn-dark">View Holidays</a>
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
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $HolidayName = inputTrim($HolidayName);
            $messages = array();
            if (empty($HolidayName)) {
                $messages['error_Holiday_name'] = "The Holiday Name should not be blank..!";
            }
            if (!isset($HolidayDate)) {
                $messages['error_Holiday_date'] = "The Holiday Date should not be blank..!";
            }
            if (!isset($HolidayTime)) {
                $messages['error_Holiday_time'] = "The Holiday Time should not be blank..!";
            }
            if (!isset($HolidayStatus)) {
                $messages['error_Holiday_status'] = "The HolidayStatus Status should not be blank..!";
            }
            //advance validation
            if (!empty($HolidayDate)) {
                $db = dbconn();
                $sql = "SELECT * FROM holidays WHERE HolidayDate='$HolidayDate' AND HolidayStatus='1'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Holiday_date'] = "The Holiday Already Exists!";
                }
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $sql = "INSERT INTO holidays(HolidayName,HolidayDate,HolidayTime,HolidayStatus,AddUser,AddDate) VALUES ('$HolidayName', '$HolidayDate', '$HolidayTime', '$HolidayStatus','1','$AddDate')";
                $db->query($sql);
            }
            ?>
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Holiday has been Create Successfully',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = 'viewHoliday.php'; // Redirect to success page
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
            <div>
                <h4 class='m-1'style="text-align: center; font-weight: bold;">Add Holiday</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="HolidayName" class="form-label">Holiday Name</label>
                    <input type="text" class="form-control" id="HolidayName" name="HolidayName"
                           placeholder="Enter Holiday Name">
                    <div class="text-danger"><?= @$messages['error_Holiday_name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="HolidayDate" class="form-label">Holday Date</label>
                    <input type="date" class="form-control" id="HolidayDate" name="HolidayDate"
                           placeholder="Enter Holiday Time">
                    <div class="text-danger"><?= @$messages['error_Holiday_date']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="HolidayTime" class="form-label">Holiday Time</label>
                    <input type="time" class="form-control" id="HolidayTime" name="HolidayTime"
                           placeholder="Enter Holiday Time" min="08:00" max="12:00">
                    <div class="text-danger"><?= @$messages['error_Holiday_time']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="HolidayStatus" class="form-label">Holiday Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="HolidayStatus" id="Yes" value="1">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="HolidayStatus" id="No" value="0">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_Holiday_status']; ?></div>
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
<?php include'../footer.php'; ?>
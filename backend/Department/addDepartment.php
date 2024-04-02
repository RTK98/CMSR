<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Repair catergory</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewDepartment.php" class="btn btn-sm btn-dark">View Departments</a>
            </div>
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

            $DepartmentName = inputTrim($DepartmentName);
            $messages = array();
            if (empty($DepartmentName)) {
                $messages['error_Department_Name'] = "The Department Name should not be blank..!";
            }
            if (!isset($DeptStatus)) {
                $messages['error_Department_Status'] = "The Repair Warranty not be blank..!";
            }
            //advance validation
            if (!empty($DepartmentName)) {
                $db = dbconn();
                $sql = "SELECT * FROM department WHERE DepartmentName='$DepartmentName'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Department_Name'] = "The Department Already Exists!";
                }
            }
            if (empty($messages)) {
                $UserId = $_SESSION['userId'];
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $sql = "INSERT INTO department(DepartmentName,Status,AddUser,AddDate) VALUES ('$DepartmentName', '$DeptStatus' ,'$UserId','$AddDate')";
                $db->query($sql);
            }
            ?>

            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Department has been Create Successfully',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = 'viewDepartment.php'; // Redirect to success page
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
                }).then(() => {
                    window.location.href = 'addDepartment.php'; // Redirect to success page
                });
        </script><?php
        }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <h4 class='m-1'style="text-align: center; font-weight: bold;">Add Department</h4>
            <div class="card-body">
                <div class="mb-3">
                    <label for="DepartmentName" class="form-label">Department Name</label>
                    <input type="text" class="form-control" id="DepartmentName" name="DepartmentName"
                           placeholder="Enter Department Name">
                    <div class="text-danger"><?= @$messages['error_Department_Name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="CatergoryStatus" class="form-label">Department Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="DeptStatus" id="Yes" value="1">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="DeptStatus" id="No" value="0">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_DeptStatus_Status']; ?></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </div>
    </div>
</div>


</form>
</div>
</div>
</main>
<?php include'../footer.php'; ?>
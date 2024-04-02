<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $_SESSION["FirstName"] ?>'s Dashboard </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>user/employee/viewEmp.php" class="btn btn-sm btn-dark">Employee Management</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>user/supplier/viewSupplier.php" class="btn btn-sm btn-dark">Supplier Management</a>
            </div>
        </div>
    </div>
    <h2>Section title</h2> 
    <section>
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
    <section>
        <div class="row">
            <div class="col-md-4">
                <?php
                $db = dbconn();
                $sqlUsers = "SELECT * FROM users WHERE UserRole<>'admin'";
                $resultUsers = $db->query($sqlUsers);
                if ($resultUsers->num_rows > 0) {
                    $UserCount = $resultUsers->num_rows;
                } else {
                    $UserCount = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>reports/admin/Employees.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white mb-3" style="max-width: 18rem; background-color: #0c3c0b;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/Employees.php';">
                    <div class="card-body">
                        <h5 class="card-title">Employees</h5>
                        <h2><?= $UserCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/staff.png">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $db = dbconn();
                $sqlActiveUsers = "SELECT * FROM users WHERE UserRole<>'admin' AND Status='1'";
                $resultActiveUsers = $db->query($sqlActiveUsers);
                if ($resultActiveUsers->num_rows > 0) {
                    $ActiveUser = $resultActiveUsers->num_rows;
                } else {
                    $ActiveUser = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>reports/admin/ActiveEmployees.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white mb-3" style="max-width: 18rem; background-color: #0c3c0b;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/ActiveEmployees.php';">
                    <div class="card-body">
                        <h5 class="card-title">Activated Employees</h5>
                        <h1><?= $ActiveUser ?></h1>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/staff.png">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $db = dbconn();
                $sqlNonActive = "SELECT * FROM users WHERE UserRole<>'admin' AND Status='0'";
                $resultNonActive = $db->query($sqlNonActive);
                if ($resultNonActive->num_rows > 0) {
                    $NonActiveUserCount = $resultNonActive->num_rows;
                } else {
                    $NonActiveUserCount = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>reports/admin/NonActiveEmployees.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white mb-3" style="max-width: 18rem; background-color: #0c3c0b;"  onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/NonActiveEmployees.php';">
                    <div class="card-body">
                        <h5 class="card-title">Non Activated Employees</h5>
                        <h1><?= $NonActiveUserCount ?></h1>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/staff.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-4">
                <?php
                $db = dbconn();
                $sqlDept = "SELECT * FROM department;";
                $resultDept = $db->query($sqlDept);
                if ($resultDept->num_rows > 0) {
                    $DeptCount = $resultDept->num_rows;
                } else {
                    $DeptCount = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>reports/admin/Department.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white mb-3" style="max-width: 18rem; background-color: #3c003d;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/Department.php';">
                    <div class="card-body">
                        <h5 class="card-title">Departments</h5>
                        <h2><?= $DeptCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/networking.png">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $tomorrow = date("Y-m-d", strtotime('+1 day'));
                $db = dbconn();
                $sqlMngEmp = "SELECT * FROM users WHERE UserRole<>'admin' AND Status='1' AND depId='1'";
                $resultMngEmp = $db->query($sqlMngEmp);
                if ($resultMngEmp->num_rows > 0) {
                    $MngEmp = $resultMngEmp->num_rows;
                } else {
                    $MngEmp = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>reports/admin/MngEmployees.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white mb-3" style="max-width: 18rem; background-color: #3c003d;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/MngEmployees.php';">
                    <div class="card-body">
                        <h5 class="card-title">Management Dept Employees</h5>
                        <h1><?= $MngEmp ?></h1>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/manager.png">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $db = dbconn();
                $sqlServiceEmp = "SELECT * FROM users WHERE UserRole<>'admin' AND Status='1' AND depId='2'";
                $resultServiceEmp = $db->query($sqlServiceEmp);
                if ($resultServiceEmp->num_rows > 0) {
                    $ServiceEmp = $resultServiceEmp->num_rows;
                } else {
                    $ServiceEmp = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>reports/admin/ServiceEmployees.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white mb-3" style="max-width: 18rem; background-color: #3c003d;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/ServiceEmployees.php';">
                    <div class="card-body">
                        <h5 class="card-title">Service Dept Employees</h5>
                        <h1><?= $ServiceEmp ?></h1>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/technician.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-4">
                <?php
                $current = date("Y-m-d");
                $db = dbconn();
                $sqlRepEmp = "SELECT * FROM users WHERE UserRole<>'admin' AND Status='1' AND depId='3'";
                $resultRepEmp = $db->query($sqlRepEmp);
                if ($resultRepEmp->num_rows > 0) {
                    $RepairEmp = $resultRepEmp->num_rows;
                } else {
                    $RepairEmp = 0;
                }
                ?>
                <a href="<?= SYSTEM_PATH ?>reports/admin/RepairEmployees.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white mb-3" style="max-width: 18rem;background-color: #3c003d;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/RepairEmployees.php';">
                    <div class="card-body">
                        <h5 class="card-title">Repair Dept Employees</h5>
                        <h1><?= $RepairEmp ?></h1>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/technician.png">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $tomorrow = date("Y-m-d", strtotime('+1 day'));
                $db = dbconn();
                $sqlTomorrow = "SELECT * FROM users WHERE UserRole<>'admin' AND Status='1' AND depId='4'";
                $resultTomorrow = $db->query($sqlTomorrow);
                if ($resultTomorrow->num_rows > 0) {
                    $tomorrowCount = $resultTomorrow->num_rows;
                } else {
                    $tomorrowCount = 0;
                }
                ?>
                 <a href="<?= SYSTEM_PATH ?>reports/admin/AccountEmployees.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white mb-3" style="max-width: 18rem; background-color: #3c003d;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/AccountEmployees.php';">
                    <div class="card-body">
                        <h5 class="card-title">Accounts Dept Employees</h5>
                        <h2><?= $tomorrowCount ?></h2>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/accountant.png">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $db = dbconn();
                $sqlApproved = "SELECT * FROM users WHERE UserRole<>'admin' AND Status='1' AND depId='5'";
                $resultApproved = $db->query($sqlApproved);
                if ($resultApproved->num_rows > 0) {
                    $ApprovedCount = $resultApproved->num_rows;
                } else {
                    $ApprovedCount = 0;
                }
                ?>
              <a href="<?= SYSTEM_PATH ?>reports/admin/StockEmployees.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white mb-3" style="max-width: 18rem; background-color: #3c003d;" onclick="window.location.href = '<?= SYSTEM_PATH ?>reports/admin/StockEmployees.php';">
                    <div class="card-body">
                        <h5 class="card-title">Stock Dept Employees</h5>
                        <h1><?= $ApprovedCount ?></h1>
                        <img  style="float:right;width:84px;height:84px;"src="<?= SYSTEM_PATH ?>assets/img/packages.png">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


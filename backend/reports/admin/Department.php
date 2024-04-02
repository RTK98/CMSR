<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Reports</h1>  
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>/index.php" class="btn btn-sm btn-dark">Home</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>user/supplier/viewSupplier.php" class="btn btn-sm btn-dark">Supplier Managment</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>reports/admin/ActiveEmployees.php" class="btn btn-sm btn-dark">Active Employees</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>reports/admin/NonActiveSuppliers.php" class="btn btn-sm btn-dark">Non Activated Employees</a>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center   mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button  class="btn btn-sm btn-warning" onclick="history.back();">Go Back</button>
            </div>
        </div>
    </div>
    <h2>All Employee Report</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        extract($_POST);
        $where = null;

        if (!empty($Deptname)) {
           echo $where .= " DepartmentName LIKE ='$Deptname'%;";
        }
        if (!empty($where)) {
            echo $where = substr($where, 0, -3);
            $where = " WHERE $where";
        }


        $db = dbConn();
         $sql = "SELECT * FROM department $where";
        $result_data = $db->query($sql);
    }
    ?>

    <form method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <div class="row g-3">
            <div class="col-sm-4">
                <input type="text" name="Deptname" value="<?= @$Deptname ?>" class="form-control" placeholder="Enter Department Name">
            </div>
            <div class="col-sm">
                <button type="submit" class="btn btn-warning">Search</button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <?php
        $db = dbconn();
        $sql = "SELECT * FROM department";
        $result = $db->query($sql);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Department Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows >= 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= ucwords($row['DepartmentName']) ?></td>
                            <td>  <?php
                                $SupplierStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($SupplierStatus) {
                                    case 1:
                                        $statusDescription = "Active";
                                        $statusColor = "btn btn-success btn-sm";
                                        break;
                                    case 0:
                                        $statusDescription = "Deactive";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;
                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "btn btn-secondary btn-sm";
                                        break;
                                }
                                ?>
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span></td>
                        </tr>
                    </tbody>
                    <?php
                    $n++;
                }
            }
            ?>
        </table>
    </div>
</main>
<?php include'../../footer.php'; ?>

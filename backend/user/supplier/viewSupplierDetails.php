<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Employee</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewEmp.php" class="btn btn-sm btn-dark">View Employee</a>
            </div>
        </div>
    </div>
    <div class="card" style="background-color: #e1e3ef; font-weight: bold;">
        <div class="card-header" style="background-color: #cfd2e5;">
            <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                 style="
                 width:60px;
                 display: block;
                 margin: 0 auto;
                 ">
            <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
            <p class='m-1' style="text-align: center; font-weight: bold;">130A, Horahena Rd, Pannipitiya.</p>
            <p class='m-1' style="text-align: center; font-weight: bold;">0779 200 480</p>

        </div>
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && (@$action == 'view')) {

            $supplierId;
            $db = dbconn();
            $sql = "SELECT * FROM supplier WHERE SupplierId='$supplierId'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            $SupplierName = $row['SupplierName'];
            $ContactNo = $row['ContactNo'];
            $email = $row['email'];

            $db = dbconn();
            $sqlCat = "SELECT * FROM suppliercatergories WHERE SupplierId='$supplierId'";
            $resultCat = $db->query($sqlCat);

            while ($rowCat = $resultCat->fetch_assoc()) {
                $checkboxCategory[] = $rowCat['CatergoryId'];
            }
        }
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="card-body row g-3" >
                <h5 class='m-1'style="text-align: center; font-weight: bold;">Supplier Registration Form</h5>
                <div class="col-md-4">
                    <label for="SupplierName" class="form-label">Supplier Name</label>
                    <input type="text" class="form-control" id="SupplierName" name="SupplierName" value="<?= ucwords(@$SupplierName) ?>"
                           placeholder="Enter Supplier Name" readonly>
                </div>
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <label for="SupplierContactNoNew" class="form-label">Contact No</label>
                    <input type="text" class="form-control" id="SupplierContactNoNew" name="SupplierContactNoNew"
                           placeholder="Enter Supplier Contact Number" value="<?= @$ContactNo ?>" readonly>
                </div>
                <div class="col-md-8">
                    <label for="SupplierEmailNew" class="form-label">Email</label>
                    <input type="text" class="form-control" id="SupplierEmailNew" name="SupplierEmailNew"
                           placeholder="Enter Supplier Email"  value="<?= @$email ?>" readonly>
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT cat.CatergoryName FROM suppliercatergories supcat LEFT JOIN catergories cat ON supcat.CatergoryId=cat.CatergoryID WHERE supcat.SupplierId='$supplierId';";
                $result = $db->query($sql);
                ?>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Supplier Items</th>
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
                                            <td><?= ucwords($row['CatergoryName']); ?></td>
                                            <?php
                                            $n++;
                                        }
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-footer">
            <form action='viewSupplier' method='post'>
                <button type="submit" name="action" value="save" class="btn btn-sm btn-danger">Cancel</button>
            </form>
        </div>
    </div>
</main>
<?php include'../../footer.php'; ?>

<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Supplier</h1>
    </div>
    <div class="card">
        <div class="card-header">
            New Supplier
        </div>
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addSupplier') {

            $SupplierName = inputTrim(strtolower($SupplierName));
            $SupplierContactNo = inputTrim($SupplierContactNo);
            $SupplierEmail = inputTrim($SupplierEmail);
            $messages = array();
            if (empty($SupplierName)) {
                $messages['error_Product_name'] = "The Product Name should not be blank..!";
            }
            if (empty($SupplierContactNo)) {
                $messages['error_Product_price'] = "The supplier contact no should not be blank..!";
            }
            if (empty($SupplierEmail)) {
                $messages['error_Product_qty'] = "The Supplier email should not be blank..!";
            }
            if (!isset($SupplierStatus)) {
                $messages['error_Product_status'] = "The Product Status should not be blank..!";
            }
            if (!isset($checkboxCategory)) {
                $messages['error_Product_size'] = "The Please Select the Category..!";
            }
            //advance validation
            if (!empty($SupplierName)) {
                $db = dbconn();
                $sql = "SELECT * FROM supplier WHERE SupplierName='$SupplierName'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Product_name'] = "The Supplier Already Exists!";
                }
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];
                echo $sql = "INSERT INTO supplier(SupplierName,ContactNo,email,Status,AddUser,AddDate) VALUES ('$SupplierName', '$SupplierContactNo', '$SupplierEmail', '$SupplierStatus','$AddUser','$AddDate')";
                $db->query($sql);
                $SupplierId = $db->insert_id;
                foreach ($checkboxCategory as $value) {
                    $sql = "INSERT INTO suppliercatergories(SupplierId,CatergoryId) VALUES ('$SupplierId','$value')";
                    $db->query($sql);
                }
                header('Location:addSuccess.php');
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            extract($_POST);
        }
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                <div class="mb-3">
                    <label for="SupplierName" class="form-label">Supplier Name</label>
                    <input type="text" class="form-control" id="SupplierName" name="SupplierName" value="<?= @$SupplierName ?>"
                           placeholder="Enter Supplier Name">

                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT * FROM catergories WHERE CatergoryStatus = '1'";
                $result = $db->query($sql); // Run Query
//        print_r($result);
                ?>
                <div class="mb-3">
                    <label for="Catergories" class="form-label">Categories</label>
                    <br>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $categoryId = $row['CatergoryID'];
                        $categoryName = $row['CatergoryName'];
                        echo "<input type = 'checkbox' name = 'checkboxCategory[]' value = '$categoryId'>$categoryName<br>";
                    }
                    ?>
                    <div class="text-danger"><?= @$messages['error_Product_size']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="SupplierContactNo" class="form-label">Contact No</label>
                    <input type="text" class="form-control" id="SupplierContactNo" name="SupplierContactNo"
                           placeholder="Enter Supplier Contact Number" value="<?= @$SupplierContactNo?>">
                    <div class="text-danger"><?= @$messages['error_Product_price']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="SupplierEmail" class="form-label">Email</label>
                    <input type="text" class="form-control" id="SupplierEmail" name="SupplierEmail"
                           placeholder="Enter Supplier Email"  value="<?= @$SupplierEmail?>">
                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="SupplierStatus" class="form-label">Product Availability</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="SupplierStatus" id="Yes" value="1">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="SupplierStatus" id="No" value="0">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_Product_status']; ?></div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="action" value="addSupplier" class="btn btn-primary">Submit</button>
            </div>
    </div>
</div>
</form>
</div>
</div>
</main>
<?php include'../../footer.php'; ?>
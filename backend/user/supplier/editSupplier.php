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
        if ($_SERVER['REQUEST_METHOD'] === "POST" && (@$action == 'edit' || @$action == 'save' )) {

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
        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'save') {
            $supplierId;
            $SupplierContactNoNew = inputTrim($SupplierContactNoNew);
            $SupplierEmailNew = inputTrim($SupplierEmailNew);
            $messages = array();
            if (empty($SupplierContactNo)) {
                $messages['error_Product_price'] = "The supplier contact no should not be blank..!";
            }
            if (empty($SupplierEmailNew)) {
                $messages['error_Product_qty'] = "The Supplier email should not be blank..!";
            }
            if (!isset($checkboxCategoryNew)) {
                $messages['error_Product_size'] = "The Please Select the Category..!";
            }
            if (empty($messages)) {
                $supplierId;
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];
                $sql = "UPDATE supplier SET ContactNo='$SupplierContactNoNew',email='$SupplierEmailNew' WHERE SupplierId='$supplierId'";
                $db->query($sql);

                 $sql2 = "DELETE FROM suppliercatergories WHERE SupplierId='$supplierId'";
                $db->query($sql2);
                foreach ($checkboxCategoryNew as $value) {
                $sql3 = "INSERT INTO suppliercatergories(SupplierId,CatergoryId) VALUES ('$supplierId','$value')";
                    $db->query($sql3);
                }
                ?>
                <script>
                    Swal.fire({
        //                            title: 'Success!',
        //                            text: 'Password has been reset',
        //                            icon: 'success',
        //                            position: 'top-right',
        //                            showConfirmButton: true,
                        toast: true,
                        icon: 'success',
                        title: 'Supplier has been update Successfully',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = 'viewSupplier.php'; // Redirect to success page
                    });
            </script><?php
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

                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                </div>
                <div class="col-md-8">
                </div>
                <?php
                $db = dbconn();
                $sql = "SELECT * FROM catergories WHERE CatergoryStatus = '1'";
                $result = $db->query($sql);
                ?>
                <div class="col-md-12">
                    <label for="Catergories" class="form-label">Categories</label>
                    <br>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $categoryId = $row['CatergoryID'];
                        $categoryName = $row['CatergoryName'];
                        @$checked = in_array($categoryId, $checkboxCategory) ? "checked" : "";
                        echo "<input type = 'checkbox' name = 'checkboxCategoryNew[]' value = '$categoryId' $checked>$categoryName<br>";
                    }
                    ?>
                    <div class="text-danger"><?= @$messages['error_Product_size']; ?></div>
                </div>
                <div class="col-md-4">
                    <label for="SupplierContactNoNew" class="form-label">Contact No</label>
                    <input type="hidden" name="SupplierContactNo" value="<?= @$ContactNo ?>">
                    <input type="text" class="form-control" id="SupplierContactNoNew" name="SupplierContactNoNew"
                           placeholder="Enter Supplier Contact Number" value="<?= @$ContactNo ?>">
                    <div class="text-danger"><?= @$messages['error_Product_price']; ?></div>
                </div>
                <div class="col-md-8">
                    <label for="SupplierEmailNew" class="form-label">Email</label>
                    <input type="hidden" name="SupplierEmail" value="<?= @$email ?>">
                    <input type="text" class="form-control" id="SupplierEmailNew" name="SupplierEmailNew"
                           placeholder="Enter Supplier Email"  value="<?= @$email ?>">
                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                </div>
                <div class="card-footer">
                    <input type="text" name="supplierId" value="<?= @$supplierId ?>">
                    <button type="submit" name="action" value="save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php include'../../footer.php'; ?>

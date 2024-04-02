<?php ob_start(); ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addInspectionCatergory.php" class="btn btn-sm btn-outline-secondary">View Inspection Catergory</a>
            </div>
            <div class="btn-group me-2">
                <a href="addInspectionItem.php" class="btn btn-sm btn-outline-secondary">View Inspection Items</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            New Category
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $InspectionCategoryName = inputTrim($InspectionCategoryName);
            echo $name = strtolower($InspectionCategoryName);
            $messages = array();
            if (empty($name)) {
                $messages['error_Category_name'] = "The Category Name should not be blank..!";
            }
            if (!isset($CategoryStatus)) {
                $messages['error_Category_status'] = "The Category Status should not be blank..!";
            }
            // if(!isset($Size)){
            //     $messages['error_Product_size'] = "The Product Size should not be blank..!";
            // }
            //advance validation
            if (!empty($name)) {
                $db = dbconn();
                $sql = "SELECT * FROM inspectioncatergory WHERE INSname='$name'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Category_name_exist'] = "The Category Already Exists!";
                }
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                 $sql = "INSERT INTO inspectioncatergory (INSname,INSstatus)VALUES ('$name', '$CategoryStatus')";
                $db->query($sql);

                die();
                header('Location:addSuccess.php');
            }
        }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <div class="card-body">
                <div class="text-danger"><?= @$messages['error_Category_name_exist']; ?></div>
                <div class="mb-3">
                    <label for="InspectionCategoryName" class="form-label">Inspection Category Name</label>
                    <input type="text" class="form-control" id="InspectionCategoryName" name="InspectionCategoryName"
                           placeholder="Enter Inspection Category Name" value=<?= @$name ?>>
                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="CategoryStatus" class="form-label">Product Availability</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="CategoryStatus" id="Yes" value="1">
                        <label class="form-check-label" for="Yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="CategoryStatus" id="No" value="0">
                        <label class="form-check-label" for="No">No</label>
                    </div>
                    <div class="text-danger"><?= @$messages['error_Product_status']; ?></div>
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
<?php ob_end_flush(); ?>
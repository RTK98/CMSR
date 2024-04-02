<?php ob_start(); ?>
<?php include'../../header.php';     ?>
<?php include'../../menu.php';      ?>
<?php require_once dirname(__FILE__) . '/../../../web/model/vehicle.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Vehicle</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button class="btn btn-info" onclick="history.back()">Go Back</button>
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
            //extract the data
            $postData = $_POST;

            //validate data
            $isError = 0;
            $validationErrorMessages = [];
            //validate optional
            if (array_key_exists('regsitrationNo', $postData)) {
                //check max length
                if (strlen($postData['regsitrationNo']) > 7) {
                    $isError = 1;
                    $validationErrorMessages['regsitrationNo'] = 'Length should be less than 7';
                }
            }

            //required
//            if (!isset($postData['productPrice']) || empty($postData['productPrice'])) {
//                $isError = 1;
//                $validationErrorMessages['productPrice'] = 'Product price is required';
//            }


            if ($isError === 0) {
                addVehicle($postData);
            }



//            extract($_POST);
//            $data = $_POST;
//            $registrationNo = inputTrim($registrationNo);
//            addVehicle();
        }
        ?>

        <?php
        if (isset($isError) && $isError === 1) {
            foreach ($validationErrorMessages as $key => $message) {
                ?>    
                <div class="alert alert-danger" role="alert">
                    <?php echo $key . ', ' . $message ?>
                </div>
                <?php
            }
        }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
            <div class="card-body">
                <div class="mb-3">
                    <label for="RegsitrationNo" class="form-label">Regsitration No</label>
                    <input type="text" class="form-control" id="regsitrationNo" name="regsitrationNo"
                           placeholder="Enter Regsitration No">
                    <div class="text-danger"><?= @$messages['error_Product_name']; ?></div>
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
<?php include'../../footer.php'; ?>
<?php ob_end_flush(); ?>
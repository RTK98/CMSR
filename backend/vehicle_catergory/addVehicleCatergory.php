<?php  $Vehicle="active" ?>
<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Vehicle category</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewVehicleCatergory.php" class="btn btn-sm btn-outline-secondary">View Vehicle Catergory</a>
            </div>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button> -->
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            New Vehicle Category
        </div>
        <?php
//        print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            extract($_POST);
            $CatergoryName = inputTrim(strtolower($CatergoryName));
            $messages = array();
            if (empty($CatergoryName)) {
                $messages['error_Catergory_Name'] = "The catergory Name should not be blank..!";
            }
            //advance validation
            if (!empty($CatergoryName)) {
                $db = dbconn();
                $sql = "SELECT * FROM vehicle_catergories WHERE CatergoryName='$CatergoryName'";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $messages['error_Catergory_Name'] = "The Catergoy Already Exists!";
                }
            }
            if (empty($messages)) {
                $db = dbconn();
                $AddDate = date('Y-m-d');
                $AddUser = $_SESSION['userId'];
                $sql = "INSERT INTO vehicle_catergories(CatergoryName,CatergoryStatus,AddUser,AddDate) VALUES ('$CatergoryName', '1' ,'$AddUser','$AddDate')";
                $db->query($sql);
            }
        }
        ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                <div class="mb-3">
                    <label for="CatergoryName" class="form-label">Catergory Name</label>
                    <input type="text" class="form-control" id="CatergoryName" name="CatergoryName"
                           placeholder="Enter Catergory Name">
                    <div class="text-danger"><?= @$messages['error_Repair_Code']; ?></div>
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
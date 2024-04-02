<?php ob_start(); ?>
<?php
include'../header.php';
include'rand.php';
include'../menu.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Inspections</h1>
    </div>
    <div class="card">
        <div class="card-header">
            New Inspection
        </div>

        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'edit11') {
            foreach ($_POST as $key => $value) {
                // Check if the key starts with "radio-"
                if (strpos($key, 'select-') === 0) {
                    // Extract the InspectionItemId from the key
                    $inspectionItemId = substr($key, strlen('select-'));
//                    print_r($InspectionId);die();
                    $db = dbconn();
                    $AddDate = date('Y-m-d');
                    $AddUser = $_SESSION['userId'];
                    $sqlInsItems = "INSERT INTO inspectioncustomerselected(Inspecion_id,InspectionItem_Id,AddDate,AddUser,Status) "
                            . "VALUE ('$InspectionId','$inspectionItemId','$AddDate','$AddUser', 1)";
//                        $sqlInsItems = "UPDATE inspectionitems SET InsItemValue=$selectedValue WHERE InspectionItemId=$inspectionItemId";
                    $db->query($sqlInsItems);
                }
            }
            header('Location:addSuccess.php');
        }
        ?>


        <?php
        extract($_POST);
        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'edit') {

            $db = dbconn();
            $sql = "SELECT * FROM inspections WHERE InspectionId='$InspectionId'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            $CustomerName = $row['CustomerName'];
            $vehicleName = $row['VehicleNo'];
            $InpectedDate = $row['AddDate'];
            $InspectionNo = $row['InspectionNo'];
            $UserId = $row['AddUser'];

            $sqlRadioBtn = "SELECT * FROM inspectionrecord WHERE InspectionId='$InspectionId'";
            $resultRadioBtn = $db->query($sqlRadioBtn);
//            $rowRadioBtn = $resultRadioBtn->fetch_assoc();
//            $ProductStatus = $rowRadioBtn['ProductStatus'];

            $messages = array();
        }
        ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="card-body">
                <section class="m-1">
                    <div class="card-header">
                        <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                             styly=" 
                             display: block;
                             margin-left: auto;
                             margin-right: auto;
                             ">
                        <h5 class='m-1'style="text-align: center;">Replica Speed Motor Garage</h5>
                        <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
                        <p class='m-1' style="text-align: center;">0779 200 480</p>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div>
                                    <?php
                                    $db = dbconn();
                                    $sqlCusName = "SELECT FirstName,LastName FROM customer WHERE CustomerID='$CustomerName'";
                                    $resultCusName = $db->query($sqlCusName);
                                    $rowCusName = $resultCusName->fetch_assoc();
                                    ?> 
                                    <p> Customer Name : <?= $rowCusName['FirstName'] . ' ' . $rowCusName['LastName']; ?>
                                    </p>
                                </div>
                                <div>
                                    <?php
                                    $db = dbconn();
                                    $sqlVname = "SELECT registerLetter,RegistrationNo,VehicleType FROM customervehicles WHERE vehicleId='$vehicleName'";
                                    $resultVname = $db->query($sqlVname);
                                    $rowVname = $resultVname->fetch_assoc();
                                    ?>
                                    <p>Vehicle No : <?= $rowVname['registerLetter'] . ' - ' . $rowVname['RegistrationNo']; ?> </p>
                                </div>
                                <div>
                                    <?php
                                    $VehicleCatId = $rowVname['VehicleType'];
                                    $db = dbconn();
                                    $sqlCatName = "SELECT CatergoryName FROM vehicle_catergories WHERE VCatergoryId='$VehicleCatId'";
                                    $resultCatName = $db->query($sqlCatName);
                                    $rowCatName = $resultCatName->fetch_assoc();
                                    $catName = $rowCatName['CatergoryName'];
                                    ?>
                                    <p>Vehicle Type : <?= $rowCatName['CatergoryName']; ?></p>
                                </div>
                                <div>
                                    <p>Millage : <?= $row['Millege']; ?></p>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <p> INS Date :  <?= $InpectedDate ?></p>
                                </div>
                                <div>
                                    <p> INS NO. : <?= $InspectionNo ?></p>
                                </div>
                                <div>
                                    <?php
                                    $db = dbconn();
                                    $sqlAddUser = "SELECT FirstName,LastName FROM users WHERE UserId='$UserId'";
                                    $resultAddUser = $db->query($sqlAddUser);
                                    $rowAddUser = $resultAddUser->fetch_assoc();
                                    ?>
                                    <p>Inspection Officer : <?= $rowAddUser['FirstName'] . ' ' . $rowAddUser['LastName']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container m-1">
                    <table class="table m-1">
                        <thead>
                            <tr style="background-color: #d2d2d2">
                                <th scope="col">#</th>
                                <th scope="col">Item</th>
                                <th scope="col" style="background-color:#48da3a;">Good</th>
                                <th scope="col" style="background-color:#ff5858;">Bad</th>
                                <th scope="col" style="background-color:#ff9c6b;">Need To Replace</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = dbconn();
                            $sqlEngine = "SELECT * FROM inspectionitems WHERE InsItemStatus=1";
                            $resultEngine = $db->query($sqlEngine);

                            if ($resultEngine->num_rows > 0) {
                                $n = 1;
                                while ($rowengineItems = $resultEngine->fetch_assoc()) {
                                    $inspectionItemId = $rowengineItems['InspectionItemId'];
                                    $insItemName = $rowengineItems['InsItemName'];

                                    // Retrieve the previously selected value from the database for the inspection item
                                    $sqlValue = "SELECT VehicleCondition FROM InspectionRecord WHERE InspectionItemId = '$inspectionItemId'";
                                    $resultValue = $db->query($sqlValue);
                                    $selectedValue = "";

                                    if ($resultValue->num_rows > 0) {
                                        $rowValue = $resultValue->fetch_assoc();
                                        $selectedValue = $rowValue['VehicleCondition'];
                                    }

                                    // Display the radio buttons with dynamic names and pre-selected value
                                    echo '<tr>';
                                    echo '<td style="background-color: #d2d2d2">' . $n . '</td>';
                                    echo '<td>' . $insItemName . '</td>';
                                    echo '<td style="background-color:#48da3a;">';
                                    echo '<label class="form-check-custom danger">';
                                    echo '<input type="radio" name="radio-' . $inspectionItemId . '" value="1" ' . ($selectedValue == '1' ? 'checked' : '') . ' disabled>';
                                    echo '<span></span>';
                                    echo '</label>';
                                    echo '</td>';
                                    echo '<td style="background-color:#ff5858;">';
                                    echo '<label class="form-check-custom danger">';
                                    echo '<input type="radio" name="radio-' . $inspectionItemId . '" value="2" ' . ($selectedValue == '2' ? 'checked' : '') . ' disabled>';
                                    echo '<span></span>';
                                    echo '</label>';
                                    echo '</td>';
                                    echo '<td style="background-color:#ff9c6b;">';
                                    echo '<label class="form-check-custom danger">';
                                    echo '<input type="radio" name="radio-' . $inspectionItemId . '" value="3" ' . ($selectedValue == '3' ? 'checked' : '') . ' disabled>';
                                    echo '<span></span>';
                                    echo '</label>';
                                    echo '</td>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<label class="form-check-custom danger">';
                                    echo '<input type="checkbox" name="select-' . $inspectionItemId . '">';
                                    echo '<span></span>';
                                    echo '</label>';
                                    echo '</td>';
                                    echo '</tr>';

                                    $n++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="mb-3">
                        <label for="ProductDescription" class="form-label">Special Notes</label>
                        <textarea class="form-control" id="ProductDescription" rows="3" name="ProductDescription"></textarea>
                        <div class="text-danger"><?= @$messages['error_Product_des']; ?></div>
                    </div>
                </div>
                            <!-- <div class="text-danger"><?= @$messages['error_Product_size']; ?></div> -->
            </div>
            <div class="card-footer">
                <input type="text" name="InspectionId" value="<?= @$InspectionId ?>">
                <button type="submit" name="action" value="edit11" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</main>
<?php include'../footer.php'; ?>
<?php ob_end_flush(); ?>
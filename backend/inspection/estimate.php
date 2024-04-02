<?php
include'../header.php';
include'../menu.php';
include'rand.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Inspections</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addRegInspection.php" class="btn btn-sm btn-outline-secondary">Add Registered Inspection</a>
            </div>
            <div class="btn-group me-2">
                <a href="addInspection.php" class="btn btn-sm btn-outline-secondary">Add Non Reg Customer Inspection</a>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <h2>Inspection List</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && (@$action == 'edit' || @$action == 'add' || @$action == 'addproduct' || @$action == 'addrepair' || @$action == 'remove' || @$action == 'removeRepair' || @$action == 'addEstimate')) {

                        $db = dbconn();
                        $sql = "SELECT * FROM inspections WHERE InspectionId='$InspectionId'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
                        $CustomerName = $row['CustomerName'];
                        $vehicleName = $row['VehicleNo'];
                        $InpectedDate = $row['AddDate'];
                        $InspectionNo = $row['InspectionNo'];
                        $InspectionNotes = $row['inspectionNotes'];

                        $UserId = $row['AddUser'];
                    }
                    ?>
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'edit') {
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

                                $sqlInsItems = "INSERT INTO inspectioncustomerselected(Inspecion_id,InspectionItem_Id,AddDate,AddUser,Status) "
                                        . "VALUE ('$InspectionId','$inspectionItemId','$AddDate','$AddUser', 1)";
//                        $sqlInsItems = "UPDATE inspectionitems SET InsItemValue=$selectedValue WHERE InspectionItemId=$inspectionItemId";
                                $db->query($sqlInsItems);
                            }
                        }
                        ?>

                        <script>
                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: 'Customer Selected Inspection are successfully added',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                            }).then(() => {
    //                                window.location.href = 'estimate.php'; // Redirect to success page
                            });
                    </script><?php
                    }
                    ?>
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addproduct') {
                        $addeduser = $_SESSION['userId'];
                        $adddate = date("Y-m-d");
                        $InspectionId;
                        $ProductName;
                        $QtyProduct = inputTrim($QtyProduct);
                        $messages = array();
                        if (empty($QtyProduct)) {
                            $messages['error_Product_Qty'] = "The Prduct Qty should not be blank..!";
                        }
                        if ($ProductName == '--') {
                            $messages['error_Product_Name'] = "Please Select the Product..!";
                        }
                        if (!empty($ProductName)) {
                            $db = dbconn();
                            $sql = "SELECT * FROM inspectionsestimateitems WHERE addedproductid='$ProductName' AND estimateinspectionid='$InspectionId'";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                $messages['error_Product_Exists'] = "The Product Already Added To Estimate!";
                            }
                        }
                        if (empty($messages)) {
                            $sqladdproduct = "INSERT INTO inspectionsestimateitems(estimateinspectionid, addedproductid,Qty,addeduser, addeddate) VALUES ('$InspectionId','$ProductName','$QtyProduct','$addeduser','$adddate')";
                            $db = dbConn();
                            $resultaddproduct = $db->query($sqladdproduct);
                        }
                    }
                    ?>
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'remove') {
                        $EstimatedId;
                        $db = dbConn();
                        $sqlDeleteItems = "DELETE FROM inspectionsestimateitems WHERE estimateitemid='$EstimatedId'";
                        $db->query($sqlDeleteItems);
                    }
                    ?>
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'removeRepair') {
                        $EstimatedId1;
                        $db = dbConn();
                        $sqlDeleteItems = "DELETE FROM inspectionsestimateitemsrepair WHERE insEstimatedRepairId='$EstimatedId1'";
                        $db->query($sqlDeleteItems);
                    }
                    ?>
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addrepair') {

                        $RepairName;
                        $addeduser = $_SESSION['userId'];
                        $adddate = date("Y-m-d");
                        $QtyRepair;
                        $sqladdrepair = "INSERT INTO inspectionsestimateitemsrepair(insEstimatedInspectionId, addedrepairid,AddUser, AddDate,Qty) VALUES ('$InspectionId','$RepairName','$addeduser','$adddate','$QtyRepair')";
                        $db = dbConn();
                        $resultaddrepair = $db->query($sqladdrepair);
                    }
                    ?>
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addEstimate') {

                        $addeduser = $_SESSION['userId'];
                        $AddDate = date('Y-m-d');
                        $timestamp = strtotime($AddDate);
                        $currentdatenumber = date('Ymd', $timestamp);
                        $randomNumber;
                        $EstimateNo = 'EST' . $currentdatenumber . $randomNumber;

                        $db = dbConn();
                        $sqlEstimate = "INSERT INTO estimate(EstimateNo, InspectionId,EstimateStatus, AddUser,AddDate) VALUES ('$EstimateNo','$InspectionId','1','$addeduser','$AddDate')";
                        $resultaEstimate = $db->query($sqlEstimate);
                        $EstimateId = $db->insert_id;

                        $db = dbConn();
                        $sqlUpdateINS = "UPDATE inspections SET Status='2' where InspectionId='$InspectionId'";
                        $resultsUpdateINS = $db->query($sqlUpdateINS);

                        $db = dbConn();
                        $sqlshowEstimateProduct = "SELECT * FROM inspectionsestimateitems INNER join products on inspectionsestimateitems.addedproductid= products.ProductId where estimateinspectionid='$InspectionId'";

                        $resultshowEstimateProduct = $db->query($sqlshowEstimateProduct);
                        ?>
                        <?php
                        if ($resultshowEstimateProduct->num_rows > 0) {
                            while ($rowEstimateProduct = $resultshowEstimateProduct->fetch_assoc()) {
                                ?>


                                <?php
                                echo $addedproductid = $rowEstimateProduct['addedproductid'];
                                echo $addedproductqty = $rowEstimateProduct['Qty'];
                                $sqlProductPrice1 = "SELECT * FROM products INNER JOIN stock ON products.ProductId = stock.Product_Id WHERE products.ProductId='$addedproductid' ORDER BY stock.Date ASC LIMIT 1;";
                                $resultProductPrice = $db->query($sqlProductPrice1);
                                $rowProductPrice = $resultProductPrice->fetch_assoc();
                                $price = $rowProductPrice['SalePrice'];

                                 $sqlestimateinsert = "INSERT INTO estimateitems(estimateID, ProdcutId,Qty, Amount) VALUES ('$EstimateId','$addedproductid','$addedproductqty','$price')";
                                $resultaEstimateInsert = $db->query($sqlestimateinsert);
                                ?>
                                <?php
                            }
                        }
                        ?>


                        <?php
                        $sqlEstimateRepair = "SELECT * FROM inspectionsestimateitemsrepair INNER join repaircatergory on inspectionsestimateitemsrepair.addedrepairid= repaircatergory.RepairId where insEstimatedInspectionId='$InspectionId'";
                        $db = dbConn();
                        $resultsEtimateRepair = $db->query($sqlEstimateRepair);
//                                            $rowsrepair = $resultsrepair->fetch_assoc();
//                                            var_dump($rowsrepair);
                        ?> 
                        <?php
                        if ($resultsEtimateRepair->num_rows > 0) {
                            while ($rowsEstimatedrepair = $resultsEtimateRepair->fetch_assoc()) {
                                ?>
                                <?php
                                $EstrepairName = $rowsEstimatedrepair['RepairId'];
                                $EstRepairQty = $rowsEstimatedrepair['Qty'];
                                $EstrepairPrice = $rowsEstimatedrepair['RepairPrice'];

                                 $sqlestimateinsert1 = "INSERT INTO estimateitems(estimateID,RepairId, Qty, Amount) VALUES ('$EstimateId','$EstrepairName','$EstRepairQty','$EstrepairPrice')";
                                $resultaEstimateInsert1 = $db->query($sqlestimateinsert1);
                                ?> 
                                <?php
                            }
                        }
                        ?>
                        <script>
                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: 'Estimate has been successfully added',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                            }).then(() => {
                                window.location.href = 'viewIEstimates.php'; // Redirect to success page
                            });
                    </script><?php
                    }
                    ?>

                    <div class="card-body">
                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <section class="m-1">
                                <div class="card-header">
                                    <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                                         styly=" 
                                         display: block;
                                         margin-left: auto;
                                         margin-right: auto;
                                         ">
                                    <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
                                    <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
                                    <p class='m-1' style="text-align: center;">0779 200 480</p>

                                </div>
                                <div class="card-body">
                                    <div>
                                        <h4 class='m-1'style="text-align: center; font-weight: bold;">Inspection Report</h4>
                                    </div>

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
                                    <textarea class="form-control" id="ProductDescription" rows="3" name="ProductDescription" disabled><?= $InspectionNotes ?></textarea>
                                    <div class="text-danger"><?= @$messages['error_Product_des']; ?></div>
                                </div>
                            </div> 

                            <div class="card-footer">
                                <input type="hidden" name="InspectionId" value="<?= @$InspectionId ?>">
                                <button type="submit" name="action" value="edit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--            End of first Column-->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <section class="m-1">
                            <div class="card-header">
                                <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                                     styly=" 
                                     display: block;
                                     margin-left: auto;
                                     margin-right: auto;
                                     ">
                                <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
                                <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
                                <p class='m-1' style="text-align: center;">0779 200 480</p>
                            </div>
                            <div class="card-body">
                                <h5 class='m-1'style="text-align: center; font-weight: bold;">Estimate</h5>
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
                        <section>
                            <div class="container m-1">
                                <section>
                                    <h6>Products</h6>
                                    <table class="table m-1">
                                        <thead>
                                            <tr style="background-color: #d2d2d2">
                                                <th scope="col">#</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Rate</th>
                                                <th scope="col">Amount(Rs.)</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqlshowproduct = "SELECT *,inspectionsestimateitems.Qty AS 'ItemQty' FROM inspectionsestimateitems INNER join products on inspectionsestimateitems.addedproductid= products.ProductId where estimateinspectionid='$InspectionId'";
                                            $db = dbConn();
                                            $resultshowproduct = $db->query($sqlshowproduct);
//                                            $rowshowp = $resultshowproduct->fetch_assoc();
//                                            var_dump($rowshowp);
                                            ?>



                                            <?php
                                            $totalProduct = 0;
                                            if ($resultshowproduct->num_rows > 0) {
                                                $i = 1;

                                                while ($rowshowp = $resultshowproduct->fetch_assoc()) {
                                                    ?><tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $prodcutName = $rowshowp['ProductName'] ?></td>
                                                        <td><?= $rowshowp['ItemQty'] ?></td> 
                                                        <td><?php
                                                            $Qty = $rowshowp['ItemQty'];
                                                            $Product = $rowshowp['addedproductid'];
                                                            $sqlProductPrice = "SELECT * FROM products INNER JOIN stock ON products.ProductId = stock.Product_Id WHERE products.ProductId=$Product ORDER BY stock.Date ASC LIMIT 1;";
                                                            $resultPrice = $db->query($sqlProductPrice);
                                                            $rowProductPrice = $resultPrice->fetch_assoc();
                                                            if ($resultPrice->num_rows == 0) {
                                                                $price = 0;
                                                            }
                                                            ?>
                                                            <?= @$price = $rowProductPrice['SalePrice']; ?>
                                                        </td> 
                                                        <td> <?php echo $sum = @$Qty * @$price ?></td>
                                                        <?php
//                                                            echo $productData = "('$InspectionId','$Product',$prodcutName', $Qty, $price)";
                                                        ?>
                                                        <td> 
                                                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                <?php
                                                                $ProductId = $rowshowp['estimateitemid'];
                                                                ?>
                                                                <input type="hidden" name="EstimatedId" value="<?= $ProductId ?>" >
                                                                <input type="hidden" name="InspectionId" value="<?= $InspectionId ?>" >
                                                                <button type="submit" class="btn btn-danger btn-sm" name="action" value="remove" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    $totalProduct += $sum;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong><?= $totalProduct ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </section>
                                <section>
                                    <h6>Repairs</h6>
                                    <table class="table m-1">
                                        <thead>
                                            <tr style="background-color: #d2d2d2">
                                                <th scope="col">#</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Rate</th>
                                                <th scope="col">Amount(Rs.)</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqlshowrepair = "SELECT * FROM inspectionsestimateitemsrepair INNER join repaircatergory on inspectionsestimateitemsrepair.addedrepairid= repaircatergory.RepairId where insEstimatedInspectionId='$InspectionId'";
                                            $db = dbConn();
                                            $resultsrepair = $db->query($sqlshowrepair);
//                                            $rowsrepair = $resultsrepair->fetch_assoc();
//                                            var_dump($rowsrepair);
                                            ?> 
                                            <?php
                                            $totalRepair = 0;
                                            if ($resultsrepair->num_rows > 0) {
                                                $i = 1;
                                                while ($rowsrepair = $resultsrepair->fetch_assoc()) {
                                                    ?><tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $repairName = $rowsrepair['RepairName'] ?></td>    
                                                        <td><?= $RepairQty = $rowsrepair['Qty'] ?></td>
                                                        <td><?= $repairPrice = $rowsrepair['RepairPrice'] ?></td>
                                                        <td><?= @$sumeRepair = $RepairQty * $repairPrice; ?></td>
                                                        <?php
                                                        $RepairId = $rowsrepair['insEstimatedRepairId'];
//                                                            $RepairData = "('$InspectionId','$RepairId','$repairName', $RepairQty, $repairPrice)";
                                                        ?>
                                                        <td> 
                                                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                <input type="hidden" name="EstimatedId1" value="<?= $RepairId ?>" >
                                                                <input type="hidden" name="InspectionId" value="<?= $InspectionId ?>" >
                                                                <button type="submit" class="btn btn-danger btn-sm" name="action" value="removeRepair" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    $totalRepair += $sumeRepair;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong><?= $totalRepair ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Grand Total</strong></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong><?= $totalProduct += $totalRepair ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </section>
                                <div class="mb-3">
                                    <p style='text-align: justify;
                                       text-justify: auto;
                                       font-weight: bold'>
                                        <em>Terms & Conditions</em></p>
                                    <p style='text-align: justify;
                                       text-justify: auto;
                                       list-style:disc outside none;
                                       display:list-item; '>
                                        <em>The above estimate is based on our inspection and does not include any addition parts or labor which may be 
                                            required after the work has been started.</em></p>
                                    <p style='text-align: justify;
                                       text-justify: auto;
                                       list-style:disc outside none;
                                       display:list-item; '><em>Occasionally after the repair has started,damage or broken parts are discovered which are not evident on initial inspection.</em>
                                        <em>Estimate prices subject to change after 3 days.</em> </p>
                                    <p style='text-align: justify;
                                       text-justify: auto;
                                       list-style:disc outside none;
                                       display:list-item; '><em>Not responsible for any delays caused by unavailability of parts or delays
                                            in parts shipment by supplier or transporter.</em></p>
                                    <p style='text-align: justify;
                                       text-justify: auto;
                                       list-style:disc outside none;
                                       display:list-item; '><em> All terms and conditions of repair order and invoices apply.</em>
                                    </p>
                                </div>
                            </div>
                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div class="card-footer">
                                    <input type="hidden" name="InspectionId" value="<?= $InspectionId ?>" >
                                    <button type="submit" name="action" value="addEstimate" class="btn btn-primary ">Submit</button>
                                </div>
                            </form>
                        </section> 
                    </div>
                    </form>
                </div>
            </div>
            <!--            End of second Column-->
            <div class="col-md-3">
                <div class="text-danger"><?= @$messages['error_Product_Exists']; ?></div>
                <form id='product' action="estimate.php" method="POST" >
                    <div class="card text-dark bg-light  mb-3 m-1" style="width: 18rem;">
                        <?php
                        $db = dbconn();
                        $sqlCategory = "SELECT CatergoryID,CatergoryName FROM catergories WHERE CatergoryStatus='1'";
                        $resultCategory = $db->query($sqlCategory);
//                        $db = dbconn();
//                        $sqlProducts = "SELECT ProductId,ProductName FROM products WHERE ProductStatus='1'";
//                        $resultProducts = $db->query($sqlProducts);
//                    $rowRepair = $resultRepair->fetch_assoc();
//                    var_dump($rowRepair);
                        ?>
                        <div class="card-body text-center">
                            <h5 class="card-title">Add Products</h5>
                            <div class="mb-3">
                                <label for="CategoryName" class="form-label">Product Name</label>
                                <select id='CategoryName' for="CategoryName" name="CategoryName" class="form-select" aria-label="Default select example" onclick='loadCustomerName()'>
                                    <option>--</option>
                                    <?php
                                    if ($resultCategory->num_rows > 0) {
                                        while ($rowCategory = $resultCategory->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $rowCategory['CatergoryID'] ?>" <?php
                                            if (@$CategoryName == $rowCategory['CatergoryName']) {
                                                echo "selected";
                                            }
                                            ?>><?= $rowCategory['CatergoryName'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                </select>
                                <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                            </div>
                            <div class="mb-3">
                                <label for="ProductName" class="form-label">Product Name</label>
                                <select id='ProductName' for="ProductName" name="ProductName" class="form-select" aria-label="Default select example">
                                    <option value=''>--</option>

                                </select>
                                <div class="text-danger"><?= @$messages['error_Product_Name']; ?></div>
                            </div>
                            <div class="mb-3">
                                <label for="QtyProduct" class="form-label">Qty</label>
                                <input type="number" class="form-control"  min='1' id="QtyProduct" name="QtyProduct"
                                       placeholder="Enter Qty">
                                <div class="text-danger"><?= @$messages['error_Product_Qty']; ?></div>
                            </div>
                            <input type="hidden" name="InspectionId" value="<?= $InspectionId ?>" >
                            <button type="submit" name="action" value="addproduct" class="btn btn-dark ">Add Product</button>
                        </div>
                    </div>
                </form>

                <div class="card text-dark bg-light  m-1" style="width: 18rem;">
                    <?php
                    $db = dbconn();
                    $sqlRepair = "SELECT RepairId,RepairName FROM repaircatergory WHERE RepairStatus='1'";
                    $resultRepair = $db->query($sqlRepair);
//                    $rowRepair = $resultRepair->fetch_assoc();
//                    var_dump($rowRepair);
                    ?>
                    <form action="estimate.php" method="POST" >
                        <div class="card-body text-center ">
                            <h5 class="card-title">Add Repairs</h5>
                            <div class="mb-3">
                                <label for="RepairName" class="form-label">Repair Name</label>
                                <select for="RepairName" name="RepairName" class="form-select" onchange="loadCity()">
                                    <option value="RepairName">--</option>
                                    <?php
                                    if ($resultRepair->num_rows > 0) {
                                        while ($rowRepair = $resultRepair->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $rowRepair['RepairId'] ?>" <?php
                                            if (@$VehicleType == $rowRepair['RepairName']) {
                                                echo "selected";
                                            }
                                            ?>><?= $rowRepair['RepairName'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="QtyRepair" class="form-label">Qty</label>
                                <input type="number" class="form-control" min='1' id="QtyRepair" name="QtyRepair"
                                       placeholder="Enter Qty">
                                <div class="text-danger"><?= @$messages['error_Repair_Code']; ?></div>
                            </div>
                            <input type="hidden" name="InspectionId" value="<?= $InspectionId ?>" >
                            <button type="submit" name="action" value="addrepair" class="btn btn-dark ">Add Repair</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</main>
<?php include'../footer.php'; ?>
<script>
    function loadCustomerName() {
        ////        alert("loadCustomerName");
        //        var formData = $('#addSkills').serialize();
        var selectedOption = $('#CategoryName').val();
        console.log(selectedOption);
        $.ajax({
            type: 'POST',
            url: 'loadProducts.php',
            data: {options: selectedOption},
            success: function (response) {
                $('#ProductName').html(response);
                //                alert(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
    //    $(document).ready(function(){
    //    $('#CategoryName').on('change', function(){
    //    var CategoryId = $(this).val();
    //            console.log('CategoryId');
    //            if (CategoryId){
    //    $.ajax({
    //    type:'POST',
    //            url:'loadProducts.php',
    //            data:'CatergoryID=' + CategoryId,
    //            success:function(html){
    //            $('#ProductName').html(html);
    //            }
    //    });
    //    });
    //    }};
</script>
<?php ob_start(); ?>
<?php
include'../header.php';
include'rand.php';
include'../menu.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">View  Inspection Detail</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <?php
                    extract($_POST);
                    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'view') {

                        $db = dbconn();
                        $sql = "SELECT * FROM inspections WHERE InspectionId='$InspectionId'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
                        $CustomerName = $row['CustomerName'];
                        $vehicleName = $row['VehicleNo'];
                        $InpectedDate = $row['AddDate'];
                        $InspectionNo = $row['InspectionNo'];
                        $UserId = $row['AddUser'];
                        $InspectionNotes = $row['inspectionNotes'];

                        $sqlRadioBtn = "SELECT * FROM inspectionrecord WHERE InspectionId='$InspectionId'";
                        $resultRadioBtn = $db->query($sqlRadioBtn);
                    }
                    ?>

                    <div class="card-body">
                        <section class="m-1">
                            <div class="card-header">
                                <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                                     style="
                                     display: block;
                                     margin-left: auto;
                                     margin-right: auto;
                                     ">
                                <h5 class='m-1'style="text-align: center;">Replica Speed Motor Garage</h5>
                                <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
                                <p class='m-1' style="text-align: center;">0779 200 480</p>
                            </div>
                            <div class="card-body">
                                <div>
                                    <h4 class='m-1'style="text-align: center; font-weight: bold;">Inspection Report</h4>
                                </div>
                                <br>
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
                            <label class="form-label" style="font-weight: bold;">Insepction Items</label>
                            <table class="table m-1">
                                <thead>
                                    <tr style="background-color: #d2d2d2">
                                        <th scope="col">#</th>
                                        <th scope="col">Item</th>
                                        <th scope="col" style="background-color:#48da3a;">Good</th>
                                        <th scope="col" style="background-color:#ff5858;">Bad</th>
                                        <th scope="col" style="background-color:#ff9c6b;">Need To Replace</th>
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
                                            echo '</tr>';

                                            $n++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="mb-3">
                                <label for="ProductDescription" class="form-label" style="color:red; font-weight: bold;">Special Notes*</label>
                                <textarea class="form-control" id="ProductDescription" rows="3" name="ProductDescription" disabled><?= $InspectionNotes ?></textarea>
                                <div class="text-danger"><?= @$messages['error_Product_des']; ?></div>
                            </div>
                        </div>
                                    <!-- <div class="text-danger"><?= @$messages['error_Product_size']; ?></div> -->
                    </div>
                    <div class="card-footer">
                        <form method="post"  action="viewIEstimates.php">
                            <button type="submit" name="action" value="cancel" class="btn btn-sm btn-danger">Close</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <section class="m-1">
                            <div class="card-header">
                                <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                                     style="
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
                                    <h4 class='m-1'style="text-align: center; font-weight: bold;">Customer Selected Inspected Items</h4>
                                </div>
                                <br>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $db = dbconn();
                                    $sqlEngine = "SELECT * FROM `inspectioncustomerselected` JOIN inspectionitems ON inspectionitems.InspectionItemId = inspectioncustomerselected.InspectionItem_Id WHERE Inspecion_id = $InspectionId;";
                                    $resultEngine = $db->query($sqlEngine);

                                    if ($resultEngine->num_rows > 0) {
                                        $n = 1;
                                        while ($rowengineItems = $resultEngine->fetch_assoc()) {
                                            $inspectionItemId = $rowengineItems['InspectionItemId'];
                                            $insItemName = $rowengineItems['InsItemName'];
                                            // Display the radio buttons with dynamic names and pre-selected value
                                            echo '<tr>';
                                            echo '<td style="background-color: #d2d2d2">' . $n . '</td>';
                                            echo '<td>' . $insItemName . '</td>';

                                            echo '</tr>';

                                            $n++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="mb-3">
                                <label for="ProductDescription" class="form-label" style="color:red; font-weight: bold;">Special Notes*</label>
                                <textarea class="form-control" id="ProductDescription" rows="3" name="ProductDescription" disabled><?= $InspectionNotes ?></textarea>
                                <div class="text-danger"><?= @$messages['error_Product_des']; ?></div>
                            </div>
                        </div>
                                    <!-- <div class="text-danger"><?= @$messages['error_Product_size']; ?></div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqlshowEstimateProduct = "SELECT * FROM inspectionsestimateitems INNER join products on inspectionsestimateitems.addedproductid= products.ProductId where estimateinspectionid='$InspectionId'";
                                                $db = dbConn();
                                                $resultshowEstimateProduct = $db->query($sqlshowEstimateProduct);
                                                ?>



                                                <?php
                                                $totalProduct = 0;
                                                if ($resultshowEstimateProduct->num_rows > 0) {
                                                    $i = 1;

                                                    while ($rowshowp = $resultshowEstimateProduct->fetch_assoc()) {
                                                        ?><tr>
                                                            <td><?= $i ?></td>
                                                            <td><?= $prodcutName = $rowshowp['ProductName'] ?></td>
                                                            <td><?= $rowshowp['Qty'] ?></td> 
                                                            <td><?php
                                                                $Qty = $rowshowp['Qty'];
                                                                $Product = $rowshowp['addedproductid'];
                                                                $sqlProductPrice = "SELECT * FROM products INNER JOIN stock ON products.ProductId = stock.Product_Id WHERE products.ProductId=$Product ORDER BY stock.Date ASC LIMIT 1;";
                                                                $resultPrice = $db->query($sqlProductPrice);
                                                                $rowProductPrice = $resultPrice->fetch_assoc();
                                                                if ($resultPrice->num_rows == 0) {
                                                                    // If no rows were fetched, set the quantity to 0
                                                                    echo $price = 0;
                                                                }
                                                                ?>
                                                                <?= @$price = $rowProductPrice['SalePrice']; ?>
                                                            </td> 
                                                            <td> <?php echo $sum = @$Qty * @$price ?></td>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqlEstimateRepair = "SELECT * FROM inspectionsestimateitemsrepair INNER join repaircatergory on inspectionsestimateitemsrepair.addedrepairid= repaircatergory.RepairId where insEstimatedInspectionId='$InspectionId'";
                                                $db = dbConn();
                                                $resultsEtimateRepair = $db->query($sqlEstimateRepair);
                                                ?> 
                                                <?php
                                                $totalRepair = 0;
                                                if ($resultsEtimateRepair->num_rows > 0) {
                                                    $i = 1;
                                                    while ($rowsrepair = $resultsEtimateRepair->fetch_assoc()) {
                                                        ?><tr>
                                                            <td><?= $i ?></td>
                                                            <td><?= $repairName = $rowsrepair['RepairName'] ?></td>    
                                                            <td><?= $RepairQty = $rowsrepair['Qty'] ?></td>
                                                            <td><?= $repairPrice = $rowsrepair['RepairPrice'] ?></td>
                                                            <td><?= @$sumeRepair = $RepairQty * $repairPrice; ?></td>
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
                            </section> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include'../footer.php'; ?>
<?php ob_end_flush(); ?>
<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Order</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="col-md-12">
                        <?php
                        extract($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'edit') {
                            $JobCardsInspetionId;
                            $jobCardsRepairId;
                            $db = dbconn();
                             $sql = "SELECT ins.InspectionId,ins.InspectionNo,ins.AddDate,ins.Millege,ins.inspectionNotes,cv.registerLetter,cv.RegistrationNo,vc.CatergoryName,u.FirstName,u.LastName,"
                            . "cus.FirstName AS 'CustomerFirstName',cus.LastName AS 'CustomerLastName'"
                            . " FROM inspections ins "
                            . "LEFT JOIN customervehicles cv ON ins.VehicleNo=cv.vehicleId "
                            . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                            . "LEFT JOIN users u ON ins.AddUser=u.UserId "
                            . "LEFT JOIN customer cus ON ins.CustomerName=cus.CustomerID "
                            . "WHERE InspectionId='$JobCardsInspetionId';";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            $InspectionId = $row['InspectionId'];

                            $sql1 = "SELECT jobCardsRepairId,JobCardNo FROM Job_cardsrepair WHERE jobCardsRepairId = '$jobCardsRepairId'";
                            $result1 = $db->query($sql1);
                            $row1 = $result1->fetch_assoc();
                        }
                        ?>
                        <div class="card">
                            <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
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
                                            <div>
                                                <h4 class='m-1'style="text-align: center; font-weight: bold;">Inspection Report</h4>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <p> Customer Name : <?= $row['CustomerFirstName'] . ' ' . $row['CustomerLastName']; ?>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>Vehicle No : <?= $row['registerLetter'] . ' - ' . $row['RegistrationNo']; ?> </p>
                                                    </div>
                                                    <div>
                                                        <p>Vehicle Type : <?= $row['CatergoryName']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Millage : <?= $row['Millege']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <p> INS Date :  <?= $row['AddDate']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p> INS NO. : <?= $row['InspectionNo']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Inspection Officer : <?= $row['FirstName'] . ' ' . $row['LastName']; ?></p>
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
                                            <label for="ProductDescription" class="form-label">Special Notes</label>
                                            <textarea class="form-control" id="ProductDescription" rows="3" name="ProductDescription" readonly><?= $row['inspectionNotes']; ?></textarea>
                                            <div class="text-danger"><?= @$messages['error_Product_des']; ?></div>
                                        </div>
                                    </div>
                                                <!-- <div class="text-danger"><?= @$messages['error_Product_size']; ?></div> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--            Requesting Order-->

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
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
                                            <h5 class='m-1'style="text-align: center; font-weight: bold;">Requesting Order</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <p> Customer Name : <?= $row['CustomerFirstName'] . ' ' . $row['CustomerLastName']; ?>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>Vehicle No : <?= $row['registerLetter'] . ' - ' . $row['RegistrationNo']; ?> </p>
                                                    </div>
                                                    <div>
                                                        <p>Vehicle Type : <?= $row['CatergoryName']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Millage : <?= $row['Millege']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <p> INS Date :  <?= $row['AddDate']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p> INS NO. :<?= $row['InspectionNo']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Inspection Officer :  <?= $row['FirstName'] . ' ' . $row['LastName']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Job Card No:  <?= $row1['JobCardNo'] ?></p>
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
                                                        $sqlshowproduct = "SELECT * FROM inspectionsestimateitems INNER join products on inspectionsestimateitems.addedproductid= products.ProductId where estimateinspectionid='$InspectionId'";
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
                                                                    <?php
//                                                            echo $productData = "('$InspectionId','$Product',$prodcutName', $Qty, $price)";
                                                                    ?>
                                                                    <td> 
                                                                        <?php
                                                                        $ProductId = $rowshowp['estimateitemid'];
                                                                        ?>
                                                                        <input type="text" name="EstimatedId" value="<?= $ProductId ?>" >
                                                                        <input type="hidden" name="InspectionId" value="<?= $InspectionId ?>" >
                                                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="remove" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>


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
                                                                        <input type="text" name="EstimatedId1" value="<?= $RepairId ?>" >
                                                                        <input type="hidden" name="InspectionId" value="<?= $InspectionId ?>" >
                                                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="removeRepair" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>
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
                                        <div class="card-footer">
                                            <input type="hidden" name="InspectionId" value="<?= $InspectionId ?>" >
                                            <button type="submit" name="action" value="addEstimate" class="btn btn-primary ">Submit</button>
                                        </div>
                                    </section> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>






            <!--        item Ordering-->
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
                                <input type="text" class="form-control" id="QtyProduct" name="QtyProduct"
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
                                <input type="text" class="form-control" id="QtyRepair" name="QtyRepair"
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
<?php include'../../footer.php'; ?>
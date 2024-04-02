<?php ob_start(); ?>
<?php
include'../header.php';
include'../menu.php';
include'rand.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Work</h1>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && (@$action == 'edit' || @$action == 'addrepair' || @$action == 'returnProduct' || @$action == 'removeRepair' || @$action == 'complete')) {
        $jobCardId;
        $AppointmentId;
        $InspectionNo;
        $db = dbconn();
        echo $sql = "SELECT ins.InspectionId,ins.InspectionNo,ins.AddDate,ins.Millege,ins.inspectionNotes,"
        . "cv.vehicleId,cv.registerLetter,cv.RegistrationNo,vc.CatergoryName,u.FirstName,u.LastName,cus.CustomerID,cus.FirstName AS 'CustomerFirstName',cus.LastName AS 'CustomerLastName' "
        . "FROM inspections ins "
        . "LEFT JOIN customervehicles cv ON ins.VehicleNo=cv.vehicleId "
        . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
        . "LEFT JOIN users u ON ins.AddUser=u.UserId "
        . "LEFT JOIN customer cus ON ins.CustomerName=cus.CustomerID WHERE InspectionId='$InspectionNo';";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $JobCardsInspetionId = $row['InspectionId'];
        $customerId = $row['CustomerID'];
        $VehicleId = $row['vehicleId'];

        $sql1 = "SELECT jobCardsRepairId,JobCardNo FROM Job_cardsrepair WHERE jobCardsRepairId = '$jobCardsRepairId'";
        $result1 = $db->query($sql1);
        $row1 = $result1->fetch_assoc();
        $jobCardsRepairId = $row1['jobCardsRepairId'];
        $row1['JobCardNo'];
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addrepair') {
        $JobCardsInspetionId;
        $jobCardsRepairId;
        $RepairName;
        $QtyRepair;
        $addeduser = $_SESSION['userId'];
        $adddate = date("Y-m-d");
        $db = dbConn();
        $sqladdreqRepair = "INSERT INTO orderreqrepairs(JobCard_No, ReqRepairId,Qty, AddDate,AddUser) VALUES ('$jobCardsRepairId','$RepairName','$QtyRepair','$adddate','$addeduser')";

        $resultaddReqRepair = $db->query($sqladdreqRepair);
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'removeRepair') {
        $JobCardsInspetionId;
        $jobCardsRepairId;
        $repairId;
        $db = dbConn();
        $sqlDelreqRepair = "DELETE FROM orderreqrepairs WHERE JobCard_No ='$jobCardsRepairId' AND ReqRepairId='$repairId'";

        $resultDelReqRepair = $db->query($sqlDelreqRepair);
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'returnProduct') {
        $jobCardsRepairId;
        $ProductId;

        $addeduser = $_SESSION['userId'];
        $adddate = date("Y-m-d");

        $db = dbConn();
        echo $sqlUpdateItems = "UPDATE jobcardtempitemsrepair SET Status='0' WHERE StockId='$ProductId'";
        $db->query($sqlUpdateItems);

        echo $sqlUpdateItems = "INSERT INTO retunitemstock(JobCardId,StockIid, AddUser, AddDate,Status) VALUES ("
        . "'$jobCardsRepairId','$ProductId','$addeduser','$adddate','1')";
        $db->query($sqlUpdateItems);
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'complete') {
        $jobCardsRepairId;
//                        $productData = [];
//                        $repairData = [];
//                        print_r($productData);
//                        print_r($repairData);

        $addeduser = $_SESSION['userId'];
        $AddDate = date('Y-m-d');
        $timestamp = date('H:i');

        $db = dbConn();
        $sqlorders = "INSERT INTO job_carditems(JobCardId, InspectionNo,JobCardNo, CustomerName,VehicleNo,AddDate,AddUser,Status) VALUES ('$jobCardsRepairId','$JobCardsInspetionId','$jobCardsRepairId','$customerId','$VehicleId','$AddDate','$addeduser','1')";
        $resultsOrder = $db->query($sqlorders);
        $OrderId = $db->insert_id;
//                            die();
        $sqlAddproduct = "SELECT odr.orderReqItemId,odr.JobCardId, odr.Qty, jb.JobCardNo, p.ProductId ,p.ProductName FROM orderrequestitems odr "
                . "LEFT JOIN job_cardsrepair jb ON odr.JobCardId = jb.jobCardsRepairId "
                . "LEFT JOIN products p ON odr.ReqProductId = p.ProductId WHERE odr.JobCardId = '$jobCardsRepairId';";
        $db = dbConn();
        $resultAddproduct = $db->query($sqlAddproduct);
        ?>
        <?php
        if ($resultAddproduct->num_rows > 0) {
            while ($rowOderProduct = $resultAddproduct->fetch_assoc()) {
                ?>


                <?php
                echo $addedproductid = $rowOderProduct['ProductId'];
                echo $addedproductqty = $rowOderProduct['Qty'];

                echo $sqlestimateinsert = "INSERT INTO orderitems(OrderId, ProductId,Qty, AddUser,AddDate) VALUES ('$OrderId','$addedproductid','$addedproductqty','$addeduser','$AddDate')";
                $resultaEstimateInsert = $db->query($sqlestimateinsert);
                ?>
                <?php
            }
        }
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
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
                                                 style="
                                                 width:60px;
                                                 display: block;
                                                 margin: 0 auto;
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
                                                $sqlEngine = "SELECT * FROM `inspectioncustomerselected` JOIN inspectionitems ON inspectionitems.InspectionItemId = inspectioncustomerselected.InspectionItem_Id WHERE Inspecion_id = $JobCardsInspetionId;";
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
                                                 style="
                                                 width:60px;
                                                 display: block;
                                                 margin: 0 auto;
                                                 ">
                                            <h5 class='m-1'style="text-align: center; font-weight: bold;">Replica Speed Motor Garage</h5>
                                            <p class='m-1' style="text-align: center;">130A, Horahena Rd, Pannipitiya.</p>
                                            <p class='m-1' style="text-align: center;">0779 200 480</p>
                                        </div>
                                        <div class="card-body">
                                            <h5 class='m-1'style="text-align: center; font-weight: bold;">Job Card</h5>
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
                                                            <th scope="col">Serial No</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Qty</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sqlshowproduct = "SELECT jbtmp.OrderId,jbtmp.Qty,jbtmp.Status,p.ProductId,p.ProductName,s.StockId,s.SerialNo,s.Cost,s.SalePrice "
                                                                . "FROM jobcardtempitemsrepair jbtmp "
                                                                . "LEFT JOIN products p ON jbtmp.ProductId=p.ProductId "
                                                                . "LEFT JOIN stockitems s ON jbtmp.StockId=s.StockId"
                                                                . " WHERE jbtmp.JobCardId= '$jobCardsRepairId' AND jbtmp.Status='1';";
                                                        $db = dbConn();
                                                        $resultshowproduct = $db->query($sqlshowproduct);
                                                        ?>



                                                        <?php
                                                        $totalProduct = 0;
                                                        $TotalCostProduct = 0;
                                                        if ($resultshowproduct->num_rows > 0) {
                                                            $i = 1;

                                                            while ($rowshowp = $resultshowproduct->fetch_assoc()) {
                                                                ?><tr>
                                                                    <td><?= $i ?></td>
                                                                    <td><?= $rowshowp['ProductName'] ?></td>
                                                                    <td><?= $rowshowp['SerialNo'] ?></td>
                                                                    <td><?= $ProdcutPrice = $rowshowp['SalePrice'] ?>
                                                                        <?php
                                                                        $ProductCost = $rowshowp['Cost'];
                                                                        ?>


                                                                    </td>
                                                                    <td><?= $ProductQty = $rowshowp['Qty'] ?></td>
                                                                    <td><?= @$sumProduct = $ProductQty * $ProdcutPrice; ?>
                                                                        <?Php
                                                                        $sumCostProduct = $ProductQty * $ProductCost;
                                                                        ?>

                                                                    </td>
                                                                    <td> 
                                                                        <?php
                                                                        echo $ProductId = $rowshowp['StockId'];
                                                                        ?>
                                                                        <input type="text" name="ProductId" value="<?= $ProductId ?>" >
                                                                        <input type="text" name="JobCardsInspetionId" value="<?= $JobCardsInspetionId ?>" >
                                                                        <input type="text" name="jobCardsRepairId" value="<?= $jobCardsRepairId ?>" >
                                                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="returnProduct" onclick="return confirm('Are you sure you want to Return this item?')">Not Used</button>


                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $i++;
                                                                $totalProduct += @$sumProduct;
                                                                $TotalCostProduct += @$sumCostProduct;
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
                                                            <td></td>
                                                            <td><strong><?= $totalProduct ?>
                                                                    <?php
                                                                    $TotalCostProduct;
                                                                    ?>

                                                                </strong></td>
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
                                                        $sqlshowrepair = "SELECT odrp.ReqRepairId,odrp.Qty,rpc.RepairName,rpc.RepairPrice,rpc.RepairCost FROM orderreqrepairs odrp "
                                                                . "LEFT JOIN repaircatergory rpc ON rpc.RepairId=odrp.ReqRepairId WHERE odrp.JobCard_No='$jobCardsRepairId';";
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
                                                                    $RepairId = $rowsrepair['ReqRepairId'];
//                                                            $RepairData = "('$InspectionId','$RepairId','$repairName', $RepairQty, $repairPrice)";
                                                                    ?>
                                                                    <td> 
                                                                        <input type="text" name="repairId" value="<?= $RepairId ?>" >
                                                                        <input type="text" name="JobCardsInspetionId" value="<?= $JobCardsInspetionId ?>" >
                                                                        <input type="text" name="jobCardsRepairId" value="<?= $jobCardsRepairId ?>" >
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
                                        </div>
                                        <div class="card-footer">
                                            <input type="hidden" name="InspectionId" value="<?= $JobCardsInspetionId ?>" >
                                            <button type="submit" name="action" value="complete" class="btn btn-primary ">Job Finish</button>
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
                <div class="card text-dark bg-light  m-1" style="width: 18rem;">
                    <?php
                    $db = dbconn();
                    $sqlRepair = "SELECT RepairId,RepairName FROM repaircatergory WHERE RepairStatus='1'";
                    $resultRepair = $db->query($sqlRepair);
                    ?>
                    <form action="editJobCard.php" method="POST" >
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
                            <input type="hidden" name="JobCardsInspetionId" value="<?= $JobCardsInspetionId; ?>" >
                            <input type="hidden" name="jobCardsRepairId" value="<?= $jobCardsRepairId ?>" >
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
    function loadProducts() {
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
</script>

<?php ob_end_flush(); ?>
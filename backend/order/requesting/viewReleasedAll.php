<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Orders</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="viewReqItems.php" class="btn btn-sm btn-outline-secondary">View Orders</a>
            </div>
        </div>
    </div>
    <h2>Order List</h2>
    <div class="container">
        <div class="row">
            <?php
            extract($_POST);
            if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'edit') {
                $JobCardsInspetionId;
                $JobCardsAppointmentId;
                $jobCardsRepairId;
                $ReleaseItemId;
                if (!empty($JobCardsInspetionId)) {
                    $db = dbconn();
                    $sql = "SELECT ins.InspectionId,ins.InspectionNo,ins.AddDate,ins.Millege,ins.inspectionNotes,"
                            . "cv.vehicleId,cv.registerLetter,cv.RegistrationNo,vc.CatergoryName,u.FirstName,u.LastName,cus.CustomerID,cus.FirstName AS 'CustomerFirstName',cus.LastName AS 'CustomerLastName' FROM inspections ins "
                            . "LEFT JOIN customervehicles cv ON ins.VehicleNo=cv.vehicleId "
                            . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                            . "LEFT JOIN users u ON ins.AddUser=u.UserId "
                            . "LEFT JOIN customer cus ON ins.CustomerName=cus.CustomerID WHERE ins.InspectionId='$JobCardsInspetionId';";
                    $result = $db->query($sql);
                    $row = $result->fetch_assoc();
                    $JobCardsInspetionId = $row['InspectionId'];
                    $customerId = $row['CustomerID'];
                    $VehicleId = $row['vehicleId'];

                    $sql1 = "SELECT id,JobCardNo FROM Job_cards WHERE id = '$jobCardsRepairId'";
                    $result1 = $db->query($sql1);
                    $row1 = $result1->fetch_assoc();
                    $jobCardsRepairId = $row1['id'];
                    $jobCardNo = $row1['JobCardNo'];

                    $sql2 = "SELECT orderNo,Status FROM orders WHERE JobCardNo = '$jobCardsRepairId'";
                    $result2 = $db->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $OrderNo = $row2['orderNo'];
                    $Status = $row2['Status'];

                    $sql3 = "SELECT ReleaseNo,Status FROM relaeseitems WHERE ReleaseItemId = '$ReleaseItemId'";
                    $result3 = $db->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $RelNo = $row3['ReleaseNo'];
                    $RelStatus = $row3['Status'];
                } else {
                    $db = dbconn();
                    echo $sql1 = "SELECT rel.ReleaseItemId,"
                    . "rel.ReleaseNo,"
                    . "rel.AddDate,"
                    . "rel.Status,"
                    . "od.orderNo,"
                    . "jbr.JobCardNo,"
                    . "jbr.id,"
                    . "jbr.AppointmentId,"
                    . "app.AppointmentNo,"
                    . "cus.CustomerID,"
                    . "cus.FirstName,"
                    . "cus.LastName,"
                    . "cv.vehicleId,"
                    . "cv.registerLetter,"
                    . "cv.RegistrationNo FROM relaeseitems rel "
                    . "LEFT JOIN orders od ON rel.OrderId=od.id "
                    . "LEFT JOIN job_cards jbr ON od.JobCardNo=jbr.id "
                    . "LEFT JOIN inspections ins ON rel.InpsectionId=ins.InspectionId "
                    . "LEFT JOIN appointments app ON jbr.AppointmentId=app.AppointmentId "
                    . "LEFT JOIN customer cus ON rel.CustomerName=cus.CustomerID "
                    . "LEFT JOIN customervehicles cv ON rel.VehicleNo=cv.vehicleId "
                    . "WHERE rel.Status='1' AND app.AppointmentId = '$JobCardsAppointmentId';";
                    $result4 = $db->query($sql1);
                    $row4 = $result4->fetch_assoc();
                    $JobCardsAppointmentId = $row4['AppointmentId'];
                    $customerId = $row4['CustomerID'];
                    $VehicleId = $row4['vehicleId'];

                    echo $sql4 = "SELECT id,JobCardNo FROM Job_cards WHERE id = '$jobCardsRepairId'";
                    $result5 = $db->query($sql4);
                    $row5 = $result5->fetch_assoc();
                    $jobCardsRepairId = $row5['id'];
                    $jobCardNo = $row5['JobCardNo'];

                    echo $sql5 = "SELECT orderNo,Status FROM orders WHERE JobCardNo = '$jobCardsRepairId'";
                    $result6 = $db->query($sql5);
                    $row6 = $result6->fetch_assoc();
                    $OrderNo = $row6['orderNo'];
                    $Status = $row6['Status'];

                    $sql6 = "SELECT ReleaseNo,Status FROM relaeseitems WHERE ReleaseItemId = '$ReleaseItemId'";
                    $result7 = $db->query($sql6);
                    $row7 = $result7->fetch_assoc();
                    $RelNo = $row7['ReleaseNo'];
                    $RelStatus = $row7['Status'];
                }
            }
            ?>




            <?php
            if (!empty($JobCardsInspetionId)) {
                ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="col-md-12">
                            <div class="card">
                                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
                                                <h5 class='m-1'style="text-align: center; font-weight: bold;">Release Item Summary - Repair</h5>
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
                                                        <div>
                                                            <p>Order No : <?= $OrderNo ?></p>
                                                        </div>
                                                        <div>
                                                            <p>Release No : <?= $RelNo ?></p>
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
                                                            <p>Job Card No:  <?= $jobCardNo ?></p>
                                                        </div>
                                                        <div>
                                                            <p>Order Status : <?php
                                                                $Status;
                                                                $statusDescription = '';

                                                                switch ($Status) {
                                                                    case 1:
                                                                        $statusDescription = "Order Request Sent";
                                                                        $statusColor = "btn btn-warning btn-sm";
                                                                        break;
                                                                    case 2:
                                                                        $statusDescription = "Items Recieved";
                                                                        $statusColor = "btn btn-success btn-sm";
                                                                        break;
                                                                    default:
                                                                        $statusDescription = "Not Available";
                                                                        $statusColor = "btn btn-secondary btn-sm";
                                                                        break;
                                                                }
                                                                ?>
                                                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p>Release Status : <?php
                                                                $RelStatus;
                                                                $statusDescription = '';

                                                                switch ($RelStatus) {
                                                                    case 1:
                                                                        $statusDescription = "Item Released";
                                                                        $statusColor = "btn btn-primary btn-sm";
                                                                        break;
                                                                    case 0:
                                                                        $statusDescription = "Items Recieved";
                                                                        $statusColor = "btn btn-success btn-sm";
                                                                        break;
                                                                    default:
                                                                        $statusDescription = "Not Available";
                                                                        $statusColor = "btn btn-secondary btn-sm";
                                                                        break;
                                                                }
                                                                ?>
                                                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                                            </p>
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
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            echo $sqlshowproduct = "SELECT rels.Qty,p.ProductName,stk.SerialNo,stk.SalePrice "
                                                            . "FROM relasesubitems rels "
                                                            . "LEFT JOIN products p ON rels.ProductId=p.ProductId "
                                                            . "LEFT JOIN stockitems stk ON rels.StockId=stk.StockId "
                                                            . "WHERE rels.ReleaseItemId='1'";
                                                            $db = dbConn();
                                                            $resultshowproduct = $db->query($sqlshowproduct);
                                                            ?>



                                                            <?php
                                                            $totalProduct = 0;
                                                            if ($resultshowproduct->num_rows > 0) {
                                                                $i = 1;

                                                                while ($rowshowp = $resultshowproduct->fetch_assoc()) {
                                                                    ?><tr>
                                                                        <td><?= $i ?></td>
                                                                        <td><?= $rowshowp['ProductName'] ?></td>
                                                                        <td><?= $rowshowp['SerialNo'] ?></td>
                                                                        <td><?= $ProdcutPrice = $rowshowp['SalePrice'] ?></td>
                                                                        <td><?= $PRoductQty = $rowshowp['Qty'] ?></td>
                                                                        <td><?= @$sumProduct = $PRoductQty * $ProdcutPrice; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                    $totalProduct += @$sumProduct;
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
                                                                <td><strong><?= $totalProduct ?></strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </section>
                                            </div>
                                            <div class="card-footer">
                                                <a href="viewReqItems.php" class="btn btn-sm btn-danger">Close</a>
                                            </div>
                                        </section> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="col-md-12">
                            <div class="card">
                                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
                                                <h5 class='m-1'style="text-align: center; font-weight: bold;">Release Item Summary - Service</h5>
                                                <div class="row">
                                                    <div class="col">
                                                        <div>
                                                            <p> Customer Name : <?= $row4['FirstName'] . ' ' . $row4['LastName']; ?>
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p>Vehicle No : <?= $row4['registerLetter'] . ' - ' . $row4['RegistrationNo']; ?> </p>
                                                        </div>
                                                        <div>
                                                            <p>Order No : <?= $OrderNo ?></p>
                                                        </div>
                                                        <div>
                                                            <p>Release No : <?= $RelNo ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <p> INS Date :  <?= $row4['AddDate'] ?></p>
                                                        </div>
                                                        <div>
                                                            <p> App NO. :<?= $row4['AppointmentNo'] ?></p>
                                                        </div>
                                                        <div>
                                                            <p>Job Card No:  <?= $jobCardNo ?></p>
                                                        </div>
                                                        <div>
                                                            <p>Order Status : <?php
                                                                $Status;
                                                                $statusDescription = '';

                                                                switch ($Status) {
                                                                    case 1:
                                                                        $statusDescription = "Order Request Sent";
                                                                        $statusColor = "btn btn-warning btn-sm";
                                                                        break;
                                                                    case 2:
                                                                        $statusDescription = "Items Recieved";
                                                                        $statusColor = "btn btn-success btn-sm";
                                                                        break;
                                                                    default:
                                                                        $statusDescription = "Not Available";
                                                                        $statusColor = "btn btn-secondary btn-sm";
                                                                        break;
                                                                }
                                                                ?>
                                                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p>Release Status : <?php
                                                                $RelStatus;
                                                                $statusDescription = '';

                                                                switch ($RelStatus) {
                                                                    case 1:
                                                                        $statusDescription = "Item Released";
                                                                        $statusColor = "btn btn-primary btn-sm";
                                                                        break;
                                                                    case 0:
                                                                        $statusDescription = "Items Recieved";
                                                                        $statusColor = "btn btn-success btn-sm";
                                                                        break;
                                                                    default:
                                                                        $statusDescription = "Not Available";
                                                                        $statusColor = "btn btn-secondary btn-sm";
                                                                        break;
                                                                }
                                                                ?>
                                                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                                            </p>
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
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            echo $sqlshowproduct = "SELECT rels.Qty,p.ProductName,stk.SerialNo,stk.SalePrice "
                                                            . "FROM relasesubitems rels "
                                                            . "LEFT JOIN products p ON rels.ProductId=p.ProductId "
                                                            . "LEFT JOIN stockitems stk ON rels.StockId=stk.StockId "
                                                            . "WHERE rels.ReleaseItemId='$ReleaseItemId'";
                                                            $db = dbConn();
                                                            $resultshowproduct = $db->query($sqlshowproduct);
                                                            ?>



                                                            <?php
                                                            $totalProduct = 0;
                                                            if ($resultshowproduct->num_rows > 0) {
                                                                $i = 1;

                                                                while ($rowshowp = $resultshowproduct->fetch_assoc()) {
                                                                    ?><tr>
                                                                        <td><?= $i ?></td>
                                                                        <td><?= $rowshowp['ProductName'] ?></td>
                                                                        <td><?= $rowshowp['SerialNo'] ?></td>
                                                                        <td><?= $ProdcutPrice = $rowshowp['SalePrice'] ?></td>
                                                                        <td><?= $PRoductQty = $rowshowp['Qty'] ?></td>
                                                                        <td><?= @$sumProduct = $PRoductQty * $ProdcutPrice; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                    $totalProduct += @$sumProduct;
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
                                                                <td><strong><?= $totalProduct ?></strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </section>
                                            </div>
                                            <div class="card-footer">
                                                <a href="viewReqItems.php" class="btn btn-sm btn-danger">Close</a>
                                            </div>
                                        </section> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</main>
<?php include'../../footer.php'; ?>

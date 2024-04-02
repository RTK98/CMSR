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
    if ($_SERVER['REQUEST_METHOD'] === "POST" && (@$action == 'edit' || @$action == 'addrepair' || @$action == 'returnProduct' || @$action == 'returnProduct1' || @$action == 'removeRepair' || @$action == 'removeRepair1' || @$action == 'complete' || @$action == 'jobDoneAlert' || @$action == 'jobDoneAlert1')) {
        $jobCardId;
        @$AppointmentId;
        @$InspectionNo;
        $db = dbconn();
        if (!empty($InspectionNo)) {
             $sql = "SELECT ins.InspectionId,ins.InspectionNo,ins.AddDate,ins.Millege,ins.inspectionNotes,"
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

            $sql1 = "SELECT id,JobCardNo FROM Job_cards WHERE id = '$jobCardId'";
            $result1 = $db->query($sql1);
            $row1 = $result1->fetch_assoc();
            $JobCardNo = $row1['JobCardNo'];
        }
        if (!empty($AppointmentId)) {
            $sql = "SELECT ap.AppointmentId,"
                    . "ap.AppointmentNo,"
                    . "ap.AppDate,"
                    . "ap.CustomerID,"
                    . "ap.appointmentStatus,"
                    . "ap.VehicleNo,"
                    . "ap.TimeSlotStart AS 'AppointmentTime',"
                    . "cus.FirstName,"
                    . "cus.LastName,"
                    . "cv.registerLetter,"
                    . "cv.RegistrationNo,"
                    . "cv.Millege,"
                    . "vc.CatergoryName,"
                    . "tms.TimeSlotStart,"
                    . "tms.TimeSlotEnd,"
                    . "sv.ServiceName,"
                    . "vcm.ModelName,"
                    . "cusmob.MobileNo,"
                    . "jb.JobCardNo "
                    . "FROM appointments ap "
                    . "LEFT JOIN customer cus ON ap.CustomerID = cus.CustomerID "
                    . "LEFT JOIN customervehicles cv ON ap.VehicleNo=cv.vehicleId "
                    . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                    . "LEFT JOIN timeslots tms ON ap.TimeSlotStart=tms.TimeSlotId "
                    . "LEFT JOIN service sv ON ap.ServiceType=sv.ServiceId "
                    . "LEFT JOIN vehiclemodels vcm ON cv.VehicleModel=vcm.VehicleModelsId "
                    . "LEFT JOIN customer_mobile cusmob ON ap.CustomerID=cusmob.CustomerID "
                    . "LEFT JOIN job_cards jb ON jb.AppointmentId=ap.AppointmentId "
                    . "WHERE ap.AppointmentId='$AppointmentId'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            $AppDate = $row['AppDate'];
            $AppointmentNo = $row['AppointmentNo'];
            $CustomerID = $row['CustomerID'];
            $VehicleNo = $row['VehicleNo'];
            $CustomerNo = '0' . $row['MobileNo'];
            $TimeSlotStart = $row['AppointmentTime'];
            $Millege = $row['Millege'] . 'KM';
            $JobCardNo = $row['JobCardNo'];
        }
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addrepair') {
        @$jobCardId;
        @$AppointmentId;
        @$InspectionNo;
        $RepairName;
        $QtyRepair;
        $messages = array();
        if (!empty($RepairName)) {
            $db = dbconn();
            $sql = "SELECT * FROM orderreqrepairs WHERE JobCard_No='$jobCardId' AND ReqRepairId='$RepairName'";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                $messages['error_Repair'] = "The Repair Already Exists!";
            }
        }
        if (empty($messages)) {
            $addeduser = $_SESSION['userId'];
            $adddate = date("Y-m-d");
            $db = dbConn();
            $sqladdreqRepair = "INSERT INTO orderreqrepairs(JobCard_No, ReqRepairId,Qty, AddDate,AddUser) VALUES ('$jobCardId','$RepairName','$QtyRepair','$adddate','$addeduser')";
            $resultaddReqRepair = $db->query($sqladdreqRepair);
        }
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'removeRepair') {
        $jobCardId;
        $AppointmentId;
        $InspectionNo;
        $repairId;
        $db = dbConn();
        $sqlDelreqRepair = "DELETE FROM orderreqrepairs WHERE id='$repairId'";

        $resultDelReqRepair = $db->query($sqlDelreqRepair);
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'removeRepair1') {
        $jobCardId;
        $AppointmentId;
        $InspectionNo;
        $repairId;
        $db = dbConn();
        $sqlDelreqRepair = "DELETE FROM orderreqrepairs WHERE id='$repairId'";

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
         $sqlUpdateItems = "UPDATE jobcardtempitemsrepair SET Status='0' WHERE StockId='$ProductId'";
        $db->query($sqlUpdateItems);

         $sqlUpdateItems = "INSERT INTO retunitemstock(JobCardId,StockIid, AddUser, AddDate,Status) VALUES ("
        . "'$jobCardsRepairId','$ProductId','$addeduser','$adddate','1')";
        $db->query($sqlUpdateItems);
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'returnProduct1') {
        $jobCardId;
        $ProductId;

        $addeduser = $_SESSION['userId'];
        $adddate = date("Y-m-d");

        $db = dbConn();
         $sqlUpdateItems = "UPDATE jobcardtempitemsrepair SET Status='0' WHERE StockId='$ProductId'";
        $db->query($sqlUpdateItems);

         $sqlUpdateItems = "INSERT INTO retunitemstock(JobCardId,StockIid, AddUser, AddDate,Status) VALUES ("
        . "'$jobCardId','$ProductId','$addeduser','$adddate','1')";
        $db->query($sqlUpdateItems);
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'jobDoneAlert') {
        $jobCardId;
        $ProductId;
        $AppointmentId;

        $addeduser = $_SESSION['userId'];
        $adddate = date("Y-m-d");
        $addTime = date("H:i");

        $db = dbConn();
         $sqlUpdatejobCard = "UPDATE job_cards SET JobCardAlertUpdate='1' WHERE id='$jobCardId'";
        $db->query($sqlUpdatejobCard);

         $sqlUpdatedAlert = "INSERT INTO jobcardalerts(JObCardId,AppointmentId,Status,AddUser,AddDate,AddTime) VALUES "
        . "('$jobCardId','$AppointmentId','1','$addeduser','$adddate','$addTime')";
        $db->query($sqlUpdatedAlert);
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'jobDoneAlert1') {
        $jobCardId;
        $ProductId;
        $InspectionNo;

        $addeduser = $_SESSION['userId'];
        $adddate = date("Y-m-d");
        $addTime = date("H:i");

        $db = dbConn();
         $sqlUpdatejobCard = "UPDATE job_cards SET JobCardAlertUpdate='1' WHERE id='$jobCardId'";
        $db->query($sqlUpdatejobCard);

         $sqlUpdatedAlert = "INSERT INTO jobcardalerts(JObCardId,InspectionId,Status,AddUser,AddDate,AddTime) VALUES "
        . "('$jobCardId','$InspectionNo','1','$addeduser','$adddate','$addTime')";
        $db->query($sqlUpdatedAlert);
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

                 $sqlestimateinsert = "INSERT INTO orderitems(OrderId, ProductId,Qty, AddUser,AddDate) VALUES ('$OrderId','$addedproductid','$addedproductqty','$addeduser','$AddDate')";
                $resultaEstimateInsert = $db->query($sqlestimateinsert);
                ?>
                <?php
            }
        }
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4" >
                <div class="card">
                    <div class="col-md-12">
                        <div class="card">
                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <?php if (@$AppointmentId) { ?>
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
                                                    <h4 class='m-1'style="text-align: center; font-weight: bold;">Appointment Details</h4>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div>
                                                            <p> Customer Name : <?= $row['FirstName'] . ' ' . $row['LastName']; ?>
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p>Vehicle No : <?= $row['registerLetter'] . ' - ' . $row['RegistrationNo']; ?> </p>
                                                        </div>
                                                        <div>
                                                            <p>Vehicle Type : <?= $row['CatergoryName']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p>Service Type : <?= $row['ServiceName']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <p> Appointment Date :  <?= $row['AppDate']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p> Appointment NO. : <?= $row['AppointmentNo']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p>Vehicle Model : <?= ucwords($row['ModelName']); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                <?php } ?>
                                <!--                                meka appointment eka setnam penne-->

                                <?php if (@$InspectionNo) { ?>
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
                                                    <h4 class='m-1'style="text-align: center; font-weight: bold;">Inspection Report (Customer Selected)</h4>
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
                                <?php } ?>
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

                            <?php if (@$AppointmentId) { ?>
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
                                            <h5 class='m-1'style="text-align: center; font-weight: bold;">Job Card - Service</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <p> Customer Name : <?= $row['FirstName'] . ' ' . $row['LastName']; ?>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>Vehicle No : <?= $row['registerLetter'] . ' - ' . $row['RegistrationNo']; ?> </p>
                                                    </div>
                                                    <div>
                                                        <p>Vehicle Type : <?= $row['CatergoryName']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Millage : <?= $Millege ?></p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <p> Appointment Date :  <?= $row['AppDate']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p> Appointment NO. : <?= $row['AppointmentNo']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Technician Name :  <?= $row['FirstName'] . ' ' . $row['LastName']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Job Card No: <?= $JobCardNo ?></p>
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
                                                                . " WHERE jbtmp.JobCardId= '$jobCardId' AND jbtmp.Status='1';";
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
                                                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                            <?php
                                                                            echo $ProductId = $rowshowp['StockId'];
                                                                            ?>
                                                                            <input type="hidden" name="ProductId" value="<?= $ProductId ?>" >
                                                                            <input type="hidden" name="jobCardId" value="<?= $jobCardId ?>" >
                                                                            <button type="submit" class="btn btn-danger btn-sm" name="action" value="returnProduct" onclick="return confirm('Are you sure you want to Return this item?')">Not Used</button>

                                                                        </form>
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
                                                         $sqlshowrepair = "SELECT odrp.id,odrp.ReqRepairId,odrp.Qty,rpc.RepairName,rpc.RepairPrice,rpc.RepairCost FROM orderreqrepairs odrp "
                                                        . "LEFT JOIN repaircatergory rpc ON rpc.RepairId=odrp.ReqRepairId WHERE odrp.JobCard_No='$jobCardId';";
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
                                                                    $RepairId = $rowsrepair['id'];
//                                                            $RepairData = "('$InspectionId','$RepairId','$repairName', $RepairQty, $repairPrice)";
                                                                    ?>
                                                                    <td> 
                                                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                            <input type="hidden" name="repairId" value="<?= @$RepairId ?>" >
                                                                            <input type="hidden" name="AppointmentId" value="<?= @$AppointmentId ?>" >
                                                                            <input type="hidden" name="jobCardId" value="<?= $jobCardId ?>" >
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
                                                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                    <div class="card-footer">
                                                        <input type="hidden" name="repairId" value="<?= @$RepairId ?>" >
                                                        <input type="hidden" name="AppointmentId" value="<?= $AppointmentId ?>" >
                                                        <input type="hidden" name="jobCardId" value="<?= $jobCardId ?>" >
                                                        <button type="submit" class="btn btn-success btn-sm" name="action" value="jobDoneAlert" onclick="return confirm('Are you sure you want to complete this job card?')">Job Finish</button>
                                                    </div>
                                                </form>
                                            </section>
                                        </div>
                                    </section> 
                                </div>
                            <?php }
                            ?>
                            <?php if (@$InspectionNo) { ?>
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
                                                        <p>Job Card No:  <?= $JobCardNo ?></p>
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
                                                                . " WHERE jbtmp.JobCardId= '$jobCardId' AND jbtmp.Status='1';";
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
                                                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                            <?php
                                                                            echo $ProductId = $rowshowp['StockId'];
                                                                            ?>
                                                                            <input type="hidden" name="ProductId" value="<?= $ProductId ?>" >
                                                                            <input type="hidden" name="InspectionNo" value="<?= $InspectionNo ?>" >
                                                                            <input type="hidden" name="jobCardId" value="<?= $jobCardId ?>" >
                                                                            <button type="submit" class="btn btn-danger btn-sm" name="action" value="returnProduct1" onclick="return confirm('Are you sure you want to Return this item?')">Not Used</button>
                                                                        </form>

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
                                                                . "LEFT JOIN repaircatergory rpc ON rpc.RepairId=odrp.ReqRepairId WHERE odrp.JobCard_No='$jobCardId';";
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
                                                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                            <input type="text" name="repairId" value="<?= $RepairId ?>" >
                                                                            <input type="text" name="InspectionNo" value="<?= $InspectionNo ?>" >
                                                                            <input type="text" name="jobCardId" value="<?= $jobCardId ?>" >
                                                                            <button type="submit" class="btn btn-danger btn-sm" name="action" value="removeRepair1" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>
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
                                                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                    <div class="card-footer">
                                                        <input type="text" name="repairId" value="<?= @$RepairId ?>" >
                                                        <input type="text" name="InspectionNo" value="<?= @$InspectionNo ?>" >
                                                        <input type="text" name="jobCardId" value="<?= $jobCardId ?>" >
                                                        <button type="submit" class="btn btn-success btn-sm" name="action" value="jobDoneAlert1" onclick="return confirm('Are you sure you want to complete this job card?')">Job Finish</button>
                                                    </div>
                                                </form>
                                            </section>
                                        </div>
                                    </section> 
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--        item Ordering-->
            <div class="col-md-3">
                <div class="card text-dark bg-light  m-1" style="width: 18rem;">
                    <div class="text-danger"><?= @$messages['error_Repair']; ?></div>
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
                            <?php if (@$AppointmentId) { ?>
                                <input type="hidden" name="jobCardId" value="<?= @$jobCardId; ?>" >
                                <input type="hidden" name="AppointmentId" value="<?= @$AppointmentId ?>" >
                                <button type="submit" name="action" value="addrepair" class="btn btn-dark ">Add Repair</button>
                            <?php } else { ?>
                                <input type="hidden" name="jobCardId" value="<?= @$jobCardId; ?>" >
                                <input type="hidden" name="InspectionNo" value="<?= @$InspectionNo ?>" >
                                <button type="submit" name="action" value="addrepair" class="btn btn-dark ">Add Repair</button>
                            <?php } ?>
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
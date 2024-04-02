<?php ob_start(); ?>
<?php
include'../header.php';
include'../menu.php';
include'rand.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Job Card Details</h1>
    </div>
    <hr>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && (@$action == 'edit' || @$action == 'returnProduct' || @$action == 'removeRepair' || @$action == 'complete')) {
        $jobCardId;
        @$AppointmentId;
        @$InspectionNo;
        $db = dbconn();
        if (!empty($InspectionNo)) {
            $sql = "SELECT ins.InspectionId,"
                    . "ins.InspectionNo,"
                    . "ins.AddDate,"
                    . "ins.Millege,"
                    . "ins.inspectionNotes,"
                    . "cv.vehicleId,"
                    . "cv.registerLetter,"
                    . "cv.RegistrationNo,"
                    . "vc.CatergoryName,"
                    . "u.FirstName,"
                    . "u.LastName,"
                    . "cus.CustomerID,"
                    . "cus.FirstName AS 'CustomerFirstName',"
                    . "cus.LastName AS 'CustomerLastName' "
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
                    . "jb.JobCardNo,"
                    . "jb.NextServiceDate,"
                    . "jb.NextServiceMillege,"
                    . "tsk.TaskId "
                    . "FROM appointments ap "
                    . "LEFT JOIN customer cus ON ap.CustomerID = cus.CustomerID "
                    . "LEFT JOIN customervehicles cv ON ap.VehicleNo=cv.vehicleId "
                    . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                    . "LEFT JOIN timeslots tms ON ap.TimeSlotStart=tms.TimeSlotId "
                    . "LEFT JOIN service sv ON ap.ServiceType=sv.ServiceId "
                    . "LEFT JOIN vehiclemodels vcm ON cv.VehicleModel=vcm.VehicleModelsId "
                    . "LEFT JOIN customer_mobile cusmob ON ap.CustomerID=cusmob.CustomerID "
                    . "LEFT JOIN job_cards jb ON jb.AppointmentId=ap.AppointmentId "
                    . "LEFT JOIN tasks tsk ON tsk.Job_cardId=jb.id "
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
            $TaskId = $row['TaskId'];
        }
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'complete') {
        $jobCardId; //status =6
        $RepairCost;
        $jobTotalRepair;
        $TotalCostProduct;
        $jobTotalProduct;
        $jobTotalCostProduct;
        $TotalProductAmount;
        $sumOfJobCard;
        $jobTotalRepairCost;
        $AppointmentId; //meka status=3
        $TaskId; //status=3

        $addeduser = $_SESSION['userId'];
        $AddDate = date('Y-m-d');
        $timestamp = date('H:i');

        $db = dbConn();

        $sqlUpdateJobCard = "UPDATE job_cards SET JobCardCost='$TotalCostProduct',JobCardPrice='$sumOfJobCard',TotalProductsCost='$jobTotalCostProduct',"
                . "TotalProductAmount='$TotalProductAmount',TotalRepairCost='$jobTotalRepairCost',TotalRepairProfit='$jobTotalRepair',JobCardAlertUpdate='2',Status='6' WHERE id='$jobCardId' ";
        $resultUpdateJobCard = $db->query($sqlUpdateJobCard);

        $sqlAddproduct = "SELECT jbtmp.OrderId,"
                . "jbtmp.Qty,"
                . "jbtmp.Status,"
                . "jbtmp.StockId,"
                . "p.ProductId,"
                . "p.ProductName,"
                . "s.StockId,"
                . "s.SerialNo,"
                . "s.Cost,"
                . "s.SalePrice "
                . "FROM jobcardtempitemsrepair jbtmp "
                . "LEFT JOIN products p ON jbtmp.ProductId=p.ProductId "
                . "LEFT JOIN stockitems s ON jbtmp.StockId=s.StockId"
                . " WHERE jbtmp.JobCardId= '$jobCardId' AND jbtmp.Status='1'";
        $db = dbConn();
        $resultAddproduct = $db->query($sqlAddproduct);
        ?>
        <?php
        if ($resultAddproduct->num_rows > 0) {
            while ($rowOderProduct = $resultAddproduct->fetch_assoc()) {
                ?>


                <?php
                $addedproductid = $rowOderProduct['ProductId'];
                $addedproductqty = $rowOderProduct['Qty'];
                $addedproductCost = $rowOderProduct['Cost'];
                $addedproductSalePrice = $rowOderProduct['SalePrice'];
                $addedproductStockId = $rowOderProduct['StockId'];
                $addedproductSerialNo = $rowOderProduct['SerialNo'];

                $sqlorders = "INSERT INTO job_carditems(JobCardId,AddDate,AddUser,Status,ProductId,StockId,SerialNo,ProductQty,ProductCost,ProductAmount) "
                        . "VALUES ('$jobCardId','$AddDate','$addeduser','1','$addedproductid','$addedproductStockId','$addedproductSerialNo','$addedproductqty','$addedproductCost','$addedproductSalePrice')";
                $resultsOrder = $db->query($sqlorders);
                ?>
                <?php
            }
        }
        $sqlshowrepair = "SELECT odrp.ReqRepairId,"
                . "odrp.Qty,"
                . "rpc.RepairName,"
                . "rpc.RepairPrice,"
                . "rpc.RepairCost FROM orderreqrepairs odrp "
                . "LEFT JOIN repaircatergory rpc ON rpc.RepairId=odrp.ReqRepairId "
                . "WHERE odrp.JobCard_No='$jobCardId'";
        $db = dbConn();
        $resultsrepair = $db->query($sqlshowrepair);
        ?>
        <?php
        if ($resultsrepair->num_rows > 0) {
            while ($rowRepair = $resultsrepair->fetch_assoc()) {
                ?>


                <?php
                $addedReqRepairId = $rowRepair['ReqRepairId'];
                $addedRepairCost = $rowRepair['RepairCost'];
                $addedQty = $rowRepair['Qty'];
                $addedRepairPrice = $rowRepair['RepairPrice'];

                $sqljobItems = "INSERT INTO job_carditems(JobCardId,AddDate,AddUser,Status,RepairId,RepairCost,Qty,Amount) "
                        . "VALUES ('$jobCardId','$AddDate','$addeduser','1','$addedReqRepairId','$addedRepairCost','$addedQty','$addedRepairPrice')";
                $resultsJobItems = $db->query($sqljobItems);
                ?>
                <?php
            }
        }
        $sqlUpApp = "UPDATE appointments SET appointmentStatus='3',UpdateUser='$addeduser',UpdateDate='$AddDate' WHERE appointmentId='$AppointmentId'";
        $resultsapp = $db->query($sqlUpApp);

        $sqlUpTask = "UPDATE tasks SET Status='3', FinishedDate='$AddDate',FinishedTime='$timestamp',FinishedUser='$addeduser' WHERE TaskId='$TaskId'";
        $resultsTask = $db->query($sqlUpTask);
        ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Job Card Completed Successfully',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'viewJobCardSupervisor.php'; // Redirect to success page
            });
            </script>
    <?php }
    ?>





    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'complete1') {
        $jobCardId; //status =6
        $RepairCost;
        $ProductCost;
        $AppointmentId; //meka status =3
        $TaskId;

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
                $addedproductid = $rowOderProduct['ProductId'];
                $addedproductqty = $rowOderProduct['Qty'];

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
            <div class="col-md-6" >
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

                                <?php if ($InspectionNo) { ?>
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
                                                            echo '<td style = "background-color: #d2d2d2">' . $n . '</td>';
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

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <?php if (@$AppointmentId) { ?>
                                    <div class="card-body" id='report'>
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
                                                <h5 class='m-1'style="text-align: center; font-weight: bold;">Bill - Service</h5>
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
                                                        <div>
                                                            <p>Next Service Millege:<span style='color:red;font-weight: bold;'> <?= $row['NextServiceMillege'] . 'KM' ?></span> </p>
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
                                                            <p>Job Card No: <?= $JobCardNo ?> </p>
                                                        </div>
                                                        <div>
                                                            <p>Next Service Date:<span style='color:red;font-weight: bold;'>  <?= $row['NextServiceDate'] ?></span> </p>
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
                                                            $sqlshowproduct = "SELECT jbtmp.OrderId,"
                                                                    . "jbtmp.Qty,"
                                                                    . "jbtmp.Status,"
                                                                    . "jbtmp.StockId,"
                                                                    . "p.ProductId,"
                                                                    . "p.ProductName,"
                                                                    . "s.StockId,"
                                                                    . "s.SerialNo,"
                                                                    . "s.Cost,"
                                                                    . "s.SalePrice "
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
                                                                        <td><?= ucwords($rowshowp['ProductName']) ?></td>
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
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                    $totalProduct += @$sumProduct;
                                                                    $jobTotalProduct = $totalProduct;

                                                                    $TotalCostProduct += @$sumCostProduct;
                                                                    $jobTotalCostProduct = $TotalCostProduct;
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
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sqlshowrepair = "SELECT odrp.ReqRepairId,"
                                                                    . "odrp.Qty,"
                                                                    . "rpc.RepairName,"
                                                                    . "rpc.RepairPrice,"
                                                                    . "rpc.RepairCost FROM orderreqrepairs odrp "
                                                                    . "LEFT JOIN repaircatergory rpc ON rpc.RepairId=odrp.ReqRepairId "
                                                                    . "WHERE odrp.JobCard_No='$jobCardId'";
                                                            $db = dbConn();
                                                            $resultsrepair = $db->query($sqlshowrepair);
                                                            ?> 
                                                            <?php
                                                            $totalRepair = 0;
                                                            $totalCostRepair = 0;
                                                            if ($resultsrepair->num_rows > 0) {
                                                                $i = 1;
                                                                while ($rowsrepair = $resultsrepair->fetch_assoc()) {
                                                                    ?><tr>
                                                                        <td><?= $i ?></td>
                                                                        <td><?= $repairName = $rowsrepair['RepairName'] ?></td>    
                                                                        <td><?= $RepairQty = $rowsrepair['Qty'] ?></td>
                                                                        <td><?= $repairPrice = $rowsrepair['RepairPrice'] ?></td>
                                                                        <?php
                                                                        $RepairCost = $rowsrepair['RepairCost'];
                                                                        ?>
                                                                        <td><?= @$sumeRepair = $RepairQty * $repairPrice; ?></td>
                                                                        <?php
                                                                        @$sumCostRepair = $RepairQty * $RepairCost;
                                                                        ?>
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                    $totalRepair += $sumeRepair;
                                                                    $jobTotalRepair = $totalRepair;
                                                                    $totalCostRepair += $sumCostRepair;
                                                                    $jobTotalRepairCost = $totalCostRepair;
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
                                                                <td><strong><?= $totalRepair ?>
                                                                        <?php
                                                                        $totalCostRepair;
                                                                        ?>



                                                                    </strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Grand Total</strong></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><strong><?= $totalProduct += $totalRepair ?>
                                                                        <?php $sumOfJobCard = $totalProduct; ?>
                                                                        <?php
                                                                        $TotalCostProduct += $totalCostRepair
                                                                        ?>


                                                                    </strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-secondary" onclick="printReport('report')">Print</button>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-dark" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
                                                    </div>
                                                </section>
                                            </div>
                                        </section> 
                                    </div>
                                <?php }
                                ?>
                                <?php if ($InspectionNo) { ?>
                                    <div class="card-body" id='report'>
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
                                                <h5 class='m-1'style="text-align: center; font-weight: bold;">Bill - Repair</h5>
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
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-secondary" onclick="printReport('report')">Print</button>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-dark" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
                                                    </div>
                                                </section>
                                            </div>
                                        </section> 
                                    </div>
                                    <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--        item Ordering-->
        </div>
    </div>
</main>
<?php include'../footer.php'; ?>
<script>
    function printReport(divid) {
        var divToPrint = document.getElementById(divid);

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);
    }
    var doc = new jsPDF();
    function exportReport(divId, title) {
        doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
        doc.save('div.pdf');
    }
</script>
<?php ob_end_flush(); ?>
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
                    . "cus.LastName AS 'CustomerLastName',"
                    . "tsk.TaskId FROM inspections ins "
                    . "LEFT JOIN customervehicles cv ON ins.VehicleNo=cv.vehicleId "
                    . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                    . "LEFT JOIN users u ON ins.AddUser=u.UserId "
                    . "LEFT JOIN customer cus ON ins.CustomerName=cus.CustomerID "
                    . "LEFT JOIN job_cards jb ON ins.InspectionId=jb.Inspectionid "
                    . "LEFT JOIN tasks tsk ON jb.id=tsk.Job_cardId "
                    . "WHERE ins.InspectionId='$InspectionNo';";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            $JobCardsInspetionId = $row['InspectionId'];
            $customerId = $row['CustomerID'];
            $VehicleId = $row['vehicleId'];
            $TaskId = $row['TaskId'];

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
        $NexrMillege;
        $ServiceDate;
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
                . "TotalProductAmount='$TotalProductAmount',NextServiceDate='$ServiceDate',NextServiceMillege='$NexrMillege',TotalRepairCost='$jobTotalRepairCost',TotalRepairProfit='$jobTotalRepair',JobCardAlertUpdate='2',Status='6' WHERE id='$jobCardId' ";
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
        $jobTotalRepair;
        $TotalCostProduct;
        $jobTotalProduct;
        $jobTotalCostProduct;
        $TotalProductAmount;
        $sumOfJobCard;
        $jobTotalRepairCost;
        $InspectionNo; //meka status=5
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
        $sqlUpApp = "UPDATE inspections SET Status='5',UpdateUser='$addeduser',UpdateDate='$AddDate' WHERE InspectionId='$InspectionNo'";
        $resultsapp = $db->query($sqlUpApp);

        $sqlUpTask = "UPDATE tasks SET Status='3', FinishedDate='$AddDate',FinishedTime='$timestamp',FinishedUser='$addeduser' WHERE TaskId='$TaskId'";
        $resultsTask = $db->query($sqlUpTask);

        $sqlUpJbAlert = "UPDATE jobcardalerts SET Status='2', UpdateDate='$AddDate',UpdateTime='$timestamp',UpdateUser='$addeduser' WHERE TaskId='$TaskId'";
        $resultsUpJbAlert = $db->query($sqlUpJbAlert);
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
                                                            <p>Millage : <?= $row['Millege'] . 'KM'; ?></p>
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
                                                        <div>
                                                            <label for="NexrMillege" class="form-label">Next Service Millege (KM.)</label>
                                                            <input type="number" class="form-control" min='0' id="NexrMillege" name="NexrMillege">
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
                                                            <?php
                                                            $maxDate = date("Y-m-d", strtotime("+90 days"));
                                                            ?>
                                                            <label for="ServiceDate" class="form-label">Next Service Date</label>
                                                            <input type="date" class="form-control" id="ServiceDate" min="<?= $maxDate ?>" name="ServiceDate">
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
                                                </section>
                                            </div>
                                            <div class="card-footer">

                                                <input type="hidden" name="RepairCost" value="<?= @$RepairCost ?>" >
                                                <input type="hidden" name="jobTotalRepair" value="<?= $jobTotalRepair ?>" >
                                                <input type="hidden" name="jobTotalCostProduct" value="<?= $jobTotalCostProduct ?>" >
                                                <input type="hidden" name="TotalCostProduct" value="<?= $TotalCostProduct ?>" >
                                                <input type="hidden" name="TotalProductAmount" value="<?= $jobTotalProduct ?>" >
                                                <input type="hidden" name="sumOfJobCard" value="<?= $sumOfJobCard ?>" >
                                                <input type="hidden" name="AppointmentId" value="<?= $AppointmentId ?>" >
                                                <input type="hidden" name="jobTotalRepairCost" value="<?= $jobTotalRepairCost ?>" >
                                                <input type="hidden" name="jobCardId" value="<?= $jobCardId ?>" >
                                                <input type="hidden" name="TaskId" value="<?= $TaskId ?>" >
                                                <button type="submit" name="action" value="complete" class="btn btn-primary ">Job Finish</button>
                                            </div>
                                        </section> 
                                    </div>
                                <?php }
                                ?>
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
                                                            <p>Millage : <?= $row['Millege'] . 'KM'; ?></p>
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
                                                                    . "odrp.Qty,rpc.RepairName,"
                                                                    . "rpc.RepairPrice,"
                                                                    . "rpc.RepairCost FROM orderreqrepairs odrp "
                                                                    . "LEFT JOIN repaircatergory rpc ON rpc.RepairId=odrp.ReqRepairId "
                                                                    . "WHERE odrp.JobCard_No='$jobCardId';";
                                                            $db = dbConn();
                                                            $resultsrepair = $db->query($sqlshowrepair);
//                                            $rowsrepair = $resultsrepair->fetch_assoc();
//                                            var_dump($rowsrepair);
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
//                                                            $RepairData = "('$InspectionId','$RepairId','$repairName', $RepairQty, $repairPrice)";
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
                                                                        echo $totalCostRepair;
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
                                                                        echo $TotalCostProduct += $totalCostRepair
                                                                        ?> 
                                                                    </strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </section>
                                            </div>
                                            <div class="card-footer">
                                                <input type="text" name="RepairCost" value="<?= @$RepairCost ?>" >
                                                <input type="text" name="jobTotalRepair" value="<?= $jobTotalRepair ?>" >
                                                <input type="text" name="jobTotalCostProduct" value="<?= $jobTotalCostProduct ?>" >
                                                <input type="text" name="TotalCostProduct" value="<?= $TotalCostProduct ?>" >
                                                <input type="text" name="TotalProductAmount" value="<?= $jobTotalProduct ?>" >
                                                <input type="text" name="sumOfJobCard" value="<?= $sumOfJobCard ?>" >
                                                <input type="text" name="InspectionNo" value="<?= @$InspectionNo ?>" >
                                                <input type="text" name="jobTotalRepairCost" value="<?= $jobTotalRepairCost ?>" >
                                                <input type="text" name="jobCardId" value="<?= $jobCardId ?>" >
                                                <input type="text" name="TaskId" value="<?= $TaskId ?>" >
                                                <button type="submit" name="action" value="complete1" class="btn btn-primary ">Job Finish</button>
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

<?php ob_end_flush(); ?>
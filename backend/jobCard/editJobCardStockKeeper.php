<?php ob_start(); ?>
<?php
include'../header.php';
include'../menu.php';
include'rand.php';
?>
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
//                        print_r($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && (@$action == 'release' || @$action == 'addproduct' || @$action == 'addproduct1' || @$action == 'removeProduct' || @$action == 'removeProduct1' || @$action == 'addOrder' || @$action == 'addOrder1' )) {
                            $OrderId;
                            $JobCardId;
                            $stockIdz;
                            @$Inspectionid;
                            @$AppointmentId;
                            $db = dbconn();
//                            $sqlSelectNo = "SELECT AppointmentId,Inspectionid FROM job_cards WHERE id='$JobCardId'";
//                            $resultAppNoInsNO = $db->query($sqlSelectNo);
//                            $rowNo = $resultAppNoInsNO->fetch_assoc();
//                            @$AppointmentId = $rowNo['AppointmentId'];
//                            @$Inspectionid = $rowNo['Inspectionid'];

                            if (!empty($Inspectionid)) {
                                $sql = "SELECT ins.InspectionId,ins.InspectionNo,ins.AddDate,ins.Millege,ins.inspectionNotes,"
                                        . "cv.vehicleId,cv.registerLetter,cv.RegistrationNo,vc.CatergoryName,u.FirstName,u.LastName,cus.CustomerID,cus.FirstName AS 'CustomerFirstName',cus.LastName AS 'CustomerLastName' "
                                        . "FROM inspections ins "
                                        . "LEFT JOIN customervehicles cv ON ins.VehicleNo=cv.vehicleId "
                                        . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                                        . "LEFT JOIN users u ON ins.AddUser=u.UserId "
                                        . "LEFT JOIN customer cus ON ins.CustomerName=cus.CustomerID WHERE InspectionId='$Inspectionid';";
                                $result = $db->query($sql);
                                $row = $result->fetch_assoc();
                                $JobCardsInspetionId = $row['InspectionId'];
                                $customerId = $row['CustomerID'];
                                $VehicleId = $row['vehicleId'];

                                $sql1 = "SELECT id,JobCardNo FROM Job_cards WHERE id = '$JobCardId'";
                                $result1 = $db->query($sql1);
                                $row1 = $result1->fetch_assoc();
                                $JobCardNo = $row1['JobCardNo'];
                            }
                            if (!empty($AppointmentId)) {
                                $sql = "SELECT "
                                        . "ap.AppointmentId,"
                                        . "ap.AppointmentNo,"
                                        . "ap.AppDate,"
                                        . "ap.CustomerID,"
                                        . "ap.appointmentStatus,"
                                        . "ap.VehicleNo,"
                                        . "ap.TimeSlotStart AS 'AppointmentTime'"
                                        . ",cus.FirstName,"
                                        . "cus.LastName,"
                                        . "cv.registerLetter,"
                                        . "cv.RegistrationNo,"
                                        . "vc.CatergoryName,"
                                        . "tms.TimeSlotStart,"
                                        . "tms.TimeSlotEnd,"
                                        . "sv.ServiceName,"
                                        . "vcm.ModelName,"
                                        . "cusmob.MobileNo "
                                        . "FROM appointments ap "
                                        . "LEFT JOIN customer cus ON ap.CustomerID = cus.CustomerID "
                                        . "LEFT JOIN customervehicles cv ON ap.VehicleNo=cv.vehicleId "
                                        . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                                        . "LEFT JOIN timeslots tms ON ap.TimeSlotStart=tms.TimeSlotId "
                                        . "LEFT JOIN service sv ON ap.ServiceType=sv.ServiceId  "
                                        . "LEFT JOIN vehiclemodels vcm ON cv.VehicleModel=vcm.VehicleModelsId "
                                        . "LEFT JOIN customer_mobile cusmob ON ap.CustomerID=cusmob.CustomerID WHERE ap.AppointmentId='$AppointmentId'";
                                $result = $db->query($sql);
                                $row = $result->fetch_assoc();
                                $AppDate = $row['AppDate'];
                                $AppointmentNo = $row['AppointmentNo'];
                                $CustomerID = $row['CustomerID'];
                                $VehicleNo = $row['VehicleNo'];
                                $CustomerNo = '0' . $row['MobileNo'];
                                $TimeSlotStart = $row['AppointmentTime'];
                            }

                            $sql2 = "SELECT ord.orderNo,"
                                    . "ord.JobCardNo,"
                                    . "ord.AddDate,"
                                    . "ord.AddUser,"
                                    . "ord.Status,"
                                    . "ord.id,"
                                    . "ord.VehicleNo,"
                                    . "ord.CustomerName,"
                                    . "cus.FirstName,"
                                    . "cus.LastName,"
                                    . "cv.registerLetter,"
                                    . "cv.RegistrationNo,"
                                    . "vc.CatergoryName,"
                                    . "u.UserId,"
                                    . "u.FirstName AS 'UserFirstName',"
                                    . "u.LastName AS 'UserLastName',"
                                    . "jbc.JobCardNo AS 'JobCardNumber' "
                                    . "FROM orders ord LEFT JOIN customer cus ON ord.CustomerName=cus.CustomerID "
                                    . "LEFT JOIN customervehicles cv ON ord.VehicleNo=cv.vehicleId "
                                    . "LEFT JOIN job_cards jbc ON ord.JobCardNo=jbc.id "
                                    . "LEFT JOIN users u ON ord.AddUser=u.UserId "
                                    . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                                    . "WHERE ord.JobCardNo='$JobCardId' AND ord.id='$OrderId'";
                            $result2 = $db->query($sql2);
                            $row2 = $result2->fetch_assoc();
                        }
                        ?>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addproduct') {
                            $OrderId;
                            $JobCardId;
                            $ProductName;
                            $QtyProduct = inputTrim($QtyProduct);
                            $messages = array();

                            if (empty($QtyProduct)) {
                                $messages['error_Product_qty'] = "The Product Qty should not be Blank..!";
                            }
                            if (!empty($ProductName)) {
                                $db = dbconn();
                                $sql = "SELECT * FROM products WHERE ProductId='$ProductName' AND Qty = 0; ";
                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    $messages['error_Product_size'] = "The Product is Out Of stock!";
                                }
                            }
                            if (!empty($ProductName)) {
                                $addeduser = $_SESSION['userId'];
                                $adddate = date("Y-m-d");
                                $db = dbconn();
                                $sqlFindStockId = "SELECT * FROM stockitems si WHERE si.ProductName='$ProductName' AND si.Status='1' AND si.ExpDate != '$adddate' AND si.ExpDate > '$adddate' ORDER BY si.AddDate ASC LIMIT 1;";
                                $resultStockId = $db->query($sqlFindStockId);
                                $rowStock = $resultStockId->fetch_assoc();
                                $stockId = $rowStock['StockId'];

                                $sql = "SELECT * FROM orderreleaseitem WHERE StockId='$stockId' AND JobCard = '$JobCardId'";
                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    $messages['error_Product'] = "The item is already issued...!";
                                }
                            }

                            if (empty($messages)) {
                                $JobCardId;
                                $addeduser = $_SESSION['userId'];
                                $adddate = date("Y-m-d");

                                $sqlFindStockId = "SELECT * FROM stockitems si WHERE si.ProductName='$ProductName' AND si.Status='1' AND si.ExpDate != '$adddate' AND si.ExpDate > '$adddate' ORDER BY si.AddDate ASC LIMIT 1;";
                                $resultStockId = $db->query($sqlFindStockId);
                                $rowStock = $resultStockId->fetch_assoc();
                                $stockId = $rowStock['StockId'];
                                $sqlUpdateStock = "UPDATE stockitems SET Status='0',UpdateUser='$addeduser',UpdateDate='$adddate' WHERE StockId='$stockId' AND ProductName='$ProductName'";
                                $resultUpdateStock = $db->query($sqlUpdateStock);

                                $sqlProductQty = "SELECT UpdateDate,UpdateUser,IssuedQty,Qty FROM Products WHERE ProductId='$ProductName'";
                                $result = $db->query($sqlProductQty);
                                $rowProductQty = $result->fetch_assoc();
                                $ProductQty = $rowProductQty['Qty'];
                                if ($ProductQty == 0) {
                                    
                                } else {
                                    $IssuedQty = $rowProductQty['IssuedQty'];
                                    $ProductQty -= 1;
                                    echo '<br>';
                                    $IssuedQty += 1;
                                    echo '<br>';
                                    $sqlUpdateQty = "UPDATE products SET Qty='$ProductQty', IssuedQty='$IssuedQty' ,"
                                            . "IssueLastDate='$adddate',UpdateUser='$addeduser',UpdateDate='$adddate' WHERE  ProductId='$ProductName'";
                                    $db->query($sqlUpdateQty);

                                    $db = dbConn();
                                    $sqladdReqProduct = "INSERT INTO orderreleaseitem(JobCard, ProductId,Qty, AddUser,AddDate) VALUES ('$JobCardId','$ProductName','$QtyProduct','$addeduser','$adddate')";
                                    $resultaddReqProduct = $db->query($sqladdReqProduct);
                                    $ReleaseITemId = $db->insert_id;

                                    $sqlUpdateReqProduct = "UPDATE orderreleaseitem SET StockId='$stockId' WHERE orderReleaseId='$ReleaseITemId'";
                                    $resultReqProduct = $db->query($sqlUpdateReqProduct);
                                }
                            }
                        }
                        ?>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addproduct1') {
                            $OrderId;
                            $JobCardId;
                            $ProductName;
                            $QtyProduct = inputTrim($QtyProduct);
                            $addeduser = $_SESSION['userId'];
                            $adddate = date("Y-m-d");
                            $messages = array();

                            if (empty($QtyProduct)) {
                                $messages['error_Product_qty'] = "The Product Qty should not be Blank..!";
                            }
                            if (!empty($ProductName)) {
                                $db = dbconn();
                                $sql = "SELECT * FROM products WHERE ProductId='$ProductName' AND Qty = 0; ";
                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    $messages['error_Product_size'] = "The Product is Out Of stock!";
                                }
                            }
                            if (!empty($ProductName)) {
                                $db = dbconn();
                                $sqlFindStockId = "SELECT * FROM stockitems si WHERE si.ProductName='$ProductName' AND si.Status='1' AND si.ExpDate != '$adddate' AND si.ExpDate > '$adddate' ORDER BY si.AddDate ASC LIMIT 1;";
                                $resultStockId = $db->query($sqlFindStockId);
                                if ($resultStockId->num_rows > 0) {
                                    $rowStock = $resultStockId->fetch_assoc();
                                    $stockId = $rowStock['StockId'];

                                    $sql = "SELECT * FROM orderreleaseitem WHERE StockId='$stockId' AND JobCard = '$JobCardId'";
                                    $result = $db->query($sql);

                                    if ($result->num_rows > 0) {
                                        $messages['error_Product'] = "The item is already issued...!";
                                    }
                                }
                            }

                            if (empty($messages)) {
                                $JobCardId;
                                $addeduser = $_SESSION['userId'];
                                $adddate = date("Y-m-d");

                                $sqlFindStockId = "SELECT * FROM stockitems si WHERE si.ProductName='$ProductName' AND si.Status='1' AND si.ExpDate != '$adddate' AND si.ExpDate > '$adddate' ORDER BY si.AddDate ASC LIMIT 1;";
                                $resultStockId = $db->query($sqlFindStockId);
                                $rowStock = $resultStockId->fetch_assoc();
                                $stockId = $rowStock['StockId'];
                                $sqlUpdateStock = "UPDATE stockitems SET Status='0',UpdateUser='$addeduser',UpdateDate='$adddate' WHERE StockId='$stockId' AND ProductName='$ProductName'";
                                $resultUpdateStock = $db->query($sqlUpdateStock);

                                $sqlProductQty = "SELECT UpdateDate,UpdateUser,IssuedQty,Qty FROM Products WHERE ProductId='$ProductName'";
                                $result = $db->query($sqlProductQty);
                                $rowProductQty = $result->fetch_assoc();
                                $ProductQty = $rowProductQty['Qty'];
                                if ($ProductQty == 0) {
                                    
                                } else {
                                    $IssuedQty = $rowProductQty['IssuedQty'];
                                    $ProductQty -= 1;
                                    echo '<br>';
                                    $IssuedQty += 1;
                                    echo '<br>';
                                    $sqlUpdateQty = "UPDATE products SET Qty='$ProductQty', IssuedQty='$IssuedQty' ,"
                                            . "IssueLastDate='$adddate',UpdateUser='$addeduser',UpdateDate='$adddate' WHERE  ProductId='$ProductName'";
                                    $db->query($sqlUpdateQty);

                                    $db = dbConn();
                                    $sqladdReqProduct = "INSERT INTO orderreleaseitem(JobCard, ProductId,Qty, AddUser,AddDate) VALUES ('$JobCardId','$ProductName','$QtyProduct','$addeduser','$adddate')";
                                    $resultaddReqProduct = $db->query($sqladdReqProduct);
                                    $ReleaseITemId = $db->insert_id;

                                    $sqlUpdateReqProduct = "UPDATE orderreleaseitem SET StockId='$stockId' WHERE orderReleaseId='$ReleaseITemId'";
                                    $resultReqProduct = $db->query($sqlUpdateReqProduct);
                                }
                            }
                        }
                        ?>
                        <?php
                        extract($_POST);
//                        print_r($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'removeProduct') {
                            $JobCardId;
                            @$AppointmentId;
                            @$Inspectionid;
                            $addeduser = $_SESSION['userId'];
                            $adddate = date("Y-m-d");
                            $ProductId;
//                            echo'<br>';
                            $stockIdz = $_POST['stockIdz'];
//                            echo'<br>';
                            $db = dbConn();
                            $sqlDeleteItems = "DELETE FROM orderreleaseitem  WHERE orderReleaseId='$orderReleaseId'";
                            $db->query($sqlDeleteItems);

                            $sqlRetunStock = "UPDATE stockitems SET Status='1' WHERE stockId='$stockIdz'";
                            $db->query($sqlRetunStock);

                            $sqlProductQty = "SELECT UpdateDate,UpdateUser,IssuedQty,Qty FROM Products WHERE ProductId='$ProductId'";
                            $resultProductQty = $db->query($sqlProductQty);
                            $rowProductQty = $resultProductQty->fetch_assoc();

                            $ProductQty = $rowProductQty['Qty'];
                            $IssuedQty = $rowProductQty['IssuedQty'];
                            $ProductQty += 1;

                            $IssuedQty -= 1;

                            $sqlUpdateQty1 = "UPDATE products SET Qty='$ProductQty', IssuedQty='$IssuedQty' ,"
                                    . "IssueLastDate='$adddate',UpdateUser='$addeduser',UpdateDate='$adddate' WHERE  ProductId='$ProductId'";
                            $db->query($sqlUpdateQty1);
                        }
                        ?>
                        <?php
                        extract($_POST);
//                        print_r($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'removeProduct1') {
                            $JobCardId;
                            @$AppointmentId;
                            @$Inspectionid;
                            $addeduser = $_SESSION['userId'];
                            $adddate = date("Y-m-d");
                            $ProductId;

                            $stockIdz = $_POST['stockIdz'];

                            $db = dbConn();
                            $sqlDeleteItems = "DELETE FROM orderreleaseitem  WHERE orderReleaseId='$orderReleaseId'";
                            $db->query($sqlDeleteItems);

                            $sqlRetunStock = "UPDATE stockitems SET Status='1' WHERE stockId='$stockIdz'";
                            $db->query($sqlRetunStock);

                            $sqlProductQty = "SELECT UpdateDate,UpdateUser,IssuedQty,Qty FROM Products WHERE ProductId='$ProductId'";
                            $resultProductQty = $db->query($sqlProductQty);
                            $rowProductQty = $resultProductQty->fetch_assoc();

                            $ProductQty = $rowProductQty['Qty'];
                            $IssuedQty = $rowProductQty['IssuedQty'];
                            $ProductQty += 1;

                            $IssuedQty -= 1;

                            $sqlUpdateQty1 = "UPDATE products SET Qty='$ProductQty', IssuedQty='$IssuedQty' ,"
                                    . "IssueLastDate='$adddate',UpdateUser='$addeduser',UpdateDate='$adddate' WHERE  ProductId='$ProductId'";
                            $db->query($sqlUpdateQty1);
                        }
                        ?>
                        <?php
                        extract($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addOrder') {
                            $JobCardId;
                            @$AppointmentId;
                            @$Inspectionid;
                            $VehicleId;
                            $customerId;
                            $OrderId;
                            $jobCardEmp;

                            $addeduser = $_SESSION['userId'];
                            $AddDate = date('Y-m-d');
                            $timestamp = strtotime($AddDate);
                            $currentdatenumber = date('Ymd', $timestamp);
                            $randomNumber;
                            $ReleaseNo = 'REL' . $currentdatenumber . $randomNumber;

                            $db = dbConn();
                            $sqlorders = "INSERT INTO relaeseitems(ReleaseNo,EmpId, AppointmentId,OrderId,JobCardId, CustomerName,VehicleNo,AddDate,AddUser,Status) VALUES ('$ReleaseNo','$jobCardEmp','$AppointmentId','$OrderId','$JobCardId','$customerId','$VehicleId','$AddDate','$addeduser','1')";
                            $resultsOrder = $db->query($sqlorders);
                            $ReleaseId = $db->insert_id;
//                            die();
                            $sqlAddrelSubItem = "SELECT * FROM orderreleaseitem WHERE JobCard= '$JobCardId'";
                            $db = dbConn();
                            $resultRelSubItem = $db->query($sqlAddrelSubItem);
                            ?>
                            <?php
                            if ($resultRelSubItem->num_rows > 0) {
                                while ($rowrelSubItem = $resultRelSubItem->fetch_assoc()) {
                                    ?>
                                    <?php
                                    $addedproductid = $rowrelSubItem['ProductId'];
                                    $addedproductqty = $rowrelSubItem['Qty'];
                                    $StockId1 = $rowrelSubItem['StockId'];

                                    $sqlSubrelAdd = "INSERT INTO relasesubitems(ReleaseItemId,OrderId,ProductId,StockId,Qty, AddUser,AddDate) VALUES ('$ReleaseId','$OrderId','$addedproductid','$StockId1','$addedproductqty','$addeduser','$AddDate')";
                                    $resultSubrelAddInsert = $db->query($sqlSubrelAdd);
                                    $ReleaseSubId = $db->insert_id;

                                    $sqlJobCardTemporyItemRepair = "INSERT INTO jobcardtempitemsrepair(JobCardId, ReleaseSubId, ReleaseItemId,OrderId, ProductId, StockId, Qty, AddUser, AddDate,Status) VALUES "
                                            . "('$JobCardId','$ReleaseSubId','$ReleaseId','$OrderId','$addedproductid','$StockId1','$addedproductqty','$addeduser','$AddDate','1')";
                                    $resultJobCardTemporyItemRepair = $db->query($sqlJobCardTemporyItemRepair);

                                    $sqlDelerelSubItem = "DELETE orderreleaseitem WHERE JobCard= '$JobCardId'";
                                    $resultDelRelSubItem = $db->query($sqlDelerelSubItem);

                                    $sqlUpdateStatus = "UPDATE orders SET Status='2' WHERE id='$OrderId'";
                                    $resultUpdateOrderStatus = $db->query($sqlUpdateStatus);

                                    $sqlUpdateOrderItemStatus = "UPDATE orderitems SET Status='2', UpdateUser ='$addeduser',UpdateDate='$AddDate' WHERE OrderId='$OrderId' AND ProductId=$addedproductid";
                                    $resultUpdateOrderItemStatus = $db->query($sqlUpdateOrderItemStatus);
                                    ?>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <?php
                        extract($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addOrder1') {
                            $JobCardId;
                            @$Inspectionid;
                            $VehicleId;
                            $customerId;
                            $OrderId;
                            $jobCardEmp;

                            $addeduser = $_SESSION['userId'];
                            $AddDate = date('Y-m-d');
                            $timestamp = strtotime($AddDate);
                            $currentdatenumber = date('Ymd', $timestamp);
                            $randomNumber;
                            $ReleaseNo = 'REL' . $currentdatenumber . $randomNumber;

                            $db = dbConn();
                            $sqlorders = "INSERT INTO relaeseitems(ReleaseNo,EmpId, InpsectionId,OrderId,JobCardId, CustomerName,VehicleNo,AddDate,AddUser,Status) VALUES ('$ReleaseNo','$jobCardEmp','$Inspectionid','$OrderId','$JobCardId','$customerId','$VehicleId','$AddDate','$addeduser','1')";
                            $resultsOrder = $db->query($sqlorders);
                            $ReleaseId = $db->insert_id;
//                            die();
                            $sqlAddrelSubItem = "SELECT * FROM orderreleaseitem WHERE JobCard= '$JobCardId'";
                            $db = dbConn();
                            $resultRelSubItem = $db->query($sqlAddrelSubItem);
                            ?>
                            <?php
                            if ($resultRelSubItem->num_rows > 0) {
                                while ($rowrelSubItem = $resultRelSubItem->fetch_assoc()) {
                                    ?>
                                    <?php
                                    $addedproductid = $rowrelSubItem['ProductId'];
                                    $addedproductqty = $rowrelSubItem['Qty'];
                                    $StockId1 = $rowrelSubItem['StockId'];

                                    $sqlSubrelAdd = "INSERT INTO relasesubitems(ReleaseItemId,OrderId,ProductId,StockId,Qty, AddUser,AddDate) VALUES ('$ReleaseId','$OrderId','$addedproductid','$StockId1','$addedproductqty','$addeduser','$AddDate')";
                                    $resultSubrelAddInsert = $db->query($sqlSubrelAdd);
                                    $ReleaseSubId = $db->insert_id;

                                    $sqlJobCardTemporyItemRepair = "INSERT INTO jobcardtempitemsrepair(JobCardId, ReleaseSubId, ReleaseItemId,OrderId, ProductId, StockId, Qty, AddUser, AddDate,Status) VALUES "
                                            . "('$JobCardId','$ReleaseSubId','$ReleaseId','$OrderId','$addedproductid','$StockId1','$addedproductqty','$addeduser','$AddDate','1')";
                                    $resultJobCardTemporyItemRepair = $db->query($sqlJobCardTemporyItemRepair);
                                    $sqlDelerelSubItem = "DELETE orderreleaseitem WHERE JobCard= '$JobCardId'";
                                    $resultDelRelSubItem = $db->query($sqlDelerelSubItem);

                                    $sqlUpdateStatus = "UPDATE orders SET Status='2' WHERE id='$OrderId'";
                                    $resultUpdateOrderStatus = $db->query($sqlUpdateStatus);

                                    $sqlUpdateOrderItemStatus = "UPDATE orderitems SET Status='2', UpdateUser ='$addeduser',UpdateDate='$AddDate' WHERE OrderId='$OrderId' AND ProductId=$addedproductid";
                                    $resultUpdateOrderItemStatus = $db->query($sqlUpdateOrderItemStatus);
                                    ?>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <div class="card">
                            <div class="card">
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
                                            <h5 class='m-1'style="text-align: center; font-weight: bold;">Order Summary</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <p> Customer Name : <?= $row2['FirstName'] . ' ' . $row2['LastName']; ?>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>Vehicle No : <?= $row2['registerLetter'] . ' - ' . $row2['RegistrationNo']; ?> </p>
                                                    </div>
                                                    <div>
                                                        <p>Vehicle Type : <?= $row2['CatergoryName']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Order No : <?= $row2['orderNo'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <p>Job Card No:  <?= $row2['JobCardNumber'] ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Order By :  <?= $row2['UserFirstName'] . ' ' . $row2['UserLastName'] ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Order Date :  <?= $row2['AddDate'] ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Order Status : <?php
                                                            $Status = $row2['Status'];
                                                            $statusDescription = '';

                                                            switch ($Status) {
                                                                case 1:
                                                                    $statusDescription = "Order Request Sent";
                                                                    $statusColor = "badge rounded-pill bg-warning text-dark";
                                                                    break;
                                                                case 2:
                                                                    $statusDescription = "Item Recieved";
                                                                    $statusColor = "badge rounded-pill bg-success";
                                                                    break;
                                                                default:
                                                                    $statusDescription = "Not Available";
                                                                    $statusColor = "badge rounded-pill bg-secondary";
                                                                    break;
                                                            }
                                                            ?>
                                                            <span class='<?= $statusColor ?>'><?= $statusDescription ?> </span>
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
                                                            <th scope="col">Qty</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sqlshowproduct = "SELECT p.ProductName,"
                                                                . "odi.Qty FROM orders od "
                                                                . "LEFT JOIN orderitems odi ON od.id=odi.OrderId "
                                                                . "LEFT JOIN products p ON odi.ProductId=p.ProductId "
                                                                . "LEFT JOIN job_cards jb ON jb.id=od.JobCardNo "
                                                                . "WHERE od.id='$OrderId' AND od.JobCardNo='$JobCardId';";
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
                                                                    <td><?= $rowshowp['Qty'] ?></td>
                                                                </tr>
                                                                <?php
                                                                $i++;
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </section>
                                        </div>
                                    </section> 
                                </div>
                            </div>
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
                                                        <p>Millage :</p>
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
                                                        <p>Technician Name :  <?= $row2['UserFirstName'] . ' ' . $row2['UserLastName']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Job Card No: <?= $row2['JobCardNumber'] ?> </p>
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
                                                        $db = dbConn();
                                                        $sqlshowproduct = "SELECT odr.orderReleaseId,"
                                                                . "odr.Qty,"
                                                                . "sti.SerialNo,"
                                                                . "sti.Cost,"
                                                                . "sti.SalePrice,"
                                                                . "sti.StockId,"
                                                                . "p.ProductId,"
                                                                . "p.ProductName "
                                                                . "FROM orderreleaseitem odr "
                                                                . "LEFT JOIN products p ON odr.ProductId=p.ProductId "
                                                                . "LEFT JOIN stockitems sti ON odr.StockId=sti.StockId WHERE odr.JobCard='$JobCardId'";

                                                        $resultappShowProduct = $db->query($sqlshowproduct);
                                                        ?>



                                                        <?php
                                                        $TotalProduct = 0;
                                                        $TotalCostProduct = 0;
                                                        if ($resultappShowProduct->num_rows > 0) {
                                                            $i = 1;
                                                            while ($rowShowProductApp = $resultappShowProduct->fetch_assoc()) {
                                                                ?><tr>
                                                                    <td><?= $i ?></td>
                                                                    <td><?= $ProductName1 = $rowShowProductApp['ProductName'] ?></td> 
                                                                    <td><?= $SerialNo = $rowShowProductApp['SerialNo'] ?></td>  
                                                                    <td><?= $PRoductQty1 = $rowShowProductApp['Qty'] ?></td>
                                                                    <td><?= $ProdcutPrice1 = $rowShowProductApp['SalePrice'] ?></td>
                                                                    <td><?= @$sumProduct = $PRoductQty1 * $ProdcutPrice1; ?></td>
                                                                    <?php
                                                                    $StockIdZZ = $rowShowProductApp['StockId'];
                                                                    $ProductId = $rowShowProductApp['ProductId'];
                                                                    $orderReleaseId = $rowShowProductApp['orderReleaseId'];
//                                                            $RepairData = "('$InspectionId','$RepairId','$repairName', $RepairQty, $repairPrice)";
                                                                    ?>
                                                                    <td> 

                                                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                            <input type="hidden" name="orderReleaseId" value="<?= $orderReleaseId ?>" >
                                                                            <input type="hidden" name="stockIdz" value="<?= $StockIdZZ ?>" >
                                                                            <input type="hidden" name="OrderId" value="<?= $OrderId ?>" >
                                                                            <input type="hidden" name="ProductId" value="<?= $ProductId ?>" >
                                                                            <input type="hidden" name="JobCardId" value="<?= $JobCardId ?>" >
                                                                            <input type="hidden" name="AppointmentId" value="<?= $AppointmentId ?>" >
                                                                            <button type="submit" class="btn btn-danger btn-sm" name="action" value="removeProduct" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $i++;
                                                                $TotalProduct += @$sumProduct;
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
                                                            <td><strong><?= $TotalProduct ?>
                                                                    <?php
                                                                    echo $TotalCostProduct;
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
                                                                . "LEFT JOIN repaircatergory rpc ON rpc.RepairId=odrp.ReqRepairId WHERE odrp.JobCard_No='$JobCardId';";
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
                                                            <td><strong><?= $TotalProduct += $totalRepair ?></strong></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </section>
                                        </div>


                                        <div class="card-footer">
                                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                <input type="hidden" name="customerId" value="<?= $row2['CustomerName'] ?>" >
                                                <input type="hidden" name="VehicleId" value="<?= $row2['VehicleNo'] ?>" >
                                                <input type="hidden" name="jobCardEmp" value="<?= $row2['UserId'] ?>" >
                                                <input type="hidden" name="OrderId" value="<?= $OrderId ?>" >
                                                <input type="hidden" name="JobCardId" value="<?= $JobCardId ?>" >
                                                <input type="hidden" name="AppointmentId" value="<?= $AppointmentId ?>" >
                                                <button type="submit" name="action" value="addOrder" class="btn btn-primary ">Release Items</button>
                                            </form>
                                        </div>
                                    </section> 
                                </div>
                            <?php }
                            ?>
                            <?php if (@$Inspectionid) { ?>
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
                                            <h5 class='m-1'style="text-align: center; font-weight: bold;">Job Card - Repair</h5>
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
                                        <div class="container m-1 ">
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
                                                        $sqlshowproduct = "SELECT odr.orderReleaseId,"
                                                                . "odr.Qty,"
                                                                . "sti.SerialNo,"
                                                                . "sti.Cost,"
                                                                . "sti.SalePrice,"
                                                                . "sti.StockId,"
                                                                . "p.ProductId,"
                                                                . "p.ProductName "
                                                                . "FROM orderreleaseitem odr "
                                                                . "LEFT JOIN products p ON odr.ProductId=p.ProductId "
                                                                . "LEFT JOIN stockitems sti ON odr.StockId=sti.StockId WHERE odr.JobCard='$JobCardId'";
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
                                                                    <?php
                                                                    $StockIdZZ = $rowshowp['StockId'];
                                                                    $ProductId = $rowshowp['ProductId'];
                                                                    $orderReleaseId = $rowshowp['orderReleaseId'];
//                                                            $RepairData = "('$InspectionId','$RepairId','$repairName', $RepairQty, $repairPrice)";
                                                                    ?>
                                                                    <td> 
                                                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                            <input type="hidden" name="orderReleaseId" value="<?= $orderReleaseId ?>" >
                                                                            <input type="hidden" name="stockIdz" value="<?= $StockIdZZ ?>" >
                                                                            <input type="hidden" name="OrderId" value="<?= $OrderId ?>" >
                                                                            <input type="hidden" name="ProductId" value="<?= $ProductId ?>" >
                                                                            <input type="hidden" name="JobCardId" value="<?= $JobCardId ?>" >
                                                                            <input type="hidden" name="Inspectionid" value="<?= $Inspectionid ?>" >
                                                                            <button type="submit" class="btn btn-danger btn-sm" name="action" value="removeProduct1" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sqlshowrepair = "SELECT odrp.ReqRepairId,odrp.Qty,rpc.RepairName,rpc.RepairPrice,rpc.RepairCost FROM orderreqrepairs odrp "
                                                                . "LEFT JOIN repaircatergory rpc ON rpc.RepairId=odrp.ReqRepairId WHERE odrp.JobCard_No='$JobCardId';";
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
                                            </section>
                                        </div>
                                        <div class="card-footer">
                                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                <input type="hidden" name="customerId" value="<?= $row2['CustomerName'] ?>" >
                                                <input type="hidden" name="VehicleId" value="<?= $row2['VehicleNo'] ?>" >
                                                <input type="hidden" name="jobCardEmp" value="<?= $row2['UserId'] ?>" >
                                                <input type="hidden" name="OrderId" value="<?= $OrderId ?>" >
                                                <input type="hidden" name="JobCardId" value="<?= $JobCardId ?>" >
                                                <input type="hidden" name="Inspectionid" value="<?= $Inspectionid ?>" >
                                                <button type="submit" name="action" value="addOrder1" class="btn btn-primary ">Release Items</button>
                                            </form>
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

                <div class="text-danger"><?= @$messages['error_Product_Exists']; ?></div>
                <div class="text-danger"><?= @$messages['error_Product_size']; ?></div>
                <div class="text-danger"><?= @$messages['error_Product']; ?></div>
                <form id='product' action="editJobCardStockKeeper.php" method="POST" >
                    <div class="card text-dark bg-light  mb-3 m-1" style="width: 18rem;">
                        <?php
                        $db = dbconn();
                        $sqlCategory = "SELECT CatergoryID,CatergoryName FROM catergories WHERE CatergoryStatus='1'";
                        $resultCategory = $db->query($sqlCategory);
                        ?>
                        <div class="card-body text-center">
                            <h5 class="card-title">Add Products</h5>
                            <div class="mb-3">
                                <label for="CategoryName" class="form-label">Product Name</label>
                                <select id='CategoryName' for="CategoryName" name="CategoryName" class="form-select" aria-label="Default select example" onChange='loadProducts()'>
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
                                <input type="number" max="1" min="1" class="form-control" id="QtyProduct" name="QtyProduct"
                                       placeholder="Enter Qty">
                                <div class="text-danger"><?= @$messages['error_Product_Qty']; ?></div>
                            </div>
                            <?php if (@$AppointmentId) { ?>
                                <input type="hidden" name="OrderId" value="<?= $OrderId ?>" >
                                <input type="hidden" name="AppointmentId" value="<?= @$AppointmentId ?>" >
                                <input type="hidden" name="JobCardId" value="<?= $JobCardId ?>" >
                                <button type="submit" name="action" value="addproduct" class="btn btn-dark ">Add Product</button>
                            <?php } else { ?>
                                <input type="hidden" name="OrderId" value="<?= $OrderId ?>" >
                                <input type="hidden" name="Inspectionid" value="<?= @$Inspectionid ?>" >
                                <input type="hidden" name="JobCardId" value="<?= $JobCardId ?>" >
                                <button type="submit" name="action" value="addproduct1" class="btn btn-dark ">Add Product</button>
                            <?php } ?>
                        </div>
                    </div>
                </form>
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
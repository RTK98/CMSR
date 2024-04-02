<?php
ob_start();
include'../../header.php';
include'../../menu.php';
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
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && (@$action == 'edit' || @$action == 'addProduct' || @$action == 'removeProduct' || @$action == 'removeProduct1' || @$action == 'addOrder' || @$action == 'addOrder1')) {
//                            
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
//                                print_r($jobCardId);die();
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
                                        . "cusmob.MobileNo,"
                                        . "jbr.JobCardNo "
                                        . "FROM appointments ap "
                                        . "LEFT JOIN customer cus ON ap.CustomerID = cus.CustomerID "
                                        . "LEFT JOIN customervehicles cv ON ap.VehicleNo=cv.vehicleId "
                                        . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                                        . "LEFT JOIN timeslots tms ON ap.TimeSlotStart=tms.TimeSlotId "
                                        . "LEFT JOIN service sv ON ap.ServiceType=sv.ServiceId  "
                                        . "LEFT JOIN vehiclemodels vcm ON cv.VehicleModel=vcm.VehicleModelsId "
                                        . "LEFT JOIN job_cards jbr ON jbr.AppointmentId=ap.AppointmentId "
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
                        }
                        ?>
                        <?php
                        extract($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addProduct') {
                            $jobCardId;
                            @$AppointmentId;
                            @$InspectionNo;
                            $ProductName;
                            $QtyProduct;
                            $messages = array();
                            if (!empty($AppointmentId)) {
                                if (!empty($ProductName)) {
                                    $db = dbconn();
                                    $sqlOutOfStock = "SELECT * FROM products WHERE ProductId='$ProductName' AND Qty = '0'";
                                    $resultOutOfStock = $db->query($sqlOutOfStock);

                                    if ($resultOutOfStock->num_rows > 0) {
                                        $messages['error_Product_size'] = "The Product is Out Of stock!";
                                    }
                                }

                                if (!empty($ProductName)) {
                                    $db = dbconn();
                                     $sql1 = "SELECT * FROM products WHERE ProductId='$ProductName'";
                                    $result1 = $db->query($sql1);

                                    if ($result->num_rows > 0) {

                                        $row1 = $result1->fetch_assoc();
                                        $QtyFromTable = $row1['Qty'];
                                        if ($QtyProduct > $QtyFromTable) {
                                            $messages['error_product_Qty'] = "The Product Qty Exceeded!";
                                        } else {
                                            $addeduser = $_SESSION['userId'];
                                            $adddate = date("Y-m-d");
                                            $db = dbConn();
                                            $sqladdreqProduct = "INSERT INTO orderrequestitems(JobCardId, ReqProductId,AddUser, AddDate,Qty) VALUES ('$jobCardId','$ProductName','$addeduser','$adddate','$QtyProduct')";

                                            $resultaddReqProduct = $db->query($sqladdreqProduct);
                                        }
                                    }
                                }
                            }
                            if (!empty($InspectionNo)) {
                                if (!empty($ProductName)) {
                                    $db = dbconn();
                                    $sqlOutOfStock = "SELECT * FROM products WHERE ProductId='$ProductName' AND Qty = '0'";
                                    $resultOutOfStock = $db->query($sqlOutOfStock);

                                    if ($resultOutOfStock->num_rows > 0) {
                                        $messages['error_Product_size'] = "The Product is Out Of stock!";
                                    }
                                }

                                if (!empty($ProductName)) {
                                    $db = dbconn();
                                    $sql1 = "SELECT * FROM products WHERE ProductId='$ProductName'";
                                    $result1 = $db->query($sql1);

                                    if ($result->num_rows > 0) {

                                        $row1 = $result1->fetch_assoc();
                                        $QtyFromTable = $row1['Qty'];
                                        if ($QtyProduct > $QtyFromTable) {
                                            $messages['error_product_Qty'] = "The Product Qty Exceeded!";
                                        } else {
                                            $addeduser = $_SESSION['userId'];
                                            $adddate = date("Y-m-d");
                                            $db = dbConn();
                                            $sqladdreqProduct = "INSERT INTO orderrequestitems(JobCardId, ReqProductId,AddUser, AddDate,Qty) VALUES ('$jobCardId','$ProductName','$addeduser','$adddate','$QtyProduct')";

                                            $resultaddReqProduct = $db->query($sqladdreqProduct);
                                        }
                                    }
                                }
                            }
                        }
//                        print_r($messages);
                        ?>
                        <?php
                        extract($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'removeProduct') {
                            $ProductId;
                            $db = dbConn();
                            $sqlDeleteItems = "DELETE FROM orderrequestitems WHERE orderReqItemId='$ProductId'";
                            $db->query($sqlDeleteItems);
                        }
                        ?>
                        <?php
                        extract($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'removeProduct1') {
                            $ProductId;
                            $db = dbConn();
                            $sqlDeleteItems = "DELETE FROM orderrequestitems WHERE orderReqItemId='$ProductId'";
                            $db->query($sqlDeleteItems);
                        }
                        ?>
                        <?php
                        extract($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addOrder') {
//                        $productData = [];
//                        $repairData = [];
//                        print_r($productData);
//                        print_r($repairData);

                            $addeduser = $_SESSION['userId'];
                            $AddDate = date('Y-m-d');
                            $timestamp = strtotime($AddDate);
                            $currentdatenumber = date('Ymd', $timestamp);
                            $randomNumber;
                            $OrderNo = 'ODR' . $currentdatenumber . $randomNumber;

                            $db = dbConn();
                            $sqlorders = "INSERT INTO orders(orderNo,JobCardNo, CustomerName,VehicleNo,AddDate,AddUser,Status) VALUES ('$OrderNo','$jobCardId','$CustomerID','$VehicleNo','$AddDate','$addeduser','1')";
                            $resultsOrder = $db->query($sqlorders);
                            $OrderId = $db->insert_id;
//                            die();
                            $sqlAddproduct = "SELECT odr.orderReqItemId,odr.JobCardId, odr.Qty, jb.JobCardNo, p.ProductId ,p.ProductName FROM orderrequestitems odr "
                                    . "LEFT JOIN job_cardsrepair jb ON odr.JobCardId = jb.jobCardsRepairId "
                                    . "LEFT JOIN products p ON odr.ReqProductId = p.ProductId WHERE odr.JobCardId = '$jobCardId';";
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

                                    $sqlInserDel = "DELETE FROM orderrequestitems WHERE JobCardId='$jobCardId'";
                                    $resultsDelInsert = $db->query($sqlInserDel);
                                    ?>
                                    <?php
                                }
                            }
                            ?>

                            <script>
                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: 'Order has been sent Successfully',
                                    animation: false,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                }).then(() => {
                                    window.location.href = 'viewMyReqItems.php'; // Redirect to success page
                                });
                        </script><?php
                        }
                        ?>
                        <?php
                        extract($_POST);
                        if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'addOrder1') {
//                        $productData = [];
//                        $repairData = [];
//                        print_r($productData);
//                        print_r($repairData);

                            $addeduser = $_SESSION['userId'];
                            $AddDate = date('Y-m-d');
                            $timestamp = strtotime($AddDate);
                            $currentdatenumber = date('Ymd', $timestamp);
                            $randomNumber;
                            $OrderNo = 'ODR' . $currentdatenumber . $randomNumber;

                            $db = dbConn();
                            $sqlorders = "INSERT INTO orders(orderNo,JobCardNo, CustomerName,VehicleNo,AddDate,AddUser,Status) VALUES ('$OrderNo','$jobCardId','$customerId','$VehicleId','$AddDate','$addeduser','1')";
                            $resultsOrder = $db->query($sqlorders);
                            $OrderId = $db->insert_id;
//                            die();
                            $sqlAddproduct = "SELECT odr.orderReqItemId,odr.JobCardId, odr.Qty, jb.JobCardNo, p.ProductId ,p.ProductName FROM orderrequestitems odr "
                                    . "LEFT JOIN job_cardsrepair jb ON odr.JobCardId = jb.jobCardsRepairId "
                                    . "LEFT JOIN products p ON odr.ReqProductId = p.ProductId WHERE odr.JobCardId = '$jobCardId';";
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

                                    $sqlInserDel = "DELETE FROM orderrequestitems WHERE JobCardId='$jobCardId'";
                                    $resultsDelInsert = $db->query($sqlInserDel);
                                    ?>
                                    <?php
                                }
                            }
                            ?>

                            <script>
                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: 'Order has been sent Successfully',
                                    animation: false,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                }).then(() => {
                                    window.location.href = 'viewMyReqItems.php'; // Redirect to success page
                                });
                        </script><?php
                        }
                        ?>

                        <div class="card">
                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <?php if (!empty($AppointmentId)) { ?>
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
                                <?php if (!empty($InspectionNo)) { ?>
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
                            <?php if (!empty($AppointmentId)) { ?>
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
                                            <h5 class='m-1'style="text-align: center; font-weight: bold;">Requesting Order</h5>
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
                                                        <p>Millage :  ?></p>
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
                                                        <p>Job Card No: <?= $row['JobCardNo']; ?> </p>
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
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sqlshowproduct = "SELECT odr.orderReqItemId,odr.JobCardId, odr.Qty, jb.JobCardNo, p.ProductName FROM orderrequestitems odr "
                                                                . "LEFT JOIN job_cardsrepair jb ON odr.JobCardId = jb.jobCardsRepairId "
                                                                . "LEFT JOIN products p ON odr.ReqProductId = p.ProductId WHERE odr.JobCardId = '$jobCardId';";
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
                                                                    <td> 
                                                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                            <?php
                                                                            $ProductId = $rowshowp['orderReqItemId'];
                                                                            ?>
                                                                            <input type="hidden" name="ProductId" value="<?= $ProductId ?>" >
                                                                            <input type="hidden" name="AppointmentId" value="<?= $AppointmentId ?>" >
                                                                            <input type="hidden" name="jobCardId" value="<?= $jobCardId ?>" >
                                                                            <button type="submit" class="btn btn-danger btn-sm" name="action" value="removeProduct" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>
                                                                        </form>
                                                                    </td>
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
                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                            <div class="card-footer">
                                                <input type="hidden" name="jobCardId" value="<?= $jobCardId ?>" >
                                                <input type="hidden" name="AppointmentId" value="<?= $AppointmentId ?>" >
                                                <button type="submit" name="action" value="addOrder" class="btn btn-primary btn-sm">Submit</button>
                                            </div>
                                        </form>
                                    </section> 
                                </div>
                            <?php }
                            ?>
                            <?php if (!empty($InspectionNo)) { ?>
                                <div class="card-body">
                                    <section class="m-1">
                                        <div class="card-header">
                                            <img width="60" src="<?= SYSTEM_PATH ?>/assets/img/logo.png" title="logo" alt="logo" 
                                                 styly=" 
                                                 margin-left: auto;
                                                 display: block;
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
                                                            <th scope="col">Qty</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sqlshowproduct = "SELECT odr.orderReqItemId,odr.JobCardId, odr.Qty, jb.JobCardNo, p.ProductName FROM orderrequestitems odr "
                                                        . "LEFT JOIN job_cardsrepair jb ON odr.JobCardId = jb.jobCardsRepairId "
                                                        . "LEFT JOIN products p ON odr.ReqProductId = p.ProductId WHERE odr.JobCardId = '$jobCardId';";
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
                                                                    <td> 
                                                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                                            <?php
                                                                            $ProductId = $rowshowp['orderReqItemId'];
                                                                            ?>
                                                                            <input type="text" name="ProductId" value="<?= $ProductId ?>" >
                                                                            <input type="text" name="InspectionNo" value="<?= $InspectionNo ?>" >
                                                                            <input type="text" name="jobCardId" value="<?= $jobCardId ?>" >
                                                                            <button type="submit" class="btn btn-danger btn-sm" name="action" value="removeProduct1" onclick="return confirm('Are you sure you want to remove this item?')">Remove</button>
                                                                        </form>

                                                                    </td>
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
                                        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                            <div class="card-footer">
                                                <input type="hidden" name="jobCardId" value="<?= $jobCardId ?>" >
                                                <input type="hidden" name="InspectionNo" value="<?= $InspectionNo ?>" >
                                                <button type="submit" name="action" value="addOrder1" class="btn btn-primary ">Submit</button>
                                            </div>
                                        </form>
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
                <form id='product' action="reqForm.php" method="POST" >
                    <div class="card text-dark bg-light  mb-3 m-1" style="width: 18rem;">
                        <?php
                        $db = dbconn();
                        $sqlCategory = "SELECT CatergoryID,CatergoryName FROM catergories WHERE CatergoryStatus='1'";
                        $resultCategory = $db->query($sqlCategory);
                        ?>
                        <div class="card-body text-center">
                            <div class="text-danger"><?= @$messages['error_product_Qty']; ?></div>
                            <div class="text-danger"><?= @$messages['error_Product_size']; ?></div>
                            <h5 class="card-title">Add Products</h5>
                            <div class="mb-3">
                                <label for="CategoryName" class="form-label">Product Name</label>
                                <select id='CategoryName' for="CategoryName" name="CategoryName" class="form-select" aria-label="Default select example" onchange='loadProducts()'>
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
                                <input type="hidden" class="form-control" id="QtyProduct" name="QtyProduct"
                                       placeholder="Enter Qty">
                                <div class="text-danger"><?= @$messages['error_Product_Qty']; ?></div>
                            </div>
                            <?php if (@$AppointmentId) { ?>
                                <input type="hidden" name="jobCardId" value="<?= @$jobCardId ?>" >
                                <input type="hidden" name="AppointmentId" value="<?= @$AppointmentId ?>" >
                                <button type="submit" name="action" value="addProduct" class="btn btn-dark ">Add Product</button>
                            <?php } else { ?>
                                <input type="hidden" name="jobCardId" value="<?= @$jobCardId ?>" >
                                <input type="hidden" name="InspectionNo" value="<?= @$InspectionNo ?>" >
                                <button type="submit" name="action" value="addProduct" class="btn btn-dark ">Add Product</button>
                            <?php } ?>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
include'../../footer.php';
ob_end_flush();
?>
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
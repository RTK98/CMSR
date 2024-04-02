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
                $JobCardId;
                $OrderId;
                $db = dbconn();
                $sql = "SELECT ord.orderNo,"
                        . "ord.JobCardNo,"
                        . "ord.AddDate,"
                        . "ord.AddUser,"
                        . "ord.Status,"
                        . "ord.id,"
                        . "cus.FirstName,"
                        . "cus.LastName,"
                        . "cv.registerLetter,"
                        . "cv.RegistrationNo,"
                        . "vc.CatergoryName,"
                        . "u.FirstName AS 'UserFirstName',"
                        . "u.LastName AS 'UserLastName',"
                        . "jbc.JobCardNo AS 'JobCardNumber' "
                        . "FROM orders ord LEFT JOIN customer cus ON ord.CustomerName=cus.CustomerID "
                        . "LEFT JOIN customervehicles cv ON ord.VehicleNo=cv.vehicleId "
                        . "LEFT JOIN job_cards jbc ON ord.JobCardNo=jbc.id "
                        . "LEFT JOIN users u ON ord.AddUser=u.UserId "
                        . "LEFT JOIN vehicle_catergories vc ON cv.VehicleType=vc.VCatergoryId "
                        . "WHERE ord.JobCardNo='$JobCardId' AND ord.id='$OrderId';";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();
            }
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
                                            <h5 class='m-1'style="text-align: center; font-weight: bold;">Order Summary</h5>
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
                                                        <p>Order No : <?= $row['orderNo'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <p>Job Card No:  <?= $row['JobCardNumber'] ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Order By :  <?= $row['UserFirstName'] . ' ' . $row['UserLastName'] ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Order Date :  <?= $row['AddDate'] ?></p>
                                                    </div>
                                                    <div>
                                                        <p>Order Status : <?php
                                                            $Status = $row['Status'];
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
                                                        $sqlshowproduct = "SELECT od.id,od.orderNo,p.ProductName,odr.Qty FROM orders od "
                                                                . "LEFT JOIN orderitems odr ON odr.OrderId=od.id"
                                                                . " LEFT JOIN products p ON odr.ProductId=p.ProductId "
                                                                . "WHERE od.JobCardNo = '$JobCardId'AND od.id='$OrderId';";
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
        </div>
    </div>
</main>
<?php include'../../footer.php'; ?>

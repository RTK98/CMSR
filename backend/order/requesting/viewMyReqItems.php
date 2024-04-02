<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Orders</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>jobCard/viewReqItemRepairTech.php" class="btn btn-sm btn-dark">Request Items</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>order/requesting/viewMyRelItems.php" class="btn btn-sm btn-dark">Received Items</a>
            </div>
        </div>
    </div>
    <h2>Order List</h2>
    <div class="table-responsive">
        <?php
        $userId = $_SESSION['userId'];
        $db = dbconn();
        $sql = "SELECT od.id,"
                . "od.orderNo,"
                . "od.AddDate,"
                . "od.Status,"
                . "jbc.id AS 'JobCardId',"
                . "cus.FirstName,"
                . "cus.LastName,"
                . "us.FirstName AS 'EmpFirstName',"
                . "us.LastName AS 'EmpLastName',"
                . " vc.CatergoryName,"
                . "cv.registerLetter,"
                . "jbc.JobCardNo AS 'JobCardNumber',"
                . "cv.RegistrationNo FROM orders"
                . " od LEFT JOIN job_cardsrepair jbr ON jbr.jobCardsRepairId=od.JobCardNo "
                . "LEFT JOIN customer cus ON cus.CustomerID=od.CustomerName "
                . "LEFT JOIN customervehicles cv ON cv.vehicleId=od.VehicleNo "
                . "LEFT JOIN users us ON us.UserId=od.AddUser "
                . "LEFT JOIN job_cards jbc ON od.JobCardNo=jbc.id "
                . "LEFT JOIN vehicle_catergories vc ON vc.VCatergoryId=cv.VehicleType "
                . "WHERE od.AddUser='$userId' "
                . "ORDER by od.id AND od.AddDate DESC";
        $result = $db->query($sql); // Run Query
//        print_r($result);
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order No</th>
                    <th scope="col">Job card No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Vehicle Type</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
//                        print_r($row)
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $row['orderNo'] ?></td>
                            <td><?= $row['JobCardNumber'] ?></td>
                            <td><?= $row['FirstName'] . '' . $row['LastName'] ?></td>
                            <td><?= $row['registerLetter'] . '-' . $row['RegistrationNo'] ?></td>
                            <td><?= $row['CatergoryName'] ?></td>
                            <td><?= $row['AddDate'] ?></td>
                            <td><?php
                                $OrderStatus = $row['Status'];
                                $statusDescription = '';

                                switch ($OrderStatus) {
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
                                <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span></td>
                            <td>
                                <form method='post' action="viewOrderItems.php">
                                    <input type="hidden" name="OrderId" value="  <?= $row['id'] ?>">
                                    <input type="hidden" name="JobCardId" value="  <?= $row['JobCardId'] ?>">
                                    <button type="submit" name="action" value="edit" class="btn btn-sm btn-primary">View Items</button>
                                </form>

                            </td>
                        </tr>
                        <?php
                        $n++;
                    }
                } else {
                    // If no results are found, display a message in a single row
                    ?>
                    <tr>
                        <td colspan="9" style="text-align: center; color:red">No results found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php include'../../footer.php'; ?>

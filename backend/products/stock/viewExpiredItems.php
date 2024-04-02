<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/stock/stockManage.php" class="btn btn-sm btn-dark">Add Stock</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/stock/stockManage.php" class="btn btn-sm btn-dark">View Return Items</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/stock/stockManage.php" class="btn btn-sm btn-dark">View Damage Items</a>
            </div>
        </div>
    </div>
    <section>
        <div class="row">
            <div class="col-lg-6">
                <h2>Expired Items</h2>
                <div class="table-responsive">
                    <?php
                    $userId = $_SESSION['userId'];
                    $adddate = date("Y-m-d");
                    $db = dbconn();
                    $sqlexItems = "SELECT p.ProductName,"
                            . "bc.BatchNo,"
                            . "po.PoNo,"
                            . "sup.SupplierName,"
                            . "ex.serialNo,"
                            . "ex.ExpireDate FROM expireitems ex "
                            . "LEFT JOIN products p ON p.ProductId=ex.ProductName "
                            . "LEFT JOIN batchno bc ON bc.BatchId=ex.batchNo "
                            . "LEFT JOIN purchasingorders po ON ex.poNo=po.PoId "
                            . "LEFT JOIN supplier sup ON ex.SupplierId=sup.SupplierId;";

                    $resultexItems = $db->query($sqlexItems);
                    ?>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Serial No</th>
                                <th scope="col">Batch No</th>
                                <th scope="col">Purchasing Order No</th>
                                <th scope="col">Supplier Name</th>
                                <th scope="col">Expire Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultexItems->num_rows > 0) {
                                $n = 1;
                                while ($rowexItems = $resultexItems->fetch_assoc()) {
//                        print_r($row)
                                    ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td><?= $rowexItems['ProductName'] ?></td>
                                        <td><?= $rowexItems['serialNo'] ?></td>
                                        <td><?= $rowexItems['BatchNo'] ?></td>
                                        <td><?= $rowexItems['PoNo'] ?></td>
                                        <td><?= $rowexItems['SupplierName'] ?></td>
                                        <td><?= $rowexItems['ExpireDate'] ?></td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <h2>Today Expired Items</h2>
                <div class="table-responsive">
                    <?php
                    $userId = $_SESSION['userId'];
                    $adddate = date("Y-m-d");
                    $db = dbconn();
                    $sqlexItems = "SELECT p.ProductName,"
                            . "bc.BatchNo,"
                            . "po.PoNo,"
                            . "sup.SupplierName,"
                            . "ex.serialNo,"
                            . "ex.ExpireDate FROM expireitems ex "
                            . "LEFT JOIN products p ON p.ProductId=ex.ProductName "
                            . "LEFT JOIN batchno bc ON bc.BatchId=ex.batchNo "
                            . "LEFT JOIN purchasingorders po ON ex.poNo=po.PoId "
                            . "LEFT JOIN supplier sup ON ex.SupplierId=sup.SupplierId "
                            . "WHERE ex.ExpireDate='$adddate'";

                    $resultexItems = $db->query($sqlexItems);
                    ?>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Serial No</th>
                                <th scope="col">Batch No</th>
                                <th scope="col">Purchasing Order No</th>
                                <th scope="col">Supplier Name</th>
                                <th scope="col">Expire Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultexItems->num_rows > 0) {
                                $n = 1;
                                while ($rowexItems = $resultexItems->fetch_assoc()) {
//                        print_r($row)
                                    ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td><?= $rowexItems['ProductName'] ?></td>
                                        <td><?= $rowexItems['serialNo'] ?></td>
                                        <td><?= $rowexItems['BatchNo'] ?></td>
                                        <td><?= $rowexItems['PoNo'] ?></td>
                                        <td><?= $rowexItems['SupplierName'] ?></td>
                                        <td><?= $rowexItems['ExpireDate'] ?></td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>
            <div class="col-lg-12">
                <h2>Products</h2>
                <div class="table-responsive">
                    <?php
                    $userId = $_SESSION['userId'];
                    $adddate = date("Y-m-d");
                    $db = dbconn();
                    $sqlStock = "SELECT si.StockId,"
                            . "pro.ProductId,"
                            . "pro.ProductName,"
                            . "si.SupplierName AS 'supplierId',"
                            . "si.SerialNo,"
                            . "si.Status,"
                            . "b.BatchId,"
                            . "b.BatchNo,"
                            . "po.PoId,"
                            . "po.PoNo,"
                            . "sup.SupplierName,"
                            . "si.ExpDate "
                            . "FROM stockitems si "
                            . "LEFT JOIN supplier sup ON si.SupplierName=sup.SupplierId "
                            . "LEFT JOIN products pro ON si.ProductName=pro.ProductId "
                            . "LEFT JOIN batchno b ON si.BatchNo=b.BatchId "
                            . "LEFT JOIN purchasingorders po ON si.PoNo=po.PoId";

                    $resultStock = $db->query($sqlStock);
                    ?>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Serial No</th>
                                <th scope="col">Batch No</th>
                                <th scope="col">Purchasing Order No</th>
                                <th scope="col">Supplier Name</th>
                                <th scope="col">Expire Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultStock->num_rows > 0) {
                                $n = 1;
                                while ($rowStock = $resultStock->fetch_assoc()) {
                                    $expireDate = $rowStock['ExpDate'];
                                    $today = date('Y-m-d');
                                    $ShowButton = ($expireDate == $today);
                                    ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td><?= ucwords($rowStock['ProductName']) ?></td>
                                        <td><?= $rowStock['SerialNo'] ?></td>
                                        <td><?= $rowStock['BatchNo'] ?></td>
                                        <td><?= $rowStock['PoNo'] ?></td>
                                        <td><?= ucwords($rowStock['SupplierName']) ?></td>
                                        <td><?= $rowStock['ExpDate'] ?></td>
                                        <td>
                                            <?php
                                            $Status = $rowStock['Status'];
                                            $statusDescription = '';

                                            switch ($Status) {
                                                case 0:
                                                    $statusDescription = "Issued";
                                                    $statusColor = "badge rounded-pill bg-warning text-dark";
                                                    break;
                                                case 1:
                                                    $statusDescription = "In Stock";
                                                    $statusColor = "badge rounded-pill bg-success";
                                                    break;
                                                case 3:
                                                    $statusDescription = "Expired";
                                                    $statusColor = "badge rounded-pill bg-danger";
                                                    break;
                                                case 4:
                                                    $statusDescription = "Mnf Damage";
                                                    $statusColor = "badge rounded-pill bg-primary";
                                                    break;
                                                case 5:
                                                    $statusDescription = "Physical Damage";
                                                    $statusColor = "badge rounded-pill bg-secondary";
                                                    break;
                                                case 6:
                                                    $statusDescription = "Employee Damage";
                                                    $statusColor = "badge rounded-pill bg-secondary";
                                                    break;
                                                default:
                                                    $statusDescription = "Not Available";
                                                    $statusColor = "badge rounded-pill bg-dark";
                                                    break;
                                            }
                                            ?>
                                            <span class='<?= $statusColor ?>'><?= $statusDescription ?> </span> 
                                        </td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</main>
<?php include'../../footer.php'; ?>

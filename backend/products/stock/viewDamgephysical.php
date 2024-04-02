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
                <a href="<?= SYSTEM_PATH ?>products/stock/viewDamgeEmp.php" class="btn btn-sm btn-dark">Employee Damage</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/stock/viewDamgephysical.php" class="btn btn-sm btn-dark">Physical Damage</a>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'add') {

        $StockId;
        $BatchId;
        $SerialNo;
        $PoId;
        $CatergoryName;
        $supplierId;
        $Cost;
        $SalePrice;
        $ProductId;

        $addeduser = $_SESSION['userId'];
        $adddate = date("Y-m-d");
        $db = dbConn();
         $sqlExpire = "INSERT INTO damageitems(stockId,CategoryName,ProductName,serialNo,batchNo,poNo,SupplierId,Cost,SalePrice,Status,AddUser,AddDate) VALUES "
        . "('$StockId','$CatergoryName','$ProductId','$SerialNo','$BatchId','$PoId','$supplierId','$Cost','$SalePrice','5','$addeduser','$adddate')";
        $db->query($sqlExpire);

         $sqlUpdateStock = "UPDATE stockitems SET Status='5', UpdateUser='$addeduser',UpdateDate='$adddate' WHERE StockId='$StockId' ";
        $db->query($sqlUpdateStock);
        ?>
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Product has been Successfully Marked as Expired',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
            }).then(() => {
                window.location.href = 'viewExpiredItems.php'; // Redirect to success page
            });
        </script><?php
    }
    ?>
    <hr>
    <section>
        <div class="row">
            <div class="col-lg-12">
                <h2>Physical Damages</h2>
                <div class="table-responsive">
                    <?php
                    $userId = $_SESSION['userId'];
                    $adddate = date("Y-m-d");
                    $db = dbconn();
                    $sqlexItems = "SELECT p.ProductName,"
                            . "bc.BatchNo,"
                            . "po.PoNo,"
                            . "sup.SupplierName,"
                            . "ex.serialNo FROM damageitems ex "
                            . "LEFT JOIN products p ON p.ProductId=ex.ProductName "
                            . "LEFT JOIN batchno bc ON bc.BatchId=ex.batchNo "
                            . "LEFT JOIN purchasingorders po ON ex.poNo=po.PoId "
                            . "LEFT JOIN supplier sup ON ex.SupplierId=sup.SupplierId "
                            . "WHERE ex.Status='5'";

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
                                        <td><?= ucwords($rowexItems['SupplierName']) ?></td>
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
                            . "si.CatergoryName,"
                            . "si.Cost,"
                            . "si.SalePrice,"
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
                            . "si.ExpDate FROM stockitems si "
                            . "LEFT JOIN supplier sup ON si.SupplierName=sup.SupplierId "
                            . "LEFT JOIN products pro ON si.ProductName=pro.ProductId "
                            . "LEFT JOIN batchno b ON si.BatchNo=b.BatchId "
                            . "LEFT JOIN purchasingorders po ON si.PoNo=po.PoId;";

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
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultStock->num_rows > 0) {
                                $n = 1;
                                while ($rowStock = $resultStock->fetch_assoc()) {
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
                                                    $showButtonMnf = false;
                                                    break;
                                                case 1:
                                                    $statusDescription = "In Stock";
                                                    $statusColor = "badge rounded-pill bg-success";
                                                    $showButtonMnf = true;
                                                    break;
                                                case 3:
                                                    $statusDescription = "Expired";
                                                    $statusColor = "badge rounded-pill bg-danger";
                                                    $showButtonMnf = false;
                                                    break;
                                                case 4:
                                                    $statusDescription = "Mnf Damage";
                                                    $statusColor = "badge rounded-pill bg-primary";
                                                    $showButtonMnf = false;
                                                    break;
                                                case 5:
                                                    $statusDescription = "Physical Damage";
                                                    $statusColor = "badge rounded-pill bg-secondary";
                                                    $showButtonMnf = false;
                                                    break;
                                                case 6:
                                                    $statusDescription = "Employee Damage";
                                                    $statusColor = "badge rounded-pill bg-secondary";
                                                    $showButtonMnf = false;
                                                    break;
                                                default:
                                                    $statusDescription = "Not Available";
                                                    $statusColor = "badge rounded-pill bg-dark";
                                                    $showButtonMnf = false;
                                                    break;
                                            }
                                            ?>
                                            <span class='<?= $statusColor ?>'><?= $statusDescription ?> </span> 


                                        </td>
                                        <td>
                                            <?php if ($showButtonMnf) { ?>
                                                <form method='post' action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                                    <input type="hidden" name="ProductId" value="<?= $rowStock['ProductId'] ?>">
                                                    <input type="hidden" name="StockId" value="<?= $rowStock['StockId'] ?>">
                                                    <input type="hidden" name="BatchId" value="<?= $rowStock['BatchId'] ?>">
                                                    <input type="hidden" name="SerialNo" value="<?= $rowStock['SerialNo'] ?>">
                                                    <input type="hidden" name="PoId" value="<?= $rowStock['PoId'] ?>">
                                                    <input type="hidden" name="CatergoryName" value="<?= $rowStock['CatergoryName'] ?>">
                                                    <input type="hidden" name="supplierId" value="<?= $rowStock['supplierId'] ?>">
                                                    <input type="hidden" name="Cost" value="<?= $rowStock['Cost'] ?>">
                                                    <input type="hidden" name="SalePrice" value="<?= $rowStock['SalePrice'] ?>">
                                                    <button type="submit" name="action" value="add" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to mark as physcial damge this item?')">Physical Damage</button>
                                                </form>
                                            </td>
                                        <?php }
                                        ?>
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

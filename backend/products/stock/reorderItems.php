<?php ob_start(); ?>
<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Appointments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="stockManage.php" class="btn btn-sm btn-dark">Add Stock</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/viewProductsTech.php" class="btn btn-sm btn-dark">View Products</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/category/viewStockKeeper.php" class="btn btn-sm btn-dark">View Product Categories</a>
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/stock/viewStock.php" class="btn btn-sm btn-dark">Stock Management</a>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    $current = date("Y-m-d");
    $empId = $_SESSION['userId'];
    $db = dbconn();
    $sqlReorder = "SELECT p.ProductId,"
            . "p.ProductName, "
            . "p.SupplierName,"
            . "p.Qty,"
            . "p.OrderStatus, "
            . "(p.Qty <= p.ReorderLevel) AS 'ReOrderItems',"
            . "s.SupplierName FROM products p "
            . "LEFT JOIN supplier s ON p.SupplierName=s.SupplierId "
            . "WHERE p.ProductStatus='1' AND (p.Qty<=p.ReorderLevel)";
    $resultReorder = $db->query($sqlReorder);
    ?>
    <h2> Re-Order Items</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Product Qty</th>
                    <th scope="col">Order Status</th>s
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultReorder->num_rows > 0) {
                    $n = 1;
                    while ($row = $resultReorder->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $row['ProductName'] ?></td>
                            <td><?= ucwords($row['SupplierName']) ?></td>
                            <td><?= $row['Qty'] ?></td>
                            <td> 
                                <?php
                                $OrderStatus = $row['OrderStatus'];
                                $statusDescription = '';

                                switch ($OrderStatus) {
                                    case 1:
                                        $statusDescription = "P/O Sent";
                                        $statusColor = "btn btn-primary btn-sm";
                                        break;
                                    case 2:
                                        $statusDescription = "Order Recieved";
                                        $statusColor = "btn btn-success btn-sm";
                                        break;
                                    case 0:
                                        $statusDescription = "Need To Order";
                                        $statusColor = "btn btn-danger btn-sm";
                                        break;

                                    default:
                                        $statusDescription = "Not Available";
                                        $statusColor = "btn btn-secondary btn-sm";
                                        break;
                                }
                                ?>
                                <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                            </td>
                            <td>
                                <form method='post' action="OrderItem.php" class="btn-group">
                                    <input type="hidden" name="ProductId" value="<?= $row['ProductId'] ?>">
                                    <button type="submit" class="btn btn-primary" name="action" value="Order">Order</button>
                                </form>
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
</main>
<?php include'../../footer.php'; ?>

<?php ob_end_flush(); ?>

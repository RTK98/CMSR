<?php include'../../header.php'; ?>
<?php include'../../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Stocks</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/stock/stockManage.php" class="btn btn-sm btn-dark">Add Stock</a>
            </div>
        </div>
    </div>
    <h2>Stock List</h2>
    <section>
        <div class="row">
            <div class="col-md-3">
                <?php
                $current = date("Y-m-d");
                $empId = $_SESSION['userId'];
                $db = dbconn();
                $sqlReorder = "SELECT p.ProductId,p.ProductName, p.SupplierName,p.Qty, (p.Qty <= p.ReorderLevel) AS 'ReOrderItems' FROM products p WHERE p.ProductStatus='1'";
                $resultReorder = $db->query($sqlReorder);
                if ($resultReorder->num_rows > 0) {
                    $ReoderCount = $resultReorder->num_rows;
                } else {
                    $ReoderCount = 0;
                }
                ?>
                <a href="reorderItems.php" style="display: none;" id="hidden-link"></a>
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;" onclick="document.getElementById('hidden-link').click();">
                    <div class="card-body">
                        <h5 class="card-title">Re-Order Products</h5>
                        <h2><?= $ReoderCount ?></h2>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printReport('report')">Print</button>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
    <div id="report">
        <div class="table-responsive">
            <?php
            $db = dbConn();
            $sql = "SELECT p.ProductId,p.ProductName,p.Qty,p.ProductStatus,p.IssuedQty,(p.Qty-p.IssuedQty) AS 'Balance',c.CatergoryName,sp.SupplierName FROM products p "
                    . "LEFT JOIN catergories c ON c.CatergoryID=p.ProductCatergory"
                    . " LEFT JOIN supplier sp ON sp.SupplierId=p.SupplierName";
            $result = $db->query($sql);
            ?>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Supplier Name</th>
                        <th>Available Qty</th>
                        <th>Issued Qty</th>
                        <th>Product Status</th>
                        <th>ACtion</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= ucwords($row['ProductName']) ?></td>
                                <td><?= ucwords($row['CatergoryName']) ?></td>
                                <td><?= ucwords($row['SupplierName']) ?></td>
                                <td><?= $row['Qty'] ?></td>
                                <td><?= $row['IssuedQty'] ?></td>
                                <td><?php
                                    $ProductStatus = $row['ProductStatus'];
                                    $statusDescription = '';

                                    switch ($ProductStatus) {
                                        case 1:
                                            $statusDescription = "Active";
                                            $statusColor = "btn btn-success btn-sm";
                                            break;
                                        case 0:
                                            $statusDescription = "Deactive";
                                            $statusColor = "btn btn-danger btn-sm";
                                            break;

                                        default:
                                            $statusDescription = "Not Available";
                                            $statusColor = "btn btn-secondary btn-sm";
                                            break;
                                    }
                                    ?>
                                    <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                    <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                </td>

                                <td>
                                    <?php
                                    $appointmentStatus;
                                    if ($ProductStatus == 0) {
                                        $disabled = "disabled";
                                    } else {
                                        $disabled = "";
                                    }
                                    ?>
                                    <form method='post' action="ViewProducts.php" class="btn-group">
                                        <input type="hidden" name="ProductId" value="<?= $row['ProductId'] ?>">
                                        <button type="submit" class="btn btn-primary" name="action" value="view" <?= @$disabled ?>>View</button>
                                    </form>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include'../../footer.php'; ?>
<script>
    function printReport(divid) {
        var divToPrint = document.getElementById(divid);

        var newWindow = window.open('', 'Print-Window');

        newWindow.document.open();

        newWindow.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWindow.document.close();

        setTimeout(function () {
            newWindow.close();
        }, 10);
    }
    var doc = new jsPDF();

    function exportReport(divid, title) {
        doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById('report').innerHTML + `</body></html>`);
        doc.save('div.pdf');
    }
</script>
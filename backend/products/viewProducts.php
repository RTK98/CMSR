<?php include'../header.php'; ?>
<?php include'../menu.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="add.php" class="btn btn-sm btn-dark">Add Product</a>
            </div>
        </div>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'delete') {
        echo $ProductId;
        $db = dbConn();
         $sqlDeactiveItems = "UPDATE products SET ProductStatus='0' WHERE ProductId='$ProductId'";
        $db->query($sqlDeactiveItems);
        ?>
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Product has been Deactive Successfully',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
            }).then(() => {
                window.location.href = 'viewProducts.php'; // Redirect to success page
            });
        </script><?php
    }
    ?>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] === "POST" && @$action == 'active') {
        echo $ProductId;
        $db = dbConn();
         $sqlDeactiveItems = "UPDATE products SET ProductStatus='1' WHERE ProductId='$ProductId'";
        $db->query($sqlDeactiveItems);
        ?>
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Product has been active Successfully',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
            }).then(() => {
                window.location.href = 'viewProducts.php'; // Redirect to success page
            });
        </script><?php
    }
    ?>
    <h2>Products List</h2>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printReport('report')">Print</button>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportReport('report', 'Vehicle Info')">Export PDF</button>
    <div id="report">
        <div class="table-responsive">
            <?php
            $db = dbconn();
            $sql = "SELECT p.ProductId,"
                    . "p.ProductImage,"
                    . "p.ProductName,"
                    . "p.ProductStatus,"
                    . "p.ReorderLevel,"
                    . "p.Qty,"
                    . "s.SupplierName,"
                    . "cat.CatergoryName "
                    . "FROM products p "
                    . "LEFT JOIN supplier s ON p.SupplierName=s.SupplierId "
                    . "LEFT JOIN catergories cat ON p.ProductCatergory=cat.CatergoryID;";
            $result = $db->query($sql); // Run Query
            ?>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Category</th>
                        <th scope="col">Supplier Name.</th>
                        <th scope="col">Reorder Level</th>
                        <th scope="col">Product Qty.</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $n = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $n ?></td>
                                <td> <img class="img-fluid" width="100"
                                          src="<?= SYSTEM_PATH ?>assets/img/products/<?= $row['ProductImage'] ?>"></td>
                                <td><?= ucwords($row['ProductName']) ?></td>
                                <td><?= ucwords($row['CatergoryName']) ?></td>
                                <td><?= ucwords($row['SupplierName']) ?></td>
                                <td><?= $row['ReorderLevel'] ?></td>
                                <td><?= $row['Qty'] ?></td>
                                <td>
                                    <?php
                                    $ProductStatus = $row['ProductStatus'];
                                    $statusDescription = '';

                                    switch ($ProductStatus) {
                                        case 1:
                                            $statusDescription = "Active";
                                            $statusColor = "badge bg-success btn-sm";
                                            $showEdit = true;
                                            $showDelete = true;
                                            $showActive = false;
                                            break;
                                        case 0:
                                            $statusDescription = "Deactive";
                                            $statusColor = "badge bg-danger btn-sm";
                                            $showEdit = false;
                                            $showDelete = false;
                                            $showActive = true;
                                            break;
                                        case 2:
                                            $statusDescription = "Not Available";
                                            $statusColor = "badge bg-danger btn-sm";
                                            $showEdit = false;
                                            $showDelete = true;
                                            $showActive = false;
                                            break;
                                    }
                                    ?>
                                    <!--                                   //$row['appointmentStatus'] == 1 ? "Pending" : 'Not Availble'-->
                                    <span class='<?= $statusColor; ?>'><?= $statusDescription; ?> </span>
                                </td>
                                <?php if ($showEdit) { ?>
                                    <td>
                                        <form method='post' action="edit.php">
                                            <input type="hidden" name="ProductId" value="<?= $row['ProductId'] ?>">
                                            <button type="submit" class='btn btn-sm btn-primary' name="action" value="edit">Edit</button>
                                        </form>
                                    </td>
                                <?php } ?>
                                <?php if ($showDelete) { ?>
                                    <td>
                                        <form method='post' action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                            <input type="hidden" name="ProductId" value="<?= $row['ProductId'] ?>">
                                            <button type="submit" class='btn btn-sm btn-danger' name="action" value="delete" onclick="return confirm('Are you sure you want to deactive this item?')">Deactive</button>
                                        </form>
                                    </td>
                                <?php } ?>

                                <?php if ($showActive) { ?>
                                    <td>
                                        <form method='post' action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                            <input type="hidden" name="ProductId" value="<?= $row['ProductId'] ?>">
                                            <button type="submit" class='btn btn-sm btn-success' name="action" value="active" onclick="return confirm('Are you sure you want to active this item?')">Active</button>
                                        </form>
                                    </td>
                                <?php } ?>
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
</main>
<?php include'../footer.php'; ?>
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